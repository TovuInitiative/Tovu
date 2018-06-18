<?php
//echobr($us_id);
echo display_PageTitle('My Resources', 'h1');

if($op == 'list')
{
?>
	<div class="txtright txt14 bold" style="margin-top:-40px;"><a href="profile.php?ptab=resources_edit&op=new" style="color:#FF0000" >[ ADD NEW ]</a> </div>
	<div class="padd10"></div>
	<?php
 
 	$sq_crit = " WHERE `".$pdb_prefix."dt_downloads`.`posted_by` = ".q_si($us_id)."  "; /*`".$pdb_prefix."dt_content`.`published` = '1' AND */
	$sq_posted_by = "";
	/*if($us_org_id <> '' and $us_type_id == 1){
		$sq_crit .= " OR `".$pdb_prefix."dt_downloads`.`organization_id` = ".q_si($us_org_id)."  ";
		$sq_posted_by = ",  concat_ws(' ', `".$pdb_prefix."reg_account`.`namefirst`, `".$pdb_prefix."reg_account`.`namelast`) as `posted by` ";
	}*/
 
 /*`resource_file` as `filename`,*/
 
	$sqList = "SELECT `".$pdb_prefix."dt_downloads`.`resource_id` as `id`, `".$pdb_prefix."dt_downloads`.`date_created` as `date`, `".$pdb_prefix."dt_downloads`.`resource_title` as `title`, `".$pdb_prefix."dt_downloads`.`resource_description` as `description` ".$sq_posted_by.",  `".$pdb_prefix."dt_downloads`.`status`,  `".$pdb_prefix."dt_downloads`.`access_id` as `access` FROM `".$pdb_prefix."dt_downloads` LEFT JOIN `".$pdb_prefix."reg_account` ON (`".$pdb_prefix."dt_downloads`.`posted_by` = `".$pdb_prefix."reg_account`.`account_id`) ".$sq_crit." order by  `".$pdb_prefix."dt_downloads`.`date_updated` desc; ";
 	//echo $sqList;
	echo $m2_data->getData($sqList,"profile.php?ptab=resources_edit&", 1);	
}
elseif($op == 'edit' or $op == 'view' or $op == 'new')
{
	//include("includes/members/mem_resources_form.php");
}
?>
