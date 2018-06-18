<?php //require("classes/cls.constants.php"); 
header("Location: ".urldecode($_REQUEST['url']).""); exit;
$redirect = urldecode($_REQUEST['url']); ?>
<script type="text/javascript">location.href="<?php echo $redirect; ?>";</script>

