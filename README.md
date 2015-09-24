# referer-spam-blocker
<a href="https://contao.org/" target="_blank">Contao CMS</a> Plugin to block referer spam access through .htaccess "Deny".

<a href="https://en.wikipedia.org/wiki/Referer_spam" target="_blank">Wikipedia about Referer spam</a>
>Referrer spam (also known as log spam or referrer bombing[1]) is a kind of spamdexing (spamming aimed at search engines). The technique involves making repeated web site requests using a fake referer URL to the site the spammer wishes to advertise.[2] Sites that publish their access logs, including referer statistics, will then inadvertently link back to the spammer's site. These links will be indexed by search engines as they crawl the access logs. This technique does not harm the affected sites, just pollutes their statistics.

>This benefits the spammer because the free link improves the spammer site's search engine ranking owing to link-counting algorithms that search engines use.

>A new spam is happening in the digital world, especially in Google Analytics data Called Ghost Spam & Referral Spams with 100% bounce rate. Ghost spam traffic directly interact with Google Analytics data with measurement protocol system where as referral spam directly influence website traffic. As a result spammers try to increase traffic to their websites.

## Features
blocks access from identified referal spamers by blocking them in .htaccess file:
```APACHE
<IfModule mod_setenvif.c>
# Set spammers referral as spambot
SetEnvIfNoCase Referer 1pamm.ru spambot=yes
# ...
## add as many as you find

Order allow,deny
Allow from all
Deny from env=spambot
</IfModule>
```

By default the community-contributed list of referrer spammers maintained by <a href="https://github.com/piwik/referrer-spam-blacklist" target="blank">PIWIK</a> is used. <br />
The list source can be changed at the Contao settings section.

.htaccess file will be updated weekly. <br />
Entries in the .htaccess file can be updated or deleted manually from the Contao Maintenance section.


## Dependencies
Apache

