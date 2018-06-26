# Tovu Platfom
Tovu is an open source database driven web platform that facilitates management of a central data repository for an organization. The platform has a document repository (library), articles section (experiences and innovations, news and events) and discussion forums. The platform runs on a custom built Content Management System (CMS) with an administrative backend where you can easily manage upload of resources, manage articles, forums, navigation links and user accounts / registrations. The platform is open source and can be used freely by any organization/entity.

Tovu has been developed using PHP, HTML and Javascript, and runs on MySql database.

The library has the capability to accept resource uploads in form of pdf, word, powerpoint and excel documents. It also has a preview feature that enables you to view the uploaded resources without having to download the resources. There is also a download feature that enables you to download the resources to your smart device / computer.

## How to install Tovu

1. Clone this repository on your computer by clicking <a href="https://github.com/OpenInstitute/tovu/archive/master.zip" target="blank"> download zip</a> or use this on your terminal:
##### Tip: Make sure you have git installed on your terminal.
```git clone https://github.com/OpenInstitute/tovu.git my-preferred-folder ``` - You can replace my-preferred-folder with any name
    
2. Create a mysql database instance and import the database schema from the `schema` folder
3. You will need to point the project to your newly created database. Therefore, this is what you will do;
  i. Change directory to the classes folder and locate a file `cls.condb.php` this is the database config file. Change it to point to your database schema: NB: The "$pdb_prefix" is the prefix used on the database tables. 
  ```<?php
    require_once('cls.base.php');
    
    define('DB_HOST',    'localhost');
    define('DB_CHARSET', 'utf8');
    
    if($_SERVER['HTTP_HOST'] == "localhost") { 
      define('DB_NAME', 'your-database-name');	
      define('DB_USER', '');
      define('DB_PASSWORD', '');
    } else {
      define('DB_NAME', 		'');	
      define('DB_USER', 	 	'');
      define('DB_PASSWORD', 	''); 
    }
    
    $pdb_prefix = 'mrfc_';
?>
``` 
4. Open file `cls.base.php` within the classes folder and change 'SITE_FOLDER' to the name of the folder where the installation has been done. This file contains other configurations that are in use on the platform for example site logo, site name and your social media platforms. 
5. You are good to go.




    
    
    


