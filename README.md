# Bhubejhr Document (QR-Code)
Document and QR-Code Project with Chao Phraya Abhaibhubej Hospital.

# Important!:
- PHP Require version 5.6 or higher.
- Install in root or subdomain only (example.com, demo.exmaple.com)
- Not Working in Subdirectory (example.com/demo)

# Installation:
- Import database form /database/database.sql
- Change config file
```
// DATABASE CONNECTION SEUTUP
define("DB_HOST" 		,"localhost");
define("DB_NAME" 		,"xxxx");
define("DB_USER"		,"xxxx");
define("DB_PASS" 		,"xxxx");

// SITE SETUP
define("TITLE" 			,'Document with QR Code');
define("DESCRIPTION"	,'Create, share and edit text documents with online word processing');

// SITE SECRET KEY
define("SECRET_KEY"		,'7517493301e9770cda3hgty67d88e2e5');

// Facebook App Setting
define("APP_ID" 		,'xxxx');
define("APP_SECRET" 	,'xxxx');
define("ADMIN_ID" 		,'xxxx');
define("GRAPH_VERSION" 	,'v2.8');
```
- Rename config.exmaple.php to config.php
- Done!