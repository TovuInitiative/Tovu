
<?php
if(isset($_REQUEST['qst']) and is_numeric($_REQUEST['qst']) and $my_redirect <> 'result.php') {
if(array_key_exists($qst, $msge_array)) {
echo '<div id="box_alert"><div class="notify-wrap"><div class="notify-box" style="zindex:9999999 !important"><p>'.$msge_array[$qst].'</p></div></div></div>';
?>
<script language="javascript">	
function closeHelpDiv(){ var e = document.getElementById('box_alert'); if (typeof(e) == undefined) { return; } if (e.style.display == 'none') { e.style.display = ''; } else { e.style.display = 'none'; } } window.setTimeout("closeHelpDiv()", 20000);
</script>
<?php
}
}
?>


