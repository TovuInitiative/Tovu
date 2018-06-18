<?php
@ini_set('upload_max_filesize', '5M');

class mailer_2_XXX 
{
	var $sendto; 
	var $subject; 
	var $message; 
	var $sendfrom;
	
	function form_alerts($sendto, $subject, $message, $sendfrom) 
	{
		$content = '<html><head><title>'.$subject.'</title></head>'
			.'<body style="font-family: Tahoma, Verdana, Arial; font-size:12px;">'.$message.'</body></html>';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n"; 				
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$sendto. "\r\n";	
		$headers .= 'From: no-reply@'.SITE_DOMAIN_URI.'' . "\r\n";
     	
		return 	mail($sendto, $subject, $content, $headers);

	}
}
		//$mailer_2 = new mailer_2; // INITIALIZE MAILING FUNCTION
		

class newsletter_mailer
{
	var $sendto; 
	var $subject; 
	var $message; 
	var $sendfrom;
	
	var $dom_url;
	
	
	function news_alert($sendto, $subject, $message, $sendfrom = "") 
	{
	
		//$dom_url = 'http://'.$_SERVER['HTTP_HOST'].'/';
	
		$content  = $message;
		//$homepage = file_get_contents('../newsmail.php');
		//$homepage = str_replace('{_MERU_MAIL_CONTENT_GUTS_}', $message, $homepage);

		//$content  = $homepage;
		//echo $content; exit;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n"; 				// To send HTML mail, the Content-type header must be set
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$sendto. "\r\n";	// Additional headers
		$headers .= 'From: '.SITE_MAIL_SENDER.' <'.SITE_MAIL_FROM_BASIC.'>' . "\r\n";
     	
		return 	@mail($sendto, $subject, $content, $headers);
		sleep(2);
	}
}
		




/******************************************************************
@begin :: GNERATE SEO LINKS
********************************************************************/	



setlocale(LC_ALL, 'en_US.UTF8');
function generate_seo_link($str, $delimiter='-', $remove_words = true) //, $words_array = array()
{
	$bad_words = array('a','and','the','an','it','is','with','can','of','why','not','if','at','to','on','this','we');
	$delimiter = trim($delimiter);
	$delimiter_esc = ($delimiter == '-')? "\-" : $delimiter; 
	$clean = clean_output($str);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+".$delimiter_esc." ]/", "".$delimiter."", $clean);
	$clean = strtolower(trim($clean, '-'));	
	if($remove_words) { $clean = remove_words($clean, $delimiter, $bad_words); }	
	
	$clean = preg_replace("/[\/_|+ ]+/", $delimiter, $clean);	
	$clean = preg_replace("/(".$delimiter.")+/", "".$delimiter."", $clean );			  /* remove multiple -*/

	
	if(strlen($clean) > 100) 
	{   $pos   = strpos($clean,'-', 100);
		if($pos !== false){ $clean  = substr($clean, 0, $pos); }
	}
	
	return $clean;
}

/* takes an input, scrubs unnecessary words */
function remove_words($input,$replace,$words_array = array(),$unique_words = true)
{
	//separate all words based on spaces
	$input_array = explode(' ',$input);

	//create the return array
	$return = array();

	//loops through words, remove bad words, keep good ones
	foreach($input_array as $word)
	{
		//if it's a word we should add...
		if(!in_array($word,$words_array) && ($unique_words ? !in_array($word,$return) : true))
		{
			$return[] = $word;
		}
	}

	//return good words separated by dashes
	return implode($replace,$return);
}


/******************************************************************
@end :: GNERATE SEO LINKS
********************************************************************/	


/*function getChecksum($input) 
{
	$checkval = crc32($input);
	if($checkval < 0) {
		$checkval = $checkval *-1;
	}
	return $checkval;
}*/

/******************************************************************
@begin :: IMAGE UPLOAD FUNCTION
********************************************************************/	


function checkImageExist($imageName) 
{
	$id_photo = 0;
	$sq_pic_rec = " select id from `mrfc_dt_gallery_photos` where `filename` = ".quote_smart($imageName)."   limit 0, 1  ";
	
	$rs_pic_rec = $cndb->dbQuery($sq_pic_rec);	//
	if( $cndb->recordCount($rs_pic_rec) == 1)
	{
		$cn_pic_rec = $cndb->fetchRow($rs_pic_rec);
		$id_photo   = $cn_pic_rec[0];
	}
	
	return $id_photo;
}

/******************************************************************
@end :: IMAGE UPLOAD FUNCTION
********************************************************************/	
	

function copy_file_XXX($source, $destination) {
        $sp = fopen($source, 'r');
        $op = fopen($destination, 'w');

        while (!feof($sp)) {
            $buffer = fread($sp, 512);  // use a buffer of 512 bytes
            fwrite($op, $buffer);
        }
        // close handles
        fclose($op);
        fclose($sp);
    }

function recurse_copy_XXX($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 



		
		
?>