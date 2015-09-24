# referer-spam-blocker
<a href="https://contao.org/" target="_blank">Contao CMS</a> Plugin to block referer spam access through .htaccess "Deny".

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

