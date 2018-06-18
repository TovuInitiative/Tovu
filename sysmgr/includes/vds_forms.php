<div style="width:100%; margin:0 auto">
	
	<div style="padding:10px;">
	
<?php
/*if($dir == 'pillars')
{	  
	$newForm = new Formitable( mysql_connect(DB_HOST,DB_USER,DB_PASSWORD),DB_NAME, 'oc_app_pillar' );
	$newForm->setPrimaryKey("pillar_id");
	$newForm->hideField("pillar_id"); 
	$newForm->setDefaultValue("published","1");
	$newForm->setDefaultValue("seq","9");
	
	$newForm->registerValidation("required",".+","Input is required!");
	$newForm->validateField("description","required");
	
	$newForm->forceTypes(array("published"),array("checkbox")); 
	
	if( isset($_GET['id']) ) $newForm->getRecord($_GET['id']); 
	
	if( !isset($_POST['submit']) || 
    (isset($_POST['submit']) && $newForm->submitForm() == -1) ){ $newForm->printForm(); } 
}*/


$GLOBALS['FORM_JWYSWYG'] = true;

$fVars = array();
$fVars['fld_label'] = array();
$fVars['fld_class'] = array();
$fVars['fld_custom'] = array();

$fVars['formtab']   = $dir;
        
        
if($dir == 'committee') {
	$fVars['tb_name']  = $adTabProps['committee']['tbn']; //'mrfc_app_committee';
	$fVars['tb_key']   = $adTabProps['committee']['tbk']; //'committee_id';
	
	$c_title = array('committee_id', 'title', 'description', 'published');	
	$c_label = array('committee_id', 'title', 'description', 'published');
	$c_cols  = array_combine($c_title, $c_label);
	$fVars['tb_cols']   = implode($c_title, ', ');
	
	$fVars['fld_class']['required'] = array('title');	
	$fVars['fld_class']['wysiwyg']  = array('description');
}

        
        
        

if($dir == 'pillars') {
	$fVars['tb_name']  = 'oc_app_pillar';
	$fVars['tb_key']   = 'pillar_id';
	
	$c_title = array('pillar_id', 'title', 'description', 'id_menu', 'published');	
	$c_label = array('pillar_id', 'title', 'description', 'parent menu' , 'published');
	$c_cols  = array_combine($c_title, $c_label);
	$fVars['tb_cols']   = implode($c_title, ', ');
	
	$fVars['fld_class']['required'] = array('title');	
	$fVars['fld_class']['wysiwyg']  = array('description');
}



if($dir == 'locations') {
	$fVars['tb_name']  = 'oc_app_location';
	$fVars['tb_key']   = 'location_id';
	
	$c_title = array('location_id' , 'name' , 'lon' , 'lat' , 'descr', 'published');	
	$c_label = array('location_id' , 'location name' , 'longitude' , 'latitude' , 'description', 'published');
	$c_cols  = array_combine($c_title, $c_label);
	$fVars['tb_cols']   = implode($c_title, ', ');
	
	$fVars['fld_class']['required'] = array('name');		
}


if($dir == 'ministries') {
	$fVars['tb_name']  = 'oc_app_ministry';
	$fVars['tb_key']   = 'ministry_id';
	
	$c_title = array('ministry_id' , 'name' , 'url' , 'email');	
	$c_label = array('ministry_id' , 'ministry name' , 'website' , 'email');
	$c_cols  = array_combine($c_title, $c_label);
	$fVars['tb_cols']   = implode($c_title, ', ');
	
	$fVars['fld_class']['required'] = array('name');	
}


if($dir == 'projects') {
	$fVars['tb_name']  = 'oc_app_project';
	$fVars['tb_key']   = 'project_id';
	
	$c_title = array('project_id' , 'pname' , 'profile' , 'mtptarget' , 'atarget' , 'pillar_id' , 'sector_id' , 'ministry_id' , 'location_id' , 'objectives' , 'implementing_status' , 'a_name' , 'a_acronym' , 'funding_req' , 'funding_status_gok' , 'funding_status_others' , 'opportunity_of_funding' , 'general_remarks' , 'description' , 'benefits' , 'funding','tcost', 'progress', 'published');
	
	$c_label = array('project_id' , 'project name' , 'Project Profile' , 'MTP target' , 'annual target' , 'pillar' , 'sector' , 'ministry' , 'location' , 'objectives' , 'implementing status' , 'agency name' , 'agency acronym' , 'Funding Requirements
' , 'Funding Status (GOK)' , 'Funding Status (Others)' , 'opportunities of funding' , 'general_remarks' , 'Project Progress' , 'benefits' , 'funding','cost', 'progress', 'published');
	$c_cols = array_combine($c_title, $c_label);
	
	$fVars['tb_cols']   = implode($c_title, ', ');
	
	
	$fVars['fld_class']['required'] = array('pname', 'mtptarget', 'pillar_id' , 'sector_id' , 'ministry_id' , 'location_id');
	
	$fVars['fld_class']['wysiwyg'] = array('profile', 'mtptarget', 'atarget', 'objectives', 'general_remarks', 'description', 'benefits' , 'funding', 'opportunity_of_funding');
	
}


if($dir == 'project_components') {
	$fVars['tb_name']  = 'oc_app_project_component';
	$fVars['tb_key']   = 'component_id';
	
	$c_title = array('project_id', 'component_id', 'cname', 'a_name', 'a_acronym', 'mtptarget', 'atarget', 'funding_req', 'funding_status_gok', 'funding_status_others', 'implementing_status', 'general_remarks', 'cfunding', 'copfunding', 'location_id', 'progress', 'published');
	
	$c_label = array('project', 'component_id', 'component name', 'agency name', 'agency acronym', 'MTP target', 'annual target', 'Funding Requirements', 'Funding Status (GOK)', 'Funding Status (Others)', 'implementing status', 'general remarks', 'funding', 'opportunities of funding', 'location', 'progress', 'published');

	$c_cols = array_combine($c_title, $c_label);
	
	$fVars['tb_cols']   = implode($c_title, ', ');	
	
	$fVars['fld_class']['required'] = array('cname', 'mtptarget', 'project_id' , 'progress');
	
	$fVars['fld_class']['wysiwyg'] = array('mtptarget', 'atarget', 'general_remarks', 'cfunding', 'copfunding');
	
}





$confDir 			= ucwords($dir);

$formheader		   = "<h2>New $confDir</h2>";
$formtab           = $fVars['formtab'];
$formaction         = "_new";

$fData 		      = array();
$fDataFlags 		      = array();

$sqdata 	     = "SELECT ".$fVars['tb_cols']." FROM `".$fVars['tb_name']."` limit 0";

if($op=="edit")
{
	$formheader	 = "<h2>Edit $confDir</h2>";
	$formaction	 = "_edit";
	
	if($id) {
	
	$sqdata="SELECT ".$fVars['tb_cols']." FROM `".$fVars['tb_name']."` WHERE  (`".$fVars['tb_key']."` = ".quote_smart($id).")";
	//echo $sqdata;
	/*$rsdata = $cndb->dbQuery($sqdata);
	$rsdata_count =  $cndb->recordCount($rsdata);
	//$rs_fields = mysqli_num_fields($rsdata);
	$rs_fields = mysqli_fetch_fields($rsdata); //displayArray($rs_fields);
	
		if($rsdata_count == 1)
		{
			$cn_fields 	= $cndb->fetchRow($rsdata);			
			
			//for ($i = 0; $i<$rs_fields; $i++)
			foreach ($rs_fields as $i => $flags)
			{
				$fieldInfo	= array();
				//$flags 		= mysql_fetch_field($rsdata, $i);		 
				$fData[$flags->name] = $cn_fields[$flags->name];
				
				foreach( $flags as $flag => $value ){
					if($value && !array_key_exists($flag, $fieldInfo)){
						//mysqli - type to text 
						if($flag == 'type')  { $value = strtolower($cndb->fieldTypeText($value)); }
						$fieldInfo[$flag=='def'?'default':$flag] = $value;
					}
				}
				unset($fieldInfo['name'],$fieldInfo['table'], $fieldInfo['blob']);
				$fDataFlags[$flags->name] = array_diff_assoc($fieldInfo, array('name','table','blob'));
				
			}
			$fData['id']  = $cn_fields[$fVars['tb_key']];
			
		}*/
		
	}
}


	
	$rsdata       = $cndb->dbQuery($sqdata);
	$rsdata_count = $cndb->recordCount($rsdata);
	$rs_fields    = mysqli_fetch_fields($rsdata); 
	$cn_fields    = $cndb->fetchRow($rsdata);			
			
	foreach ($rs_fields as $i => $flags)
	{
		$fieldInfo	= array();
				 
		$fData[$flags->name] = ($op=="edit") ? $cn_fields[$flags->name] : '';
		
		foreach( $flags as $flag => $value ){
			if($value && !array_key_exists($flag, $fieldInfo)){
				/* mysqli - type to text */
				if($flag == 'type')  { $value = strtolower($cndb->fieldTypeText($value)); }
				$fieldInfo[$flag=='def'?'default':$flag] = $value;
			}
		} //displayArray($fieldInfo);
		unset($fieldInfo['name'],$fieldInfo['table'], $fieldInfo['blob']);
		$fDataFlags[$flags->name] = array_diff_assoc($fieldInfo, array('name','table','blob'));
		
	}
	$fData['id']  = ($op=="edit") ? $cn_fields[$fVars['tb_key']] : '';
			
		
	

//displayArray($fDataFlags);




/* ====================================================== */
/* @@ DROP DOWN LISTS */
/* ------------------------------------------------------ */

if($dir == 'pillars') 
{
	$fVars['fld_custom']['id_menu'] = array("oc_dt_menu", "id", "title"); 
}

if($dir == 'projects') 
{
	$fVars['fld_custom']['pillar_id'] = array("oc_app_pillar", "pillar_id", "title"); 
	$fVars['fld_custom']['sector_id'] = array("oc_app_sector", "sector_id", "title"); 
	$fVars['fld_custom']['ministry_id'] = array("oc_app_ministry", "ministry_id", "name"); 
	$fVars['fld_custom']['location_id'] = array("oc_app_location", "location_id", "name");
}

if($dir == 'project_components') 
{
	$fVars['fld_custom']['project_id'] = array("oc_app_project", "project_id", "pname"); 
	$fVars['fld_custom']['location_id'] = array("oc_app_location", "location_id", "name");
}
/* ====================================================== */
	
	?>

<div>
<div style="text-align:"><?php echo $formheader; ?></div>

	
<form class="rwdform rwdfulld rwdstripes" name="fm_vds" id="fm_vds" method="post" action="adm_posts.php">
<input type="hidden" name="formtab" value="<?php echo $formtab; ?>" />
<input type="hidden" name="formaction" value="<?php echo $formaction; ?>" />
<input type="hidden" name="formname" value="fm_vds" />
<input type="hidden" name="id" value="<?php echo @$fData['id']; ?>" />
<input type="hidden" name="redirect" value="home.php?d=<?php echo $dir; ?>" />
<div class=""></div>
<?php
foreach($fDataFlags as $fkey => $fStat)
{
	if($fkey <> $fVars['tb_key'] and $fkey <> 'published')
	{
		//$i_class 	= array_key_exists($fkey, $fVars['fld_class']) ? $fVars['fld_class'][$fkey] : '';
		//$i_label 	= array_key_exists($fkey, $fVars['fld_label']) ? $fVars['fld_label'][$fkey] : $fkey;
		$i_class	= '';
		if(@in_array($fkey, $fVars['fld_class']['required'])) { $i_class .= ' required'; }
		if(@in_array($fkey, $fVars['fld_class']['wysiwyg']))  { $i_class .= ' wysiwyg'; }
		
		$i_label 	= $c_cols[$fkey];
		
		$inputLabel = ucwords($i_label);
		$inputName  = $fkey; //echobr($fkey);
		$inputType  = $fStat['type']; 
		$inputValue = $fData[$inputName]; //strip_tags_clean($fData[$inputName]);
		
		
		echo '<div class="form-group"><label for="'.$inputName.'">'.$inputLabel.': </label><div>';
		switch($inputType)
		{
			case 'real':
			case 'int':
			case 'long':
				if(array_key_exists($fkey,$fVars['fld_custom'])){
					$attr = $fVars['fld_custom'][$fkey];
					echo '<select name="'.$inputName.'" id="'.$inputName.'" class="form-control '.$i_class.'">';
					echo $ddSelect->dropper_select($attr[0], $attr[1], $attr[2], $inputValue);
					echo '</select>';
				} 
				else {
					echo '<input type="text" name="'.$inputName.'" id="'.$inputName.'" class="form-control '.$i_class.'" value="'.$inputValue.'" />';
				}					
			break;
				
				
			case 'blob':
				echo '<textarea name="'.$inputName.'" id="'.$inputName.'" class="form-control '.$i_class.'">'.$inputValue.'</textarea>';
			
			break;
			
			case 'string':
			case 'var_string':
			default:
				echo '<input type="text" name="'.$inputName.'" id="'.$inputName.'" class="form-control '.$i_class.'" value="'.$inputValue.'" />';
		}
		
		echo '</div></div>';
			
	}
	
}



if(array_key_exists('published',$fDataFlags))
{
	$published = yesNoChecked($fData['published']);
	?>
	<div class="form-group">
		<label class="textlabel control-label" for="published">Published: <small>(Yes / No)</small> </label>
		<div><input type="checkbox" name="published" id="published"  <?php echo $published; ?> class="radio"/> 
		<input type="hidden" name="publishval" value="<?php echo $fData['published']; ?>" />
		</div>
	</div>
	
	<?php
}
?>

<?php /*?><div class="form-group">
<label class="textlabel control-label" for="title">Title</label>
<div>
<input type="text" name="title" id="title" size="50" maxlength="100" class="text form-control" value="<?php echo @$fData['title']; ?>" />
</div></div>


<div class="form-group">
<label class="textlabel control-label" for="description">Description</label>
<div>
<textarea name="description" id="description" rows="2" cols="50" class="textarea form-control wysiwyg"><?php echo @$fData['description']; ?></textarea>
</div></div>

<div class="form-group">
<label class="textlabel control-label" for="published">Published</label>
<div>
<input type="checkbox" name="published" id="published" <?php echo $published; ?> class="radio"/> <em>(Yes / No)</em>
</div></div>
<?php */?>

<div class="form-group">
<label>&nbsp;</label>
<div><input type="submit" name="submit" id="Submit" value="Submit" style="max-width:250px;" /></div>
</div>	


	
</form>
</div>


	
			

</div>
</div>