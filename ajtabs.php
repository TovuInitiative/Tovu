<?php require("classes/cls.constants.php"); include("classes/cls.paths.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_GET['tab']) and is_numeric($_GET['tab'])) { $tab = $_GET['tab'];} else { $tab=1; }
$cmt_sec = (isset($request['cmt_sec'])) ? $request['cmt_sec'] : 'about';

//echobr($cmt_sec);


    $tab_title['about']     = 'About';
    $tab_title['news']      = 'News and Events';
    $tab_title['stories']   = 'Good Practices';
    $tab_title['resources'] = 'Resources';
    $tab_title['projects']  = 'Projects';
    $tab_title['members']   = 'Members';
    
?>


<div id="content" class="padd15_t">  
<?php 


/* ========================================== */
/* @@ ABOUT */
if($cmt_sec == 'about'){
    ?>
    <div class="subcolumns">
		<?php //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cmt_sec] .' </span>', '', 'nobold' );  ?>
			
			<div style="text-align: justify;"><?php echo $committee_detail['description']; ?></div>
			
		</div>
    <?php
}
/* ------------------------------------------ */


/* ========================================== */
/* @@ NEWS */
if($cmt_sec == 'news' or $cmt_sec == 'stories'){
    ?>
    <div class="subcolumns">
		<?php 
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cmt_sec] .' </span>' ); 
            $data_arr = $dispDt->get_commiteeTabContent($cmt_id, $cmt_sec);
            //displayArray($data_arr);
    
            if(count($data_arr) > 0)
            {  include("includes/committee/inc.content.list.php"); } else
            {  echo display_noContent(); }
        ?>
			
		</div>
    <?php
}
/* ------------------------------------------ */    
    
    

/* ========================================== */
/* @@ RESOURCES */
if($cmt_sec == 'resources'){
    ?>
    <div class="subcolumns">
		<?php 
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cmt_sec] .' </span>' ); 
    
            $data_arr = $dispDt->get_commiteeTabContent($cmt_id, $cmt_sec);
            //displayArray($data_arr);
            //echobr($cmt_id);
    
            if(count($data_arr) > 0)
            {  include("includes/committee/inc.resources.list.php"); } else
            {  echo display_noContent(); }
        ?>
			
		</div>
    <?php
}
/* ------------------------------------------ */    
    

/* ========================================== */
/* @@ FORUMS */
if($cmt_sec == 'forums'){
    ?>
<div class="subcolumns">
        <div>
            <?php 
            //displayArray($request);
            $fc= (isset($request['fc'])) ? $request['fc'] : 'home';

            switch ($fc){
                case 'home':
                    include("includes/forum/inc.forum.home.php");
                    break;

                case 'category':
                    include("includes/forum/inc.forum.category.php");
                    break;

                case 'topic':
                    include("includes/forum/inc.forum.topic.php");
                    break;

                case 'reply':
                    include("includes/forum/inc.forum.reply.php");
                    break;
            }
             ?>
        </div>

</div>
    <?php
}
/* ------------------------------------------ */  
    

/* ========================================== */
/* @@ MEMBERS */
if($cmt_sec == 'members'){
    ?>
    <div class="subcolumns">
		<?php 
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cmt_sec] .' </span>' ); 
            $data_arr = $dispDt->get_commiteeMembers('members', '', $cmt_id);
            //displayArray($data_arr);
    
            if(count($data_arr) > 0)
            {  include("includes/committee/inc.cont.profile.list.php"); } else
            {  echo display_noContent(); }
        ?>
			
		</div>
    <?php
}
/* ------------------------------------------ */    


?>  	

</div>

  
</body>
</html>


