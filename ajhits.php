<?php session_start();
require('classes/cls.config.php');

if (isset($_POST['ht_tb'])){ $ht_tb=$_POST['ht_tb'];} else {$ht_tb=NULL;}
if (isset($_POST['ht_id'])){ $ht_id=$_POST['ht_id'];} else {$ht_id=NULL;}

if($ht_tb <>'' and $ht_id <>'')
{
	$ht_cnt = '';
	if($ht_tb == 'tb_menu') { $ht_table = ''.$pdb_prefix.'dt_menu'; }
	if($ht_tb == 'tb_cont') { $ht_table = ''.$pdb_prefix.'dt_content'; }
	if($ht_tb == 'tb_docs') { $ht_table = ''.$pdb_prefix.'dt_downloads'; $ht_cnt = 'doc'; }
	$hitsUpdate = new hitsLog;	
	$hitsUpdate->hitsAdd($ht_table,$ht_id);	
}



?>