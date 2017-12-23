# Bhubejhr Document (QR-Code)
Document and QR-Code Project with Chao Phraya Abhaibhubej Hospital.

## Feature:
- Store documents files (pdf,xls,xlsx,doc,docx,txt,ppt,pptx,zip)
- Generate QR Code automatically when file uploaded.
- File Permissions (Public, Member, Private)
- Facebook login with Graph API 2.11
- Mobile Friendly Support Android and iOS Devices.

## Important!:
- PHP Require version 5.6 or higher.
- Install in root or subdomain only (example.com, demo.exmaple.com)
- Not Working in Subdirectory (example.com/demo)

## Installation:
- Import database form /database/database.sql
- Change config file
```
// DATABASE CONNECTION SEUTUP
define("DB_NAME" 		,"xxxx");
define("DB_USER"		,"xxxx");
define("DB_PASS" 		,"xxxx");

// SITE SETUP
define("TITLE" 			,'Document with QR Code');
define("DESCRIPTION" 	,'Create, share and edit text documents with online word processing');

// SITE SECRET KEY
define("SECRET_KEY"		,'7517493301e9770cda3hgty67d88e2e5');

// Facebook App Setting
define("APP_ID" 		,'xxxx');
define("APP_SECRET" 	,'xxxx');
define("ADMIN_ID" 		,'xxxx');
define("GRAPH_VERSION" 	,'v2.8');
```
- Rename config.exmaple.php to config.php
- Create new folder "files"
- Done!

## Built With

* [Font Awesome 4.7](http://fontawesome.io) - The iconic font and CSS toolkit
* [PHP QR Code](http://phpqrcode.sourceforge.net) - PHP QR Code is open source (LGPL)
* [Numeral.js v. 2.0.6](http://numeraljs.com) - A javascript library for formatting and manipulating numbers.
* [jQuery Form Plugin](http://malsup.com/jquery/form/) - The jQuery Form Plugin allows you to easily and unobtrusively upgrade HTML forms to use AJAX.
* [PDO PHP Class](http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/) - Roll your own PDO PHP Class
