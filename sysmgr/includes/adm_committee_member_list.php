
<div class="padd10_t">
	<div class="clearfix padd10_0">
	
	<div class="col-md-8">
		<h4>Committee Members</h4>
	</div>
	<div class="col-md-4">
		<!--<div class="padd10_t txtright bold">
			<a href="hforms.php?d=members&op=new&org_id=<?=$id?>" style="color:#FF0000" target="_blank">[ ADD NEW ]</a> 
		</div>	-->
 	</div>	
 	</div>
<?php

$sqList = "SELECT
    `mrfc_app_committee_members`.`record_id` as `id`
    , `mrfc_app_profiles`.`leader_name`
    , case when(`mrfc_app_committee_members`.`leader_role_id` = 1) then 'Chair' else 'Member' end as `role`
    , `mrfc_reg_county`.`county`
    , `mrfc_app_committee_members`.`status_id` as `active`
    , 'edit' as `_action`
FROM
    `mrfc_app_committee_members`
    INNER JOIN `mrfc_app_profiles` 
        ON (`mrfc_app_committee_members`.`leader_id` = `mrfc_app_profiles`.`leader_id`)
    INNER JOIN `mrfc_reg_county` 
        ON (`mrfc_app_profiles`.`county_id` = `mrfc_reg_county`.`county_id`)
WHERE (`mrfc_app_committee_members`.`committee_id` = ".q_si($id).")
ORDER BY `mrfc_app_committee_members`.`leader_role_id` ASC, `mrfc_app_profiles`.`leader_name` ASC; ";

			   //getData($disp_query, $redirect, $disp_front = 0, $title_trunc = 80, $id_label = "id", $blank=0) 
	echo $m2_data->getData($sqList,"hmore.php?d=committee_member&comm_id=".$id."&", 1, 80, 'rec_id', 0);
	//&id=".$id."

?>


</div>


