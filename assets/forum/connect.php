
<?php 
//session_start();
//require("../../classes/cls.config.php"); 
require("../../classes/cls.constants.php"); 



$thisPage	 = substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/" )+1);

if(isset($_GET['id'])) {$gtid=$_GET['id'];} else {$gtid= '';}
if(isset($_GET['fcat'])) {$fcat=$_GET['fcat'];} else {$fcat= NULL;}
if(isset($_GET['ftopic'])) {$ftopic=$_GET['ftopic'];} else {$ftopic= NULL;}
if(isset($_GET['fpost'])) {$fpost=$_GET['fpost'];} else {$fpost= NULL;}
if(isset($_GET['fitm'])) {$fitm=$_GET['fitm'];} else {$fitm='cat';}
if(isset($_GET['fopt'])) {$fopt=$_GET['fopt'];} else {$fopt='list';}
	
	
	
function sanitizor($input) 
{
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitizor($val);
        }
    }
    else {
		if (get_magic_quotes_gpc()) { $input = stripslashes($input); } 
		
		$charEntities = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);//, 'UTF-8'
		$input = trim(strtr($input, $charEntities));
		$input = "" . q_si($input) . "";      
    }
    return $input;
}	


if(isset($sys_us_admin) and $sys_us_admin['actype_id'] == 1 or 
   isset($sys_us_admin) and $sys_us_admin['actype_id'] == 2) 
{ $member_is_admin = 1; }
else
{ $member_is_admin = 0; }
?>