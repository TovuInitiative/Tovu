<?php require '../classes/cls.constants.php'; 
//echobr($this_page);
//displayArray($_SESSION['sess_mrfc_admin']); 
//exit;
if($this_page == 'index.php') 
{
    if(isset($_SESSION['sess_mrfc_admin']['adminname'])) {  ?> <script language="javascript">location.href="home.php?tk=<?php echo time(); ?>";</script> <?php exit; }
} else {
    if(!isset($_SESSION['sess_mrfc_admin']['adminname'])) { ?> <script language="javascript">location.href="index.php?tk=<?php echo time(); ?>";</script> <?php exit; }
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link href="<?php echo SITE_LOGO; ?>" rel="shortcut icon" type="image/png" />
	<title>Admin:: </title>
	<meta name="expires" content="tue, 01 Jun 2010 19:45:00 GMT">
	<!--<meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />-->
	
	<link href="css/style.default.css" rel="stylesheet">
	<link href="css/style.katniss.css" rel="stylesheet">
		
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->


<link rel="stylesheet" type="text/css" href="../assets/scripts/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="../assets/scripts/multiselect/jquery.multiselect.filter.css" />
<link rel="stylesheet" type="text/css" href="../assets/scripts/datatable/jquery.dataTables.css" />

<!--<link rel="stylesheet" type="text/css" href="styles/data_table.css" />-->
<link rel="stylesheet" type="text/css" href="../assets/scripts/datepick/jquery.datepick.css" id="theme">

<link rel="stylesheet" type="text/css" href="../assets/scripts/datatable/smoothness/jquery-ui-1.10.2.css" />
<link rel="stylesheet" type="text/css" href="../assets/scripts/datatable/smoothness/jquery-ui-1.8.4.custom.css" />
<link rel="stylesheet" type="text/css" href="../assets/scripts/datatable/jquery.dataTables.override.css" />
<link rel="stylesheet" type="text/css" href="../assets/styles/font-awesome/font-awesome.css" />

<style type="text/css" media="all">
/*@import url('../styles/base_styles.css');*/
<?php if($this_page == 'index.php'){ echo "@import url('css/login.css');"; } ?>
@import url('../assets/styles/base_forms.css');
@import url('../assets/styles/base_forms_new.css');
@import url('../assets/styles/base_grid.css');
@import url('../assets/styles/base_overrides.css');/**/

	table tr td { vertical-align: top;}
	table { width: 100%; }
.thumbnail{color: #333399;position: relative;z-index: 0;}
.thumbnail:hover{background-color: transparent;z-index: 50;}
.thumbnail span{ /*CSS for enlarged image*/position: absolute;background-color: lightyellow;padding: 5px;left: -1000px;border: 1px dashed gray;visibility: hidden;color: #333399;text-decoration: none;}
.thumbnail span img{ /*CSS for enlarged image*/border-width: 0;padding: 2px;}
.thumbnail:hover span{ /*CSS for enlarged image on hover*/visibility: visible;top: 0;left: 60px; /*position where enlarged image should offset horizontally */}
.homelargeimage {width:250px; }
.homesmallimage {width:148px;}
	
/* ============================================================================================= */
/* TABS
/* --------------------------------------------------------------------------------------------- */

.tabscontainer { margin-top: 0px; width: 100%; border-top: 0px solid #CCC; }
.navcontainer ul { background-color: #5F707AX; border-bottom:1px solid #DFDFDF; border-top:0px solid #DFDFDF; margin:0pt; padding:0pt; width:100%; height: 40px; }
.navcontainer ul li { margin:0pt; padding:0pt; display: inline-block; text-align: center; float:left; }
.navcontainer ul li a:hover{ background-color:#ECECEC; text-decoration:none !important; }
.navcontainer ul li a { border:1px dotted #DFDFDF !important; background-color: #FAFAFA; color:#807E7E; padding:0 20px 0 10px; text-decoration:none; height: 40px; line-height: 40px; display:block; margin-right:1px; text-decoration:none; }
.navcontainer ul li a.active{ border:1px solid #DFDFDF !important; border-bottom: none !important; border-right:1px solid #f00; background-color: #FFF !important;	 font-weight: bold; color: #666; }
.tabscontent{ /*min-height: 200px;*/ padding: 10px 2px; }
.tabsloader, .pgtabsloader { z-index: 1001; padding: 0px; text-align: center; background-color: transparent; border: 0px solid #000000; }
.pgtabsloader { /*position:absolute; top:50px; left:40%;*/ width:100px; height:30px; margin:0 auto; background:url(../assets/image/icons/a-loader.gif) 50% 50% no-repeat;}

.tabscontent .content,
.pgtabscontent .content{ display: none; }
	
/*-------------------------------------------------------------------------------------------------------
@ FORMS - VALIDATION
-------------------------------------------------------------------------------------------------------*/

input.error, textarea.error, select.error { border:1px solid #FF0000 !important;  background:url("../image/icons/invalid.png") no-repeat 100% 7px #FEF7F7 !important; }
select.error, input.txtright.error { background-position: 3px 50% !important; padding-left: 17px; }
input[type=radio].error,
input[type=checkbox].error {  padding-left:80px !important; width:30px !important; margin:0 !important; display:inline-block !important; background: #ff0000 !important;  }
input[type=radio].error:after,
input[type=checkbox].error:after{content:"!";display:block; color:#f00; }
label.label-checkbox input.error { color: #f00 !important;}

label.error, span.error { font-size:11px; color: #FF0000 !important; display:none; font-weight:normal; 
background:none; text-transform:none; padding-top: 0px; padding-bottom: 0px; border: none;  }

div.errorBox {
	background-color: #fee; color: #400; border: 2px #844 solid; padding: 10px; /*font-size: 120%;*/
	margin: 5px 0; text-align:center; display: none; 
}
input#nah_snd { float:left; visibility:hidden !important; margin:0 !important; padding:0 !important; height:0 !important; width:0 !important; }	
</style>	


<script src="../assets/scripts/jquery-1.12.3.min.js"></script>

<?php
if( $this_page == "hforms.php")
{ $dispData->buildMenu_Arr(); $dispData->buildContent_Arr(); }

?>	
</head>

<?php
if($op=="edit"){ $title_new	= "Edit "; } elseif($op=="new") { $title_new	= "New "; }	
	echo $this_page;
?>
<body class="tooltips has-top-notification stickyheader ">