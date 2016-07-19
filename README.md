Twinsen_DeployHelper
===================
Adds a new Command which will deploy static files like "setup:static-content:deploy" Command without using the Mysql-database. 
It will use a sqlite database instead.


Usage
-----

use the following command to generate a sqlite-database:

    bin/magento deployhelper:generatedb

You will find a  file named staticsettings.db in your root directory.
Please run the following command to generate the static files of M2:

    bin/magento deployhelper:deploy

This command will generate the static files by using the created sqlite database. You can run it on your custom CI-Scripts.    

Technical Data:
---------------

- The module uses one interceptor: it has a "after"-plugin for the class \Magento\Framework\App\ResourceConnection  
- The dump Command will export the following tables to the sqlite-database:
"core_config_data", "store", "store_group", "store_website", "theme", "translation"

History
-------


Requirements
------------
- Magento >= **2.1.0** (Please do not try on 2.0.x, because its not compatible due to changes on the core)
- PHP >= 5.5.0
- Sqlite Support of PHP

Support
-------
If you encounter any problems or bugs, please create an issue on [GitHub](https://github.com/EliasKotlyar/Twinsen_DeployHelper).



Installation Instructions with Composer
---------------------------------------------
    composer require twinsen/deployhelper
    bin/magento module:enable Twinsen_DeployHelper
    bin/magento setup:upgrade
    
    
Licence
-------
[GNU General Public License, version 3 (GPLv3)](http://opensource.org/licenses/gpl-3.0)

Copyright
---------
(c) 2016 Elias Kotlyar
