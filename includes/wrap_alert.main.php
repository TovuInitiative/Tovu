<?php 
if(array_key_exists($qst, $msge_array)) 
{
	if($com_active == 1) { $my_page_head = ''; }
	echo '<h1 class="lineGray">'.$my_page_head.'</h1>';
	echo '<div style="margin:20px 0;" class="note curvy"><div class="txt17">'.$msge_array[$qst].'</div>';
	echo '<p>&nbsp;</p>';
	echo '</div>';
}
else
{
	echo '<h1 class="lineGray">'.$my_page_head.'</h1>';
	echo '<div style="margin:20px;" class="note curvy"><div class="txt17">Error:';
	echo '<p>The page you are looking for does not exist on this server.</p></div></div>';
}
?>