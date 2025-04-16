import requests
import json

# 
# slackdump tool used to extract messages from the NeuroTechX Slack:
#   https://github.com/rusq/slackdump
# 
# MediaWiki API used to search for URLs present on the wiki:
#   https://bciwiki.org/api.php?action=query&list=exturlusage&euquery=adtechmedical.com&utf8=&format=json
# 

messages_filenames = ["C073WP1T9.json",  # general
                      "C08PVFWH4.json",  # eegdata
                      "C08QEC5H7.json",  # introductions
                      "C08QFKWF2.json",  # tutorials
                      "C08S3426L.json",  # studentclubs
                      "C073WQK34.json",  # random
                      "C073X2ZQW.json",  # hacknights
                      "C3525BTBN.json"]  # neurotechedu
unique_urls = {}  # dict of unique urls grouped by domain name
missing_urls = []  # list of urls with domains found on bciwiki


# Check each message dump file for links
for messages_filename in messages_filenames:

    with open(f"scripts/neurotechx-slack-analysis/data/{messages_filename}", "r", encoding="utf-8") as messages_file:

        messages = messages_file.read()
        messages = messages.replace("https://", "http://")

        for url in messages.split("http://"):

            for split_char in ["\"", "'", "\\", "|", " ", "#", "?"]:
                url = url.split(split_char)[0]

            # add domains + urls to unique_urls if they aren't already present
            if url.split("/")[0] in unique_urls:

                if url not in unique_urls[url.split("/")[0]]:

                    unique_urls[url.split("/")[0]].append(url)
            else:
                unique_urls[url.split("/")[0]] = [url]

# Sort and save unique urls dict to .json file
unique_urls = dict(sorted(unique_urls.items()))
# open("scripts/neurotechx-slack-analysis/exported_urls.json", "w+").write(json.dumps(unique_urls))


# Check dict for domains with 10+ associated urls
other_urls = []
for domain in unique_urls:
    if len(unique_urls[domain]) >= 10:
        open(f"scripts/neurotechx-slack-analysis/export/{domain}.txt", "w+", encoding="utf-8").write("\n".join(unique_urls[domain]))
    else:
        other_urls += unique_urls[domain]
open(f"scripts/neurotechx-slack-analysis/export/other.txt", "w+", encoding="utf-8").write("\n".join(other_urls))


# Ignore any sites with more than 2 links when checking the wiki
ignore_domains = []
for domain in unique_urls:
    if len(unique_urls[domain]) > 2:
        ignore_domains.append(domain)

# Check bciwiki for each domain name
print(f"Searching for {len(unique_urls) - len(ignore_domains)} unique domain names with the BCIWiki API.")
for domain in unique_urls:
    if domain not in ignore_domains:

        append_urls = True
        try:
            resp = requests.get(f"https://bciwiki.org/api.php?action=query&list=exturlusage&euquery={domain}&utf8=&format=json").json()
            if 'query' in resp:
                if len(resp['query']['exturlusage']) > 0:
                    append_urls = False
        except Exception:
            pass

        if append_urls:
            for url in unique_urls[domain]:
                missing_urls.append(url)

print(f"{len(missing_urls)} missing URLs found.")

# Save missing urls list to .txt
open("scripts/neurotechx-slack-analysis/missing_urls.txt", "w+", encoding="utf-8").write("\n".join(missing_urls))