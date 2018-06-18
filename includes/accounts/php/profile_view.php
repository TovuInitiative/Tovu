<?php
if($op == 'edit')
{
	include("includes/members/mem_profile_form.php");
	
}
else
{
	
/*$sq_acc = "SELECT `account_id`, concat_ws(' ',`namefirst`, `namelast`) as `name`, `email`, `phone`, `country`, `avatar` FROM `".$pdb_prefix."reg_account` where `account_id` = ".q_si($us_id)."; "; //echobr($sq_acc);
$rs_qry = $cndb->dbQueryFetch($sq_acc);	*/
$mem_arr = (isset($_SESSION['sess_'.$pdb_prefix.'member'])) ? $_SESSION['sess_'.$pdb_prefix.'member'] : array(); /*displayArray($mem_arr);*/


$cols_ignore = array('account_id','id_member_type','id_member_post','id_ward','id_jobgroup','id_userlevel','avatar', 'published_member');

/* if($mem_arr['id_member_type'] == 7) 
{ array_push($cols_ignore, 'ward'); } else 
{ array_push($cols_ignore, 'member_post', 'jobgroup');  }*/ 


$tb_key      = '';
$formtitle   = '';

$picsrc = substr(@$mem_arr['u_avatar'],0,3);	//EXTERNAL
	if($picsrc == 'htt' or $picsrc == 'www' or $picsrc == 'ftp' or $picsrc == 'ww2') 
	{ 
		$m_pic = $mem_arr['u_avatar']; 
	}
	else
	{

$m_pic = (@$mem_arr['u_avatar'] <> '') ? DISP_AVATARS.$mem_arr['u_avatar'] : DISP_AVATARS.'avatar_generic.png'; //;	
}

?>
<div class="row">
	<div class="col-md-9">
	
	<div class="padd10_t">
		<?php echo display_PageTitle('Account Profile', 'h3', 'txtgray'); ?>
		<form class="rwdform rwdfull">
			<div><label class="label-auto">Name: </label>
				 <div class="form-control form-mimic" style=""><div><?php echo @$mem_arr['u_fname'].' '.@$mem_arr['u_lname']; ?> &nbsp;</div></div>
			</div>
			<div><label class="label-auto">Type: </label>
				 <div class="form-control form-mimic" style=""><div><?php echo @$mem_arr['u_type'].' '; ?> &nbsp;</div></div>
			</div>
			<div><label class="label-auto">Email: </label>
				 <div class="form-control form-mimic" style=""><div><?php echo @$mem_arr['u_email']; ?> &nbsp;</div></div>
			</div>
			<div><label class="label-auto">Phone: </label>
				 <div class="form-control form-mimic" style=""><div><?php echo @$mem_arr['u_phone']; ?> &nbsp;</div></div>
			</div>
			<div><label class="label-auto">Country: </label>
				 <div class="form-control form-mimic" style=""><div><?php echo @$mem_arr['u_country']; ?> &nbsp;</div></div>
			</div>
			<div><label class="label-auto">Organization: </label>
				 <div class="form-control form-mimic" style=""><div><?php echo @$mem_arr['u_organization']; ?> &nbsp;</div></div>
			</div>	  
		
		<div><p>&nbsp;</p></div>
		</form>
	</div>
		
	</div>
	
	
	<div class="col-md-3">
	<div class="padd10">
		
		<div>
		<div class="subcolumns padd10_0 ">
			<span class="avatar-wrap">
			<img src="<?php echo $m_pic; ?>" class="avatar" style="" />
			</span>
		</div>
		</div>
		
		
		<div>
        <div class="list-group">
			<a href="profile.php?ptab=profile" class="list-group-item primary">Personal Account Information</a>
			<a href="profile.php?ptab=profile_edit" class="list-group-item">Update Account Information</a>
			<a rel="modal:open" data-href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']; ?>php/profile_edit_avatar.php?rel=modal"  class="list-group-item">Profile Avatar</a>	
			<!--ajforms.php?d=member_avatar-->		 
			<a rel="modal:open" data-href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']; ?>php/profile_edit_password.php?rel=modal" class="list-group-item">Change Password</a>
       		<!--ajmore.php?fcall=member_password-->
        </div>
			<?php /*?><a data-toggle="modal" href="#emailTenant" class="btn btn-block btn-primary btn-icon"><i class="fa fa-envelope"></i> Email John Smith</a><?php */?>
		</div>
			
	</div>
	</div>
	
	
</div>



<?php
}
?>
