# BCIWiki

![Logo](web/logo.png)

This repo contains project files associated with the wiki website [BCIWiki.org](https://BCIWiki.org). It includes edited MediaWiki files, additional web content, as well as site automation scripts for data entry, web scraping, and content generation.

BCIWiki was originally set up in April of 2021 using MediaWiki version 1.35.2. Check out [CONTRIBUTING.md](CONTRIBUTING.md) to learn how you can become a contributor and help shape our understanding of neurotech.


## Contents
- `web/` - MediaWiki configuration files and added page content 
    - `Feedback/` - Contact form page with suggestions for categories to add to
    - `Neurotech_Mindmap/` - A full-width iframe page displaying an amazing mindmap made by [Pedram Naghieh](https://github.com/PedRaMNG)
    - `LocalSettings.php` - Primary config file modified to include extensions and implement site-wide behavior
    - `index.php` - Original site index modified to redirect to an alternative index
    - `logo.png` - Logo
    - `main.php` - Alternate index page
- `scripts/` - A collection of scripts created for automating the different workflows involved in managing BCIWiki content
    - `company-infographic-generator/` - Tool for creating infographics from manually collected [neurotech company data](https://bciwiki.org/index.php/Category:Companies). All generated infographics can be found [here](https://bciwiki.org/index.php/Company_Profiles). Design by [Toomas Erik Anijärv](https://www.toomaserikanijarv.com/)
        - `generator.py` - Main script to create graphics with logo and country assets
        - `silhouette-color.py` - Replace all pixels in a set of images with a different color
        - `countries/` - Country silhouette PNGs
    - `json_page_import.py` - Import JSON data from [NeurotechX](https://neurotechx.com/neurotech-ecosystem/) with manual verification. [Demo video here](https://drive.google.com/file/d/1he-GLCO5Wxq96iiPljpCqNO3G75q4YGm/view?usp=sharing)
    - `goodreads_import.py` - Scrape and import books from goodreads with manual verification
    - `nitrc_import.py` - Scrape and import software tools from nitrc.org with manual verification
    - `bulk_image_upload.py` - Upload multiple images with auto-generated descriptions
    - `company_page_update.py` - Update company pages to include info from the [company table](https://bciwiki.org/index.php/Category:Companies) and a generated graphic
    - `org_social_links.py` - Update [organization pages](https://bciwiki.org/index.php/Category:Organizations) to include [categories](https://www.mediawiki.org/wiki/Help:Categories) and web scraped social media links (Facebook, Twitter, LinkedIn, etc.)
    - `org_find_and_replace.py` - Find and replace specified substrings in all [organization pages](https://bciwiki.org/index.php/Category:Organizations)
    - `software_org_links.py` - Add links to and from [software pages](https://bciwiki.org/index.php/Category:Software) and [organization pages](https://bciwiki.org/index.php/Category:Organizations) that have matching websites
    - `devtool_org_links.py` - Add links to and from [developer tool pages](https://bciwiki.org/index.php/Category:Developer_Tools) and [organization pages](https://bciwiki.org/index.php/Category:Organizations) that have matching websites
    - `software_category_add.py` - Add Apple App Store, Google Play Store, and GitHub Repo [category links](https://www.mediawiki.org/wiki/Help:Categories) to all [software](https://bciwiki.org/index.php/Category:Software) and [developer tool](https://bciwiki.org/index.php/Category:Developer_Tools) pages with matching links
    - `org_site_status.py` - List organizations with broken websites
    - `openfda_import.py` - Import medical device registrations and applications from the OpenFDA API
    - `alphabetize_stim_sensing.py` - Alphabetize neurostimulation and neurosensing method lists in [companies table](https://bciwiki.org/index.php/Brain_Computer_Interface_Companies) and [software table](https://bciwiki.org/index.php/Category:Software) using the MediaWiki API

### Extensions & Configuration
These are the MediaWiki extensions that have been added to the site
- [MobileFrontend](https://www.mediawiki.org/wiki/Extension:MobileFrontend)
- [AutoSitemap](https://www.mediawiki.org/wiki/Extension:AutoSitemap)
- [YouTube](https://www.mediawiki.org/wiki/Extension:YouTube)
- [Cite](https://www.mediawiki.org/wiki/Extension:Cite)

Along with these extensions, a Google analytics tracking tag was included and new account creation was disabled to combat spam.

