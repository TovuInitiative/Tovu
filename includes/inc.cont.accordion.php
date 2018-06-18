<?php

echo display_PageTitle($my_page_head);
 

include("includes/inc.cont.page.intro.php");

echo '<div class="accordion-wrap">';
	
/*if(array_key_exists($com_active, master::$menusChild))
{   
	foreach(master::$menusChild[$com_active] as $com_child)
	{
		$acc_header 		= master::$menusFull[$com_child]['title'];
		$acc_alias 		 = master::$menusFull[$com_child]['title_alias'];
		if($acc_alias <> '') { $acc_header = $acc_alias; }
		
		//echo '<h3>'.$acc_header.'</h3>';
		echo '<div class="accordion-box" id="acc_'.$com_child.'">';
		echo $dispData->build_Accordion($com_child);
		echo '</div>';
		
	}

} 
else
{	}*/
	
	echo '<div class="accordion-box" id="acc_'.$com_active.'">'; //
	echo $dispData->build_Accordion($com_active);
	echo '</div>';


echo '</div>';
?>
