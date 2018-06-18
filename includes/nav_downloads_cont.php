
<?php
if($item)
{
$dispData->siteDocuments();

if(array_key_exists($item, master::$listResources['_cont'])) 
{
	$cont_docs	 = master::$listResources['_cont'][$item];

	$fcontent	  = '';
	$highlite_img = "";
	$highlite_cls = "";
	$highlite_flash = "";
	foreach($cont_docs as $file_val)
	{
		$file_arr 	    = master::$listResources['full'][$file_val]; 
		
		$file_id         = $file_arr['cont_id'];
		$file_title      = $file_arr['cont_title'];
		$file_type 	   	 = $file_arr['cont_type'];
		$file_name       = $file_arr['cont_name'];
		$file_date		  = date("Y, M d", strtotime($file_arr['cont_date']));
		$file_desc	   	 = string_truncate(strip_tags_clean($file_arr['cont_brief']), 150);			
		$file_cat        = $file_arr['cont_parent_type'];
		$file_cat_id     = $file_arr['cont_parent_id'];
		$file_seo        = $file_arr['cont_seo'];
		
		$parent_seo		 = 'resource';
		$parent_name   	 = @master::$contMain['full'][$file_cat_id]['title'];				
		
		
		$item_cat 	  = '';  
			
		/*if($file_date > $date_spotlite) 
		{ $highlite_img = " <span style=\"background:url(image/icons/icon-newb.png) no-repeat 50% 100%; width:27px;height:16px;display:inline-block;\">&nbsp;</span> "; $highlite_cls = ""; $highlite_flash = " rel=\"flashfg[red]\""; 
		}*/
		
		$item_protocol = substr($file_name,0,3);
		$item_ext      = strtolower(substr(strrchr($file_name,"."),1));
		
		//EXTERNAL
		if($item_protocol == 'htt' or $item_protocol == 'www' or $item_protocol == 'ftp' or $item_protocol == 'ww2') 
		{ $link = $file_name;  } else 
		{ 
			//$link = CONF_LINK_DOWNLOAD.$com_base."res_id=".$file_id; 
			$link = "resource/".$file_seo;
		}	
		
		$item_link = "<a href=\"$link\" class=\"linkRes $item_ext $highlite_cls\"  data-id=\"$file_id\" $highlite_flash target=\"_blank\" title=\"Click to download\">".$highlite_img.$file_title.$item_cat."</a>";
				
		$fcontent .=  "<li>".$item_link."</li>";
		
		
	}
?>
<p>&nbsp;</p>
	<div class="section-title"><h4>Attached Files</h4> </div>
	<div>
		<div class="padd5">
		<ul class="nav_dloads">
		<?php echo $fcontent; ?>
		</ul>
		</div>
	</div>
<?php
}
	
}
?>
	