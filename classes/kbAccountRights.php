<?php require("cls.condb.php"); 

function displayArray($array)    { echo "<pre>"; print_r($array); echo "</pre><hr />"; }
function clean_output($str, $useBreak=0) { if($useBreak){ $str = nl2br($str); } $patterns[0] = "/`/"; $patterns[1] = "/’/";  $str = trim(html_entity_decode(stripslashes($str),ENT_QUOTES,'UTF-8'));	 $str = iconv("ISO-8859-15", "UTF-8", iconv("UTF-8", "ISO-8859-15//IGNORE", $str));  return $str; } 
function clean_escape($value) { $value = "'" . mysql_real_escape_string($value) . "'"; return $value; }
function yesNoChecked($str)     { $val = ($str == 1) ? " checked " : " "; return $val; }


$privCats = array();


function privRights($critArr = '') 
{
    $cndb = new master();
	$privList   = array();
	$roleValues = array();
	
	if(is_array($critArr)) { $roleValues = $critArr; }
	
	$sq_priv = "SELECT
    `priv_id`
    , `priv_type`
    , `priv_code`
    , `priv_title`
    , `priv_parent_id`
FROM
    `afp_conf_privilege_list`
;"; //WHERE (`priv_type` =".clean_escape($pcat).")
	
	$rs_priv = $cndb->dbQuery($sq_priv); //, $link_cn
	if($cndb->recordCount($rs_priv))
	{
		while($cn_privileges = $cndb->fetchRow($rs_priv))
		{
			$priv_id 	= $cn_privileges['priv_id'];
			$priv_type  = $cn_privileges['priv_type'];
			$priv_code  = $cn_privileges['priv_code'];
			$priv_title  = $cn_privileges['priv_title'];
			$priv_parent_id  = $cn_privileges['priv_parent_id'];
			
			$priv_value = 0;
			
			if(count($roleValues) > 0 and array_key_exists($priv_id, $roleValues))
			{
				$priv_value = 1;
			}
			
			$privItem = array 
				(						
					'priv_id'			  => 	''.$priv_id.'',
					'priv_code'		   => 	''.$priv_code.'',
					'priv_title'	 => 	''.$priv_title.'',	
					'priv_parent_id'   => 	''.$priv_parent_id.'',					
					'priv_type'	  => 	''.$priv_type.'',
					'priv_value'	  => 	$priv_value														
				);
				
			$privList['_all'][$priv_id] = $privItem;	
			$privList[$priv_type][$priv_id] = $priv_id;
			
			/*if($priv_type == 'fmod')
			{
				$privList[$priv_code] = $priv_value;
			}*/
			
			if($priv_parent_id <> 0)
			{
				$privList['_all'][$priv_parent_id]['_son'][$priv_id] = $priv_id;
			}
			
		}
		
	}


	return $privList;
	
		
}


$roleRights = array();

$sq_priv_roles = "SELECT `priv_id`, `priv_value` FROM `afp_conf_privilege_to_roles` WHERE (`role_id` ='6' AND `priv_value` ='1');";
		
$rs_priv_roles = $cndb->dbQuery($sq_priv_roles);

if($cndb->recordCount($rs_priv_roles)>=1)
{ 
	while($cn_priv_roles = $cndb->fetchRow($rs_priv_roles))
	{
		$roleRights[$cn_priv_roles['priv_id']] = $cn_priv_roles['priv_value'];
	}
}
//displayArray($_SESSION);
//displayArray($roleRights);

$privCats = privRights($roleRights);

//displayArray($privCats);





$outResult = array();
$outResult[] =  '<ul>'."\n";

foreach($privCats['cat'] as $pcatid)
{
	$catArr = $privCats['_all'][$pcatid];
	
	
	if(array_key_exists('_son', $catArr))
	{
		$outResult[] = '<li>'.$catArr['priv_title'].'<br>'."\n";
		$outResult[] =  '<ul class="sub1">'."\n";
		
		foreach($catArr['_son'] as $pcatsubid)
		{
			$catSubArr    = $privCats['_all'][$pcatsubid];
			$catSubTitle  = $catSubArr['priv_title'];
			$catSubType   = $catSubArr['priv_type'];
			$catSubValue   = $catSubArr['priv_value'];
			
			//echo ' - '.$catSubType.': '.$catSubTitle.'<br>';
			
			if($catSubType == 'fmod')
			{
				$outResult[] =  '<li><label><input type="checkbox" name="role_priv['.$pcatsubid.']"  '.yesNoChecked($catSubValue).' class="radio"/> '.$catSubTitle.' - '.$pcatsubid.'</label></li>'."\n";
			}
			else
			{
				
				$outResult[] =  '<li> - '.$catSubType.': '.$catSubTitle.'<br>'."\n";
				
				if(array_key_exists('_son', $catSubArr))
				{
					$outResult[] =  '<ul class="sub2">';
					foreach($catSubArr['_son'] as $psubsubid)
					{
						$catSubSubArr    = $privCats['_all'][$psubsubid];
						$catSubSubTitle  = $catSubSubArr['priv_title'];
						$catSubSubType   = $catSubSubArr['priv_type'];
						$catSubSubValue   = $catSubSubArr['priv_value'];
						
						//echo ' - - '.$catSubSubType.': '.$catSubSubTitle.'<br>';
						
						if($catSubSubType == 'fmod')
						{
							$outResult[] =  '<li><label><input type="checkbox" name="role_priv['.$psubsubid.']"  '.yesNoChecked($catSubSubValue).' class="radio"/> '.$catSubSubTitle.' - '.$psubsubid.'</label></li>'."\n";
						}
					}
					$outResult[] =  '</ul></li>'."\n";
				}
			}
		}
		
		$outResult[] =  '</ul></li>'."\n";
		
	}
	
}
$outResult[] =  '</ul>'."\n";

echo '<form name="sasa" action="kbAccountRights.php" method="post">'."\n";
echo implode("", $outResult); 
echo '<input type="submit" name="submit" value="Submit" /></form>';

if(isset($_POST['submit']))
{
	displayArray($_POST);
}

exit;
		

?>