<?php


/*
Page:           _config-rating.php
Created:        Aug 2006
Last Mod:       Mar 18 2007
Holds info for connecting to the db, and some other vars
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- */

	//Connect to  your rating database
	$rating_dbhost        = DB_HOST;
	$rating_dbuser        = DB_USER;
	$rating_dbpass        = DB_PASSWORD;
	$rating_dbname        = DB_NAME;
	$rating_tableName     = 'mrfc_dt_user_ratings';
	$rating_path_db       = 'ratingpost.php'; // the path to your db.php file (not used yet!)
	$rating_path_rpc      = ''; // the path to your rpc.php file (not used yet!)
	
	$rating_unitwidth     = 13; // the width (in pixels) of each rating unit (star, etc.)
	// if you changed your graphic to be 50 pixels wide, you should change the value above
	

?>