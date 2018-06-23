import certstream
import tqdm
import smtplib
import MySQLdb
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from fuzzywuzzy import fuzz
from fuzzywuzzy import process
from termcolor import colored, cprint

from domainfile import domains

log_suspicious = 'suspicious_domains.log'

def insert_mysql(ratio,domain,matchedto):
    db=MySQLdb.connect(passwd="weakpassword123",host="mysql",user="root",db="domains")
    c=db.cursor()
    c.execute("""INSERT INTO matches (ratio,domain,matchedto) VALUES (%s, %s, %s)""",(ratio,domain,matchedto))
    db.commit()
    db.close()
    return

def send_alert(domain):

    fromaddr = "fuzzycertstream@mycooldomain.io"
    toaddr = "fuzzy.bear@mycooldomain.io"
    msg = MIMEMultipart()
    msg['From'] = fromaddr
    msg['To'] = toaddr
    msg['Subject'] = "Possible Domain Match - " +str(domain)
    body = domain
    msg.attach(MIMEText(body, 'plain'))

    server = smtplib.SMTP('smtp.mycooldomain.io')
    text = msg.as_string()
    server.sendmail(fromaddr,toaddr,text)
    server.quit()

    return

def match_ratio(domain):
    """Match ratio of `domain`.
    The higher the ratio, the more probable `domain` is a phishing/spoof site.
    Args:
        domain (str): the domain to check.
    Returns:
        int: the match ratio of `domain`.
    """
    
    ratio = process.extract(domain, domains, scorer=fuzz.partial_ratio)

    # ratio = fuzz.partial_ratio(source, domain)
    return ratio

def callback(message, context):
    """Callback handler for certstream events."""
    if message['message_type'] == "heartbeat":
        return

    if message['message_type'] == "certificate_update":
        all_domains = message['data']['leaf_cert']['all_domains']

        for domain in all_domains:
            ratio = match_ratio(domain.lower())

            for r in ratio:

                if r[1] >= 95:
                    tqdm.tqdm.write(
                        "[!] Suspicious: "
                        "{} (ratio={} - {})".format(colored(domain, 'red', attrs=['underline', 'bold']), r[1], r[0]))
                        insert_mysql(r[1],domain,r[0])
                elif r[1] >= 85:
                    tqdm.tqdm.write(
                        "[-] Not too suspicious: "
                        "{} (ratio={} - {})".format(colored(domain, 'green', attrs=['underline']), r[1], r[0]))

                if r[1] >= 95:
                    with open(log_suspicious, 'a') as f:
                        f.write("{}\n".format(domain))

                if r[1] >= 98:
                    send_alert(domain)
            

certstream.listen_for_events(callback)