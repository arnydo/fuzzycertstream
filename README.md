# fuzzycertstream
Uses the FuzzyWuzzy Python library to find possible domain matches in the SSL Transparency logs.
Can be used to find malicious use of SSL certs related to your domain.

Adapted from the Phish_Catcher tool found at https://github.com/x0rz/phishing_catcher

I have updated to be Docker'ized and includes a simple web interface and MySQL backend.
This portion is still a bit clunky but it is a start.

# Next steps
- Allow environment variables in Compose file.

# Example Usage
-Add appropriate domains to "domainfile.py"
```
# docker-compose up
```