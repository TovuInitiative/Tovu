<?php //require("../../classes/cls.config.php");
require('ratingdraw.php'); 
if (!empty($_GET['ri'])) { $ri = trim($_GET['ri']); } else { $ri = 1; }
if (!empty($_GET['rc'])) { $rc = trim($_GET['rc']); } else { $rc = ''; }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Multiple Ajax Star Rating Bars</title>

<?php /*?><script type="text/javascript" language="javascript" src="js/behavior.js"></script><?php */?>
<script type="text/javascript" language="javascript" src="js/ajaxrating.js"></script>

<?php /*?><link rel="stylesheet" type="text/css" href="css/default.css" /><?php */?>
<link rel="stylesheet" type="text/css" href="js/ajaxrating.css" />
</head>

<body>

<div id="container">
<?php  if($ri <> ''){ echo rating_bar($ri); } ?>
</div>

</body>
</html>