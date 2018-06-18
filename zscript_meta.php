<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js"> <![endif]-->

<html lang="en-US" ⚡>
<head>
<meta charset="utf-8">
<!--<script async src="https://cdn.ampproject.org/v0.js"></script>-->
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1.0, maximum-scale=1">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if($this_page == 'contribute.php' or $this_page == 'profile.php') { ?>
<meta name="expires" content="tue, 01 Jun 2010 19:45:00 GMT">
<?php } ?>
<meta name="title" content="<?php echo $thisSite; ?>">
<meta name="description" content="<?php echo $meta_desc; ?>">
<meta name="keywords" content="<?php echo $meta_keywords; ?>">
<meta name="author" content="<?php echo SITE_TITLE_LONG; ?>">
<meta name="robots" content="index,follow">
<meta name="copyright" content="Copyright <?php echo date("Y"); ?> <?php echo SITE_TITLE_LONG; ?>">
<meta name="generator" content="<?php echo SITE_TITLE_LONG; ?> - http://www.<?php echo SITE_DOMAIN_URI; ?>">

<meta name="google-site-verification" content="dh4kmIlBTGqQuZUtmO0y_pfMfX9k6W3d3St3vCw8FDA" />
<meta property="og:title" content="<?php echo $my_header; ?>">
<meta property="og:description" content="<?php echo @$meta_desc; ?>" />
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo @$meta_seolink; ?>">
<meta property="og:image" content="<?php echo @$meta_image; ?>">
<meta property="og:site_name" content="<?php echo SITE_TITLE_LONG; ?>">
<meta property="fb:admins" content="507310797">  
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo $my_header; ?>" />
<meta name="twitter:description" content="<?php echo $meta_desc; ?>" />
<meta name="twitter:image" content="<?php echo $meta_image; ?>" />


<link rel="alternate" type="application/rss+xml"  href="<?php echo SITE_DOMAIN_LIVE; ?>rss.php" title="<?php echo SITE_TITLE_LONG; ?>">
<link rel="canonical" href="<?php echo @$meta_seolink; ?>"/>
<base href="<?php echo SITE_DOMAIN_LIVE; ?>"><?php /*?><?php */?> 

<title><?php echo $thisSite; ?></title>  

<link rel="alternate" href="<?php echo SITE_DOMAIN_LIVE; ?>" hreflang="en" />
<link rel="shortcut icon" href="<?php echo SITE_FAVICON; ?>" type="image/png" />


<?php if($GLOBALS['SOCIAL_CONNECT'] == true) {  ?> 
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic&amp;subset=latin" />
<?php }  ?> 

<link rel="stylesheet" type="text/css" href="assets/styles/style.css" />  
<link rel="stylesheet" type="text/css" href="assets/scripts/bootstrap/css/bootstrap-override.css" media="all" />
<link rel="stylesheet" type="text/css" href="assets/styles/maarifa_style.css" media="all" />
<link rel="stylesheet" type="text/css" href="assets/ajaxrating/js/ajaxrating.css" />  


<!--[if lte IE 8]> 
    <link rel="stylesheet" type="text/css" href="assets/styles/base_site_ie8.css" /> 
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
<![endif]-->
<!-- html5.js, mediaqueries.js for IE less than 9 -->
<!--[if lt IE 9]> 
    <script src="assets/scripts/iefix/html5shiv.js"></script> <script src="assets/scripts/iefix/html5shiv-printshiv"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
<![endif]-->


<script type="text/javascript" src="assets/scripts/jquery-1.12.3.min.js"></script>

<?php if($GLOBALS['MODULAR_ACCOUNTS'] == true) { ?>
<link rel="stylesheet" href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']; ?>css/account_custom.css" type="text/css" media="all" />
<?php } ?>

<style type="text/css">


</style>
</head>