# fuzzycertstream
Uses the FuzzyWuzzy Python library to find possible domain matches in the SSL Transparency logs.
Can be used to find malicious use of SSL certs related to your domain.

Adapted from the Phish_Catcher tool found at https://github.com/x0rz/phishing_catcher

# Next steps
Allow to match against a list of domains

# Example Usage (update 'source' accordingly)
-Add appropriate domains to "domainfile.py"
-python fuzzycertstream.py