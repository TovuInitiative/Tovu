<?php

class displays extends master
{
	var $errors = array();		// array of errors
	var $error_string;			// error string
	var $num_rows;               // number of rows retrieved
	var $num_fields;
	var $res_fields;
	var $field_names = array();
	//var $dbconn;
	var $result;
	
	var $disp_query;
	var $disp_query2; 
	var $redirect; 
	var $id; 
	var $cat; 
	var $page;
	var $page_back;
	var $addir;
	var $com; var $com2; var $com3; var $fc_code; var $pg_code; var $stat; var $item;
	
	function getCount($disp_query) {
		$this->result=$this->dbQuery($disp_query); 
		$this->num_fields = mysqli_num_fields($this->result);		
		$this->res_fields = mysqli_fetch_fields($this->result);
		$this->num_rows = $this->recordCount($this->result);
	}
	
	function stringExists($input){
		$result = false;
		$pattern[] = '/amount/';
		$pattern[] = '/allowance/';
		$pattern[] = '/tax/';
		$pattern[] = '/%/';
		$pattern[] = '/balance/';
		
		foreach($pattern as $string)
		{
		  if(strpos($input, $string) !== false) 
		  {
			return true;
			break;
		  }
		}
		return false;
	}
	
		
	function getData($disp_query, $redirect, $disp_front = 0, $title_trunc = 80, $id_label = "id", $blank=0, $dt_table_class = "display") 
	{
		//$this->connect() or trigger_error('SQL', E_USER_ERROR);
		$this->getCount($disp_query);
		//echobr($this->addir);
		$fieldType = array();
		
		$us_type_id  = @$_SESSION['sess_mrfc_member']['u_type_id'];
		
		$op_label = "op=edit&";
		if($disp_front ==1) { $op_label = "op=view&"; } 
		
		$tbHeadCols = "";
		$tbFootCols = "";
		$colAlign   = "";
		
		echo "<form method=\"post\" action=\"adm_posts.php\">
		<div class='table-responsive manage'>
		<table border=0 cellpadding='0' cellspacing='0' width='100%' class='$dt_table_class table table-hover ' id='example'>
		<thead><tr>"; 
			if($disp_front ==0)
			{
			$tbHeadCols .= ""; //"<th class='len-short'>#</th>";
			$tbFootCols .= ""; //"<th>&nbsp;</th>";
			}
			//echobr($this->num_fields); exit;
			for ($i = 0; $i<($this->num_fields); $i++)						// Field Names
			{
				
				
				$field_names[$i] = $this->res_fields[$i]; //mysql_fetch_field($this->result, $i);
				$fieldHead = clean_title($field_names[$i]->name);
				$fieldType[$i] = strtolower($this->fieldTypeText($field_names[$i]->type));
				
				$colnamePrefix = substr($field_names[$i]->name,0,4);
				
				$colAlign = (stringExists($field_names[$i]->name))? " txtright" : "";
					
				
				if ($field_names[$i]->name!="show" and 
					$field_names[$i]->name!="mail"  and 
					$field_names[$i]->name!="active" and  
					$field_names[$i]->name!="visible" and 
					$field_names[$i]->name!="expired" and 
					$field_names[$i]->name!="current" and 
					$field_names[$i]->name!="cnfmd" and 
					$field_names[$i]->name!="pos." and
					$field_names[$i]->name!="seq" and 
					$field_names[$i]->name!="year" and 
					$field_names[$i]->name!="items"  and 
					$field_names[$i]->name!="signs"  and
					$field_names[$i]->name!="comments"  and 
					$field_names[$i]->name!="entries"  and 
					$field_names[$i]->name!="pics"  and 
					$field_names[$i]->name!="approved"  and 
					$field_names[$i]->name!="hits"  and 
					$field_names[$i]->name!="access"  and 
					$field_names[$i]->name!="featured"  and 
					$field_names[$i]->name!="top"  and 					
					$field_names[$i]->name!="side" and
					$field_names[$i]->name!="access" and
					$colnamePrefix != "num_" ) 
					{
				
					if($fieldType[$i] <> "int" and $fieldType[$i] <> "long")
					{
						
						$hideDtFilter = "";
						//
						
						if ($field_names[$i]->name!="parent" and
							$field_names[$i]->name!="section" and 
							$field_names[$i]->name!="menu type" and 
							$field_names[$i]->name!="sector" and 
							$field_names[$i]->name!="status" /*and 
							$field_names[$i]->name!="date"*/ )
						{
							$hideDtFilter = ""; //"skip-filter";
						}
						
						
						if ($field_names[$i]->name!="portal" and $field_names[$i]->name!="gall_path")
						{
						$tbHeadCols .= "<th class='".$colAlign."'>".$fieldHead."</th> ";
						$tbFootCols .= "<th>&nbsp;</th>";
						}
					} 
				} else {
					$small_col = "";
					$small_col_title = "";
					
					if($field_names[$i]->name =="featured" or 
					   $field_names[$i]->name =="approved" or 
					   $field_names[$i]->name =="hits" or 
					   $field_names[$i]->name =="show" or 
					   $field_names[$i]->name =="active" or 
					   $field_names[$i]->name =="cnfmd" or 
					   $field_names[$i]->name =="visible" or 
					   $field_names[$i]->name =="expired" or 
					   $field_names[$i]->name =="access" or 
					   $field_names[$i]->name =="pos.")
					{
						$small_col = "small_col"; $small_col_title = " title='".$fieldHead."' ";
					}
					//if($colnamePrefix == "num_"){
					//	$fieldHead = substr($field_names[$i]->name,4,10);
					//}
					
					$tbHeadCols .= "<th class='".$small_col."' ".$small_col_title.">".$fieldHead."</th>";
					$tbFootCols .= "<th>&nbsp;</th>";
				}
			}
		
		
		//displayArray($fieldType);
		
		if($disp_front ==0)
		{	
			$tbHeadCols .= "<th class='len-short'>...</th>";
			$tbFootCols .= "<th>&nbsp;</th>";
		}
		echo $tbHeadCols;
		echo "</tr></thead>";
		echo "<tfoot><tr>".$tbFootCols."</tr></tfoot>";
		echo "<tbody>";
		$rn=1;
			while ($field_data = $this->fetchRow($this->result)) 			// Row Data
			{ 
				if (($rn/2)==intval($rn/2)){$bg=" class='even'";} else { $bg=" class='odd'"; }
				echo "<tr>"; // $bg
				
				
				if($disp_front ==0)
				{ /*echo "<td>$rn</td>";*/ }
				
				for ($f=0 ; $f<=($this->num_fields-1); $f++) 
				{
					$tdMax = "";
					$field = "";
					$field = $field_data[$f]; 
					//$fieldType
					
					$link_redirect = $redirect;	
					$link_modal    = "";		
					$link_blank		= ($blank <> 0) ? " target='_blank' " : "";
					
					$pos = (stringExists($field_names[$f]->name)) ? " align=right" : "";	//$pos=" align=left ";
					
					if($this->addir=="articles" or $this->addir=="profiles" or $this->addir=="articles") {
						if($field_data["id_section"] == 6)
						{ $link_redirect = "hforms.php?d=events&"; }						
						elseif($field_data["id_section"] == 7)
						{ $link_redirect = "hforms.php?d=courses&"; }
						elseif($field_data["id_section"] == 18)
						{ $link_redirect = "hforms.php?d=profiles&"; }
					}
					
					
					$link_redirectb = $link_redirect.$op_label."".$id_label."=".$field_data[0];
					
					if($this->addir=="sitting_allowancesX" or $this->addir=="member_allowanceX") 
					{
						//$link_redirectb = "ajmore.php?d=".$this->addir."&fy=".$fyear."&fm=".$fmonth."&acc=".$fmember."&ftype=".$ftype;
						$link_modal    = " rel='modal:open' ";
					}
					
					$colnamePrefix = substr($field_names[$f]->name,0,4);
					
						//echo $field_names[$f]->name;
						if ( $field_names[$f]->name=="title" or 
							 $field_names[$f]->name=="name" or 
							 //$field_names[$f]->name=="committee" or 
							 $field_names[$f]->name=="user post" or 
							 $field_names[$f]->name=="organization_name" ) {
							
							$isChild = "";
							$field = strip_tags_clean(clean_output($field));
							$field = smartTruncateNew($field, $title_trunc);
												
							$field = $isChild . "<a href='".$link_redirectb."' ".$link_modal." ".$link_blank.">$field</a>"; 
							echo "<td>".$field."</td>"; 
							//
						} 	
						
						
						elseif ( $field_names[$f]->name=="email") {
							$rc_email_lebo = "";
							$rc_email_fild = "";
							if(strlen(trim($field)) > 5)
							{
					$rc_email_fild = "<input type='hidden' name='ac_email[".$field_data[0]."]' value='".$field."' >";
					//$rc_email_link = $field;								
					//$rc_email_arr = @preg_split("/@/", $field);  $rc_email_text = $rc_email_arr[0];
					//$rc_email_lebo = "<a href='mailto:".$field."' title='Send email: ".$field."'>".$rc_email_text."</a>";
							}
							$rc_email_lebo = $field;
							echo "<td >" . $rc_email_lebo . $rc_email_fild . "</td>"; 
						} 
						
						elseif ( $field_names[$f]->name=="location") {
							$location_lebo = "";
							
							if(strlen(trim($field)) > 5)
							{
								$arr_extras			= @unserialize($field); 
								if(is_array($arr_extras)) {
									$location_lebo = $arr_extras['location'];
									$book_form = $arr_extras['book_form'];
									$book_amount = $arr_extras['book_amount'];
								}
								else { $location_lebo = $field; } 
							
							}
							echo "<td >" . $location_lebo . "</td>"; 
						} 
					
						elseif ( $field_names[$f]->name=="course_cost") {
							$location_lebo = "";
							
							if(strlen(trim($field)) > 5)
							{
								$arr_extras			= @unserialize($field); 
								if(is_array($arr_extras)) {
									$lebo_cost = $arr_extras['cost'];
									$lebo_duration = $arr_extras['duration'];
									$lebo_duration_type = $arr_extras['duration_type'];
								}
								else { $lebo_cost = $field; } 
							
							}
							echo "<td >" . $lebo_cost . "</td>"; 
						} 
						
						elseif ( $field_names[$f]->name=="item_count") {
							
							$location_lebo = "";							
							$item_arr = @unserialize($field); 
							if(is_array($item_arr)) {
								$location_lebo = count($item_arr) . " entries";
							}
							echo "<td >" . $location_lebo . "</td>"; 
						} 
						
                        elseif ( $field_names[$f]->name=="post_type") {
							
							$lebo = "";							
							$item_arr = @unserialize($field); 
							if(is_array($item_arr)) {
								$lebo = implode(', ', $item_arr);
							}
							echo "<td >" . $lebo . "</td>"; 
						} 
                    
						elseif ( $field_names[$f]->name=="has booking") {
							$booking_lebo = "No ";
							$booking	  = 0;
							$book_amount  = "";
							
							if(strlen(trim($field)) > 5)
							{
								$arr_extras			= @unserialize($field); 
								$booking 			   = @$arr_extras['book_form'];
								
								if($booking == '1') { 
									$book_amount   = (@$arr_extras['book_amount'] > 0) ? "@".@$arr_extras['book_amount'] : ""; 
									$booking_lebo  = "Yes "; //"<img src='image/on.png'>";
								}
							
							}
							echo "<td >" . $booking_lebo ." &nbsp; ". $book_amount . "</td>"; 
						} 
						
						
						elseif ($field_names[$f]->name!="show"  and
								$field_names[$f]->name!="mail"  and
								$field_names[$f]->name!="active"  and 
								$field_names[$f]->name!="published"  and 
								$field_names[$f]->name!="current"  and 
								$field_names[$f]->name!="expired"  and 
								$field_names[$f]->name!="cnfmd"  and 
								$field_names[$f]->name!="pos." and 
								$field_names[$f]->name!="seq" and 
								$field_names[$f]->name!="image" and 
								$field_names[$f]->name!="items" and
								$field_names[$f]->name!="signs" and
								$field_names[$f]->name!="visible" and
								$field_names[$f]->name!="comments" and
								$field_names[$f]->name!="pics" and
								$field_names[$f]->name!="approved" and
								$field_names[$f]->name!="hits" and
								$field_names[$f]->name!="entries" and
								$field_names[$f]->name!="featured" and 
								$field_names[$f]->name!="surrendered" and 
								$field_names[$f]->name!="access" and 
								$field_names[$f]->name!="side" and
								$field_names[$f]->name!="_action" and								
								$colnamePrefix != "num_"
								) 
							{							
							
							if($fieldType[$f] <> "int" and $fieldType[$f] <> "long")
							{ 
								if($fieldType[$f]=="real"){ /*$pos=" align=left ";*/  } 
								else 
								{ 
									/*$pos="";*/
									$field = $field_data[$f]; 
									
										if( $fieldType[$f]=="timestamp" or
											$fieldType[$f]=="datetime" or
											$fieldType[$f]=="date") 
										{
											if($field <> '') {
											$field		= date("M d Y",strtotime($field)); }
											$tdMax = " nowrap";
										}
										
										elseif( $fieldType[$f]=="time") 
										{
											if($field <> '') { $field = date("h:i a",strtotime($field)); }
										}
										
										elseif( $field_names[$f]->name=="link" or
											$field_names[$f]->name=="filename" or
											$field_names[$f]->name=="parent") 
										{
											$tdMax = "";// " style=\"max-width:250px;\"";	
											
											//$field 	  = trim(strip_tags(html_entity_decode(stripslashes($field))));
                                            $field = strip_tags_clean(clean_output($field));
											
																			
											$patterns[0] = "/http:\/\//";
											$patterns[1] = "/https:\/\//";
											$patterns[2] = "/www./";
											$patterns[3] = "/\/\//";
											$patterns[4] = "/youtube.com\/embed\//";
											
											$field_lebo = preg_replace($patterns,'',$field);
											
											
											$field_path  = '';
											$small_pic   = '';
											
											$lbit 		= substr($field,0,3);	
											if($lbit == 'htt' or $lbit == 'www' or $lbit == 'ftp' or $lbit == 'ww2') 
											{ $field_path = ''; }
											else
											{ $field_path = @$field_data['gall_path'];  
											  $small_pic = DISP_IMAGES.$field_path.$field;}
											
											if(trim($field_path) <> '')
											{
												$field = '<a class="thumbnail">'.$field_lebo.'<span><img src="'.$small_pic.'" class="homesmallimage"/></span></a>';
											}
											else
											{
												$field = '<span title="'.$field.'">'.$field_lebo.'</span>'; 
											}
																			
										}	
										
										elseif( $field_names[$f]->name=="parent_item") 
										{
											//$field = clean_output($field);
                                            $patterns[0] = "/MENU::/";
											$patterns[1] = "/CMTE::/";
											$patterns[2] = "/CNTY::/";
											
											$field_lebo = preg_replace($patterns,'<br>',$field);
											
											$field = smartTruncateNew($field, $title_trunc);
                                            
										}
										
										else
										{
											$tdMax = ""; //" style=\"max-width:150px;\"";
											
											$field = strip_tags_clean(clean_output($field));
											$field = smartTruncateNew($field, $title_trunc);
										}
								}
								
								if($this->addir=="sitting_allowances" or $this->addir=="allowances") //member_allowance
								{ // or $this->addir == 'member_allowance_comm'
									if( $field_names[$f]->name=="sitting_month") 
									{ $field = displayMonthName($field); //. " &nbsp; &nbsp;<a href='".$link_redirectb."' ".$link_modal." class='txt10'>&lt; MORE &gt;</a>";  
									}
									
									if( $field_names[$f]->name=="total_allowance" and $num_sittings>1) 
									{ $field = $field . " &nbsp; &nbsp;<a href='".$link_redirectb."' ".$link_modal." class='txt10'>&lt; MORE &gt;</a>";  }
								}
					
								if ($field_names[$f]->name <> 'gall_path') /* COLUMN DONT DISPLAY */
								{
									echo "<td $pos $tdMax>".$field."</td>";
								}
									$field='';
							}
						} 
						
						elseif ($field_names[$f]->name=='image') {
						 	
							$pos=" align=left "; 
							
							$field_name = strip_tags_clean(clean_output($field));
							$field = smartTruncateNew($field_name, 20);
							
							if($disp_front == 1)
							{
								$field="<img src='".$field_name."' style='width:32px; height:32px;'>";
							}
							echo "<td $pos>".$field."</td>";							
						}
						
						elseif ($field_names[$f]->name=="mail" or 
								$field_names[$f]->name=="current" or 
								$field_names[$f]->name=="cnfmd" or 
								$field_names[$f]->name=="approved" or
								$field_names[$f]->name=="side" or
								$field_names[$f]->name=="top" or
								$field_names[$f]->name=="featured" or
								$field_names[$f]->name=="surrendered" or
								$field_names[$f]->name=="expired" or
								$field_names[$f]->name=="visible") 
						{
							
							$overdue = '';
							if($this->addir=="member_imprests" and $field_names[$f]->name=="surrendered" and $field<>1) {
								$date_diff = dateDifference($field_data["date_due"]);
								if($date_diff < 0)
								{ $overdue = '<span class="label label-warning" title="Overdue">Overdue</span>'; }
								if($field == 2)
								{ $overdue = '<span class="label label-info" title="Deducted">Deducted</span>'; }
								
							}
							
							//
							/*if($field==0)  
							{$field="<img src='".DISP_IMAGES."icons/ico_off.png'>";} else  
							{$field="<img src='".DISP_IMAGES."icons/ico_on.png'>";} //  class='center'*/
							
							if($field==0 or $field==2)  {$field="No";} elseif($field==1)  {$field="Yes";}
							$lebo_color = ' class="label label-'.strtolower($field).'" ';							
							$lebo_field = '<span'.$lebo_color.'>'.$field.'</span>';
							
							echo "<td>".$lebo_field." ".$overdue."</td>";
						}
						
						
						elseif ($field_names[$f]->name=="show" or
								$field_names[$f]->name=="active" or 
								$field_names[$f]->name=="published" or 
								$field_names[$f]->name=="visibleX") 
						{
							if($field==0)  {$field="No";} elseif($field==1)  {$field="Yes";}
							//else {$lebo_field = $field;}
							
							$lebo_id 	= $field_data["id"];
							$lebo_field = $field;
							$lebo_action= 'togg_'.strtolower($lebo_field);
							$lebo_color = ' class="label label-'.strtolower($lebo_field).'" ';
							
							$lebo_field = '<span'.$lebo_color.'>'.$field.'</span>';
							
							if($this->addir == 'XX')
							{
							$lebo_table = clean_alphanum($this->addir);	
							
							$lebo_field = '<span id="visible__'.$lebo_id.'"><span'.$lebo_color.'><a href="javascript:;" onclick="javascript:Article_Operations(\'visible__'.$lebo_id.'\',\''.$lebo_action.'\', \''.$lebo_id.'\', \''.$lebo_table.'\');">'.$field.'</a></span></span>';
							}
								
							echo "<td class='center'>".$lebo_field." </td>";
						}
						
						elseif ($field_names[$f]->name=="access") 
						{
							$pos=" align=left "; 
							if($field==1) {$field="<img src='".DISP_IMAGES."icons/ico_public.png' title='Public Access'>";} else {$field="<img src='".DISP_IMAGES."icons/ico_private.png' title='Private Access'>";}
							echo "<td class='center'>".$field." </td>";
						}
						
						elseif ($field_names[$f]->name=="_action") 
						{
							//$id_record 		= $field_data["id"];
							//$field 			= "<a href='ajmore.php?d=attendance_register&id_sitting=".$id_sitting."' rel='modal:open'>View</a>";
							$field 			= "<a href='".$link_redirectb."' rel='modal:open'><i class='fa fa-edit'></i></a>"; 
							//if($field<>'0') { } else { $field = "-"; }
							echo "<td>".$field." </td>";
						}
						
						elseif ($field_names[$f]->name=="seq" or
								$field_names[$f]->name=="hits" or
								$field_names[$f]->name=="signs" or
								$field_names[$f]->name=="signatures" or
								$field_names[$f]->name=="comments" or
								$field_names[$f]->name=="entries" or
								$colnamePrefix == "num_" ) {
							$pos=" style='text-align:left;'  "; 
							if($field == '') { $field = 0;}
							echo "<td $pos>".$field." </td>";
							//echo "<td $pos><input type=\"text\" name=\"pos[".$field_data[0]."]\" value=\"".$field."\" style=\"width:25px;\"></td>";
						}
						
						elseif ($field_names[$f]->name=="items") {
							$pos=" style='text-align:center;' "; 
							echo "<td $pos>".$field;
							/*if($field<>0){
							echo "&nbsp;&nbsp;<a href=\"#d=course entries&id=$field_data[0]\">view</a>";
							} else { echo "" ;}*/
							echo "</td>";
						}
						
						elseif ($field_names[$f]->name=="pics") {
							$pos=" align=center "; 
							//$inlink = "#";
							//if($field<>0){
								$inlink = " href=\"adm_projects_pics.php?d=project galleries&op=edit&id=$field_data[0]\"";
							//} 
							$field =  str_pad($field, 2, "0", STR_PAD_LEFT); 
							echo "<td $pos>".$field."</td>";//<a".$inlink."></a>
						}
						
						elseif ($field_names[$f]->name=="pos.") 
						{
							$pos=" style='text-align:center;'  ";
							
							$lebo_field = $field;
							
							if($this->addir == 'menus' or $this->addir == 'contents')
							{
							$lebo_id 	= $field_data["id"];
							$lebo_table = clean_alphanum($this->addir);						
							
							$lebo_field = '<span id="pos__'.$lebo_id.'">'.$field.' <a href="javascript:;" onclick="javascript:Article_Operations(\'pos__'.$lebo_id.'\',\'pos_minus\', \''.$lebo_id.'\', \''.$lebo_table.'\');">-</a> <a href="javascript:;" onclick="javascript:Article_Operations(\'pos__'.$lebo_id.'\',\'pos_add\', \''.$lebo_id.'\', \''.$lebo_table.'\');">+</a></span>';
							}
							
							echo "<td $pos>".$lebo_field."</td>";//<a".$inlink."></a>
						}
						
						
						
				}
				
				if($disp_front ==0)
				{
					//op=edit&id=$field_data[0]
				echo "<td class='center'><a href='".$link_redirectb."' class='txt95 txtred' title='View details &raquo;' ".$link_blank.">More</a></td>";	
				}
				
				echo "</tr>";
				$rn += 1;
			} 
		echo "</tbody></table>
		<input type=\"hidden\" name=\"formname\" value=\"posUpdates\" />
				<input type=\"hidden\" name=\"redirect\" value=\"".$redirect."\" />
				</div>
		</form>";

	}		
			
			
	
	
}
?>