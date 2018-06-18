<?php

include('../classes/cls.constants.php');
include('../classes/cls.functions_misc.php');
require("includes/gal_functions.php");
require("includes/adm_functions.php");


if($_SERVER['REQUEST_METHOD'] !== 'POST') { 
echo "<script language='javascript'>location.href=\"index.php?qst=401&token=".time()."\"; </script>"; exit; }

if (isset($_POST['id'])){$id=$_POST['id'];} else {$id=NULL;}
if (isset($_POST['title'])){$title=trim(htmlentities(addslashes($_POST['title'])));} else {$title=NULL;}
if (isset($_POST['details'])){$details=trim(htmlentities(addslashes($_POST['details'])));} else {$details=NULL;}
if (isset($_POST['id_gallery_cat'])){$id_gallery_cat=$_POST['id_gallery_cat'];} else {$id_gallery_cat=NULL;}
if (isset($_POST['redirect'])){$redirect=$_POST['redirect'];} else {$redirect= 'index.php?qst=401';}
if (isset($_POST['formname'])){$formname=$_POST['formname'];} else {$formname=NULL;}

//echobr($redirect); exit;
$post		= array_map("filter_data",$_POST);
$postb	   = array_map("quote_smart", $post);

//displayArray($_FILES); //['myfile']
//displayArray($post); 
//exit;

$max_size 		 = "5000000";

if($post["date_posted"] <> '') {
	$date_posted = "'".date("Y-m-d", strtotime($_POST["date_posted"]))."'"; // ".date("H:i:s")."
} else {
	$date_posted = "CURDATE()";
}

if($formname == 'gall_content')
{	

$d=date ("d");
$m=date ("m");
$y=date ("Y");
$t=time();
$dmt=$d+$m+$y+$t;    
$ran= rand(0,10000000);
$dmtran= $dmt+$ran;
$un=  uniqid();
$dmtun = $dmt.$un;
$mdun = md5($dmtran.$un);
$sort=substr($mdun, 16); // if you want sort length code.


	//$arr_parent		= NULL;
	//if(is_array($post['id_parent'])) {	$arr_parent 	= serialize($post['id_parent']); }	
	
	
	$parent_menu 	  = (array_key_exists('id_parent',$post)) ? $post['id_parent'] : '';
	$parent_cont 	= '';
	$parent_eqp	 = '';
	$parent_res	 = '';
	$parent_cont_arr	= array();
    
    
	//exit;
	if(isset($post['id_content'])) { $parent_cont   = $post['id_content'];  $parent_cont_arr['id_content'] = $parent_cont; $parent_title_cont = '`id_content`'; }
	if(isset($post['id_equipment'])) { $parent_eqp = $post['id_equipment'];  $parent_cont_arr['id_equipment'] = $parent_eqp; $parent_title_eqp = '`id_equipment`'; }
	if(isset($post['id_resource'])) { $parent_res 	= $post['id_resource'];  $parent_cont_arr['id_resource'] = $parent_res; $parent_title_res = '`id_resource`'; }
	
    if($parent_menu == '' and count($parent_cont) == 1 and $parent_cont[0] == ''){
        echo "<script language='javascript'>alert('Parent required.'); history.back(-1);  </script>"; exit;
    }
	//exit;
	//$parent_cont_arr = array('id_content' => $parent_cont,'id_equipment' => $parent_eqp,'id_resource' => $parent_res );
	
		
	$ca_section_tags   = '';
	//$ca_tags 		   = $post['tags'];
	//if(count($ca_tags) > 0) { $ca_section_tags = serialize($ca_tags); }	
	
	
	
	$id_content       = @$post['id'];
	$type		     = $post['file_type'];
	$video_name 	   = $post['video_name'];
	$video_title 	  = $post['video_title'];
	$video_caption 	= $post['video_caption'];
	
	$photo_title 	  = $post['photo_title'];
	$photo_caption 	= $post['photo_caption'];
	$id_photo		 = '';
    
    $post_title     = ($post['file_type'] == 'v') ? $video_title : $photo_title;
	

$checksum1 = crc32($photo_title);
$checksum2 = crc32(trim($_FILES['myfile']['name']));
//echo strtotime(date('d F Y')). '_'.$checksum1 . '_'.$checksum2;	/* . '_'.floor(time() / (60*60))*/
//exit;		
			
	
	if($post['file_type'] == 'v')
	{
		
		$pos 		   = strrpos($video_name,"="); 		
		if ($pos === false) { $myvidname = $video_name; }  
		else { $myvidname     = "http://www.youtube.com/embed/".substr($video_name,($pos+1)); }
		
		if(strlen($post['video_name']) > 0) 
		{			
			//$imageCheck = checkImageExist($myvidname);
			//if($imageCheck == 0){ } else { $id_photo = $imageCheck; }
					
				$sqpost="insert IGNORE into `mrfc_dt_gallery_photos`  "
				."( `title`, `filename`,  `description`, `filetype`, `id_gallery_cat`, `date_posted`, `tags`) "
				." values "
				."(".quote_smart($video_title).", ".quote_smart($myvidname).",  ".quote_smart($video_caption).",  '".$type."',   '".$id_gallery_cat."',".$date_posted.",  ".quote_smart($ca_section_tags).")";
				//echo $sqpost; exit;
				
				$cndb->dbQuery($sqpost);
				$id_photo = $cndb->insertId();
			
			
			
		}
	}
	
	if($post['file_type'] == 'p')
	{
		
		$result         = 0;
		$the_file       = basename( $_FILES['myfile']['name']);
		
		if(trim($_FILES['myfile']['name']) <> '') 
		{
			//$prefix 		= str_pad($post['id'], 5, "0", STR_PAD_LEFT);
			$myfilename 	= trim($_FILES['myfile']['name']);
			$myfilesize 	= $_FILES['myfile']['size'];
			
			if (intval($myfilesize) > intval($max_size)) 
			{ ?><script language="javascript">alert("Error. File size above <?php echo intval($max_size)/1000; ?> kb."); history.back(-2); </script><?php exit;
			}
			$pos 		   = strrpos($myfilename,"."); 
			if ($pos === false) { $pos = strlen($myfilename); }  
			
			$myfilename    = substr($myfilename,0,$pos);  
			$img_cry_name = strtotime(date('d F Y')). '_'.$checksum1 . '_'.$checksum2;
			$img_cry_name = preg_replace("/[^a-zA-Z0-9\/_|+]/", '', $img_cry_name);
			
			
			$the_image 	= imageUpload($_FILES['myfile'], $img_cry_name, UPL_GALLERY, 1 );	
			$result 	   = $the_image['result'];
			$the_file 	 = $the_image['thumb'];
			
			if($the_image['result'] == 1)
			{
				//$imageCheck = checkImageExist($the_image['name']);
				//if($imageCheck == 0){ } else { $id_photo = $imageCheck; }
				
					$sqpost="insert IGNORE into `mrfc_dt_gallery_photos`  "
					."( `title`, `filename`,  `description`, `id_gallery_cat`, `date_posted`, `tags`) "
					." values "
					."(".$postb["photo_title"].", ".q_si($the_image['name']).",  ".$postb["photo_caption"].",  '".$id_gallery_cat."', ".$date_posted.",  ".quote_smart($ca_section_tags).")";
					//echo $sqpost; exit;
					
					$cndb->dbQuery($sqpost);
					$id_photo = $cndb->insertId();
				
			}	
		}
		elseif(trim($post['image_link']) <> '' )
		{
			//$imageCheck = checkImageExist($post['image_link']);				
			//if($imageCheck == 0){ } else { $id_photo = $imageCheck; }
			
				$sqpost="insert IGNORE into `mrfc_dt_gallery_photos`  "
				."( `title`, `filename`,  `description`, `id_gallery_cat`, `date_posted`, `tags`) "
				." values "
				."(".quote_smart($post['photo_title']).", ".quote_smart($post['image_link']).",  ".quote_smart($post['photo_caption']).",  '".$id_gallery_cat."', ".$date_posted.",  ".quote_smart($ca_section_tags).")";

				//echo $sqpost; exit;
				$cndb->dbQuery($sqpost);	
				$id_photo = $cndb->insertId();
			
	
		}
		
		
	}
	
    
    
	if($id_photo <> '')
	{ 
	/* ============================================================================================= */
	/* POPULATE -- PROJECT >>> LINKS */
	//$ddSelect->populateProjectLinks('id_gallery', $id_photo, $post['sector_id'], $post['project_id']);
	/* --------------------------------------------------------------------------------------------- */
	
		$record_stamp	 = time();
		
		if(is_array($parent_menu) and count($parent_menu)> 0 )
		{	
			for($i=0; $i <= (count($parent_menu)-1); $i++) 
			{  
				if($parent_menu[$i] <> '')
				{
					$seq_pic_parent[]  = " insert IGNORE into `mrfc_dt_gallery_photos_parent` ( `id_photo`,`id_link`,`rec_stamp`) values "
										." (".$id_photo.", '".$parent_menu[$i]."', '".$record_stamp."')  ";
				}
			} 
		}
		
		
		if(is_array($parent_cont_arr) and count($parent_cont_arr) > 0 )
		{	
			foreach($parent_cont_arr as $parent_cat => $parent_cat_arr) 
			{  
				
				if(count($parent_cat_arr) > 0)
				{
					foreach($parent_cat_arr as $parent_val) 
					{ 
                        if($parent_val <> ''){
						      $seq_pic_parent[]  = "insert IGNORE into `mrfc_dt_gallery_photos_parent` (`id_photo`,`".$parent_cat."`,`rec_stamp`) values "
											." (".quote_smart($id_photo).", ".quote_smart($parent_val).", '".$record_stamp."')  ";
                        }
					}
				}
			} 
		}
		
		/*if(is_array($parent_cont) and count($parent_cont)> 0 )
		{	
			for($i=0; $i <= (count($parent_cont)-1); $i++) 
			{  
				if($parent_cont[$i] <> '')
				{
		$seq_pic_parent[]  = "insert IGNORE into `mrfc_dt_gallery_photos_parent` (`id_photo`,`id_content`,`rec_stamp`) values "
		." (".$id_photo.", '".$parent_cont[$i]."', '".$record_stamp."')  ";
		$seq_pic_update[] = " update `mrfc_dt_content` set `yn_gallery`= '1' WHERE `id` = '".$parent_cont[$i]."'; ";
				}
			} 
		}*/
			
		//displayArray($seq_pic_parent); exit;
		$cndb->dbQueryMulti($seq_pic_parent);
        
        
        /* ======= @@ Activity Log ======================= */
        $log_detail = 'Name: '.$post_title.' [Status: Yes]'; $post_id = $id_photo;
        $formLog->formsUserLogs('gallery_adm', '_new', $post_id, $log_detail . ' [By: '.$sys_us_admin['adminemail'].']' );
        /* =============================================== */
		
		saveJsonGallery();
	}
}
    //exit;
   //sleep(1);
?>

<script type="text/javascript"> location.href = "<?php echo $redirect; ?>&token=<?php echo time(); ?>"; </script>

<?php /*?><script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result; ?>, '<?php echo $the_file; ?>');</script>  <?php */?> 
