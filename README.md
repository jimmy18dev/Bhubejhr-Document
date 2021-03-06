# Bhubejhr Document (QR-Code)
Document and QR-Code Project with Chao Phraya Abhaibhubej Hospital.

## Feature:
- Store documents files (pdf,xls,xlsx,doc,docx,txt,ppt,pptx,zip)
- Generate QR Code automatically when file uploaded.
- File Permissions (Public, Member, Private)
- Facebook login with Graph API 2.11
- Mobile Friendly Support Android and iOS Devices.

## Important!!!:
- PHP Require version 5.6 or higher.
- Require Mod_Rewrite
- Install in root or subdomain only (example.com, demo.exmaple.com)
- Not Working in Subdirectory (example.com/demo)

## Installation:
- Import database form /database/database.sql
- Open confile/config.exmaple.php and edit...
```
define("DB_NAME" 		,"xxxx");
define("DB_USER"		,"xxxx");
define("DB_PASS" 		,"xxxx");
```

- Change title and description 
```
define("TITLE" 			,'Document with QR Code');
define("DESCRIPTION" 	,'Create, share and edit text documents with online word processing');
```

- Add SECRET_KEY Example: 7517493301e9770cda3hgty67d88e2e5
```
define("SECRET_KEY" ,'xxxx');
```

- Facebook Login - Setup and Getting Started [Facebook developers](https://developers.facebook.com)
```
define("APP_ID" 		,'xxxx');
define("ADMIN_ID" 		,'xxxx');
define("GRAPH_VERSION" 	,'v2.8');
```

- Rename config.exmaple.php to config.php
- Create new folder "files"
- Done!

## More Config
- Redirect HTTP to HTTPS Open .htaccess and remove # (line 2 and 3)
```
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{SERVER_NAME}/$1 [R,L]
```

## Built With
* [jQuery v.3.2.1](https://jquery.com) - jQuery: The Write Less, Do More, JavaScript Library.
* [jQuery Form Plugin](http://malsup.com/jquery/form/) - The jQuery Form Plugin allows you to easily and unobtrusively upgrade HTML forms to use AJAX.
* [Font Awesome 4.7](http://fontawesome.io) - The iconic font and CSS toolkit
* [PHP QR Code](http://phpqrcode.sourceforge.net) - PHP QR Code is open source (LGPL)
* [Numeral.js v. 2.0.6](http://numeraljs.com) - A javascript library for formatting and manipulating numbers.
* [PDO PHP Class](http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/) - Roll your own PDO PHP Class
* [Facebook SDK for JavaScript](https://developers.facebook.com/docs/javascript) - A rich set of client-side functionality for adding Social Plugins, Facebook Login and Graph API calls.
