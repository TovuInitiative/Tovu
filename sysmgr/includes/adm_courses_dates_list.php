
<div class="padd10_t">
	<div class="clearfix padd10_0">
	
	<div class="col-md-8">
		<h4>Saved Dates</h4>
	</div>
	<div class="col-md-4">
		<!--<div class="padd10_t txtright bold">
			<a href="hforms.php?d=members&op=new&org_id=<?=$id?>" style="color:#FF0000" target="_blank">[ ADD NEW ]</a> 
		</div>	-->
 	</div>	
 	</div>
<?php

$sqList = "SELECT `date_record_id` as `id`, `date` as `date_post`, `location`, `venue`, `status`, 'edit' as `_action` FROM `mrfc_dt_content_dates` WHERE `id_content` = ".q_si($id)."
ORDER BY `date` ASC;";

			   //getData($disp_query, $redirect, $disp_front = 0, $title_trunc = 80, $id_label = "id", $blank=0) 
	echo $m2_data->getData($sqList,"hmore.php?d=course_date&crs_id=".$id."&", 1, 80, 'date_id', 0);
	//&id=".$id."

?>


</div>


