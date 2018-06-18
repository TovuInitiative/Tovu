<?php
$fData          = array();
$frmNoEdit 	    = '';
$formaction		= "_new";		

?>
<style type="text/css">
.rwdbig input.form-control {  }
.rwdbig input.form-control, .rwdbig select.form-control {height: 40px !important;}
</style>

<form class="rwdform rwdbig rwdstripes rwdvalid" name="fm_contribute" id="fm_contribute" method="post" action="posts.php" enctype="multipart/form-data" >
<input type="hidden" name="formtab" value="_documents" />
<input type="hidden" name="formaction" value="<?php echo $formaction; ?>" />
<input type="hidden" name="formname" value="fm_contribute" />
<input type="hidden" name="post_by" value="<?php echo @$_SESSION['sess_mrfc_member']['u_id']; ?>" />
<input type="hidden" name="redirect" value="contribute.php?ptab=<?php echo @$ptab; ?>" />
<div class="">&nbsp;</div>

<div class="form-group form-row padd20_lx">
    <h3 class="padd10_l">Post Details</h3>
</div>

<div class="form-group form-row"><label for="" class="col-md-2">Post Type: </label>
    <div class="col-md-10 padd0_l padd0_r">
        <label class="col-md-3"><input type="checkbox" name="post[type][]" id="pt_experience" value="experience" class="radio require-one"/> Experience / Innovation </label>
        <label class="col-md-3"><input type="checkbox" name="post[type][]" id="pt_event" value="event" class="radio require-one"/> Event </label>
        <label class="col-md-3"><input type="checkbox" name="post[type][]" id="pt_news" value="news" class="radio require-one"/> News Article </label>
        <label class="col-md-3"><input type="checkbox" name="post[type][]" id="pt_resource" value="resource" class="radio require-one"/> Resource </label>
    </div>
</div>


<div class="form-group form-row">
<label for="resource_title" class="col-md-2">Post Title: </label>
	<div class="col-md-10 padd0_l padd0_r">	
	<input type="text" name="post[title]" id="ptitle" class="form-control required" value="<?php echo @$fData['resource_title']; ?>"  />
	</div>
</div>


<div class="form-group form-row">
	<label for="resource_description" class="col-md-2">Post Description: </label>
	<div class="col-md-10 padd0_l padd0_r">
	<textarea name="post[description]" id="pdescription" class="form-control wysiwyg" ></textarea>
	</div>
</div>




<div class="form-group form-row">
   <label for="pdated" class="col-md-2">Post Date: </label>
   <div class="col-md-10 padd0_l padd0_r">
        <div class="col-md-4 padd0_l">
            <input type="text" name="post[dated]" id="pdated" class="form-control col-md-12 hasDatePicker required" value="<?php //echo date('Y-m-d'); ?>"  />
        </div>
        <label for="pcounty" class="col-md-4">Related County: </label>
        <div class="col-md-4 padd0_l padd0_r">
            <select class="form-control required" id="pcounty" name="post[county]">
            <option value=""> - Select County -</option>
            <?php echo $ddSelect->dropper_select("mrfc_reg_county", "county_id", "county") ?>
            </select>
        </div>
    </div>
    
</div>



<div class="form-group form-row">
    &nbsp;
</div>

<div class="form-group form-row padd20_lx">
    <h3 class="padd10_l">Upload Accompanying Files</h3>
    <div class="col-md-12 padd10_l">
        <div class="info txtred"><em><b>Accepted document types:</b> PDF, Excel, Word, PowerPoint, Zip</em></div>
    </div>
</div>


<div class="form-groupX form-row">
    <!--<label for="resource_file" class="col-md-2">Select Files: </label>-->
    <div class="col-md-12 padd0_l">
       
       <table class="table noborder">
           <thead>
               <tr>
                   <th class="col-md-5"><strong>Select File</strong></th>
                   <th class="col-md-7"><strong>Enter File Title</strong></th>
               </tr>
           </thead>
           <tbody>
               <tr>
                   <td><input type="file" name="fdoc[0]" id="fdoc_0"  class="form-control " multiple accept="<?php echo $uploadMime; ?>" /></td>
                   <td><input type="text" name="fdoc_title[0]" id="ftitle_0"  class="form-control " placeholder="Enter Title" /></td>
               </tr>
               <tr>
                   <td><input type="file" name="fdoc[1]" id="fdoc_1"  class="form-control " multiple accept="<?php echo $uploadMime; ?>" /></td>
                   <td><input type="text" name="fdoc_title[1]" id="ftitle_1"  class="form-control " placeholder="Enter Title" /></td>
               </tr>
               <tr>
                   <td><input type="file" name="fdoc[2]" id="fdoc_2"  class="form-control " multiple accept="<?php echo $uploadMime; ?>" /></td>
                   <td><input type="text" name="fdoc_title[2]" id="ftitle_2"  class="form-control " placeholder="Enter Title" /></td>
               </tr>
           </tbody>
       </table>
        
	</div>
</div>


<div class="form-group form-row padd20_lx">
    <h3 class="padd10_l">Submission Comments</h3>
</div>

<div class="form-group form-row">
	<label for="pcomments" class="col-md-2">Any notes / comments on this Post: </label>
	<div class="col-md-10 padd0_l padd0_r">
	<textarea name="post[comments]" id="pcomments" class="form-control" ></textarea>
	</div>
</div>


<div class="form-group form-row">
	<label class="col-md-2">&nbsp;</label>
	<div class="col-md-10">
	    <button type="submit" name="submit" id="submit" value="submit" class="btn btn-success col-md-4 pull-right">Submit </button>
	    <!--<button type="reset" name="reset" id="reset" value="" class="btn btn-default col-md-4 pull-right">Reset </button>-->
	</div>
	
</div>

	
</form>



<script type="text/javascript">
jQuery(document).ready(function($) 
{
	
	
});
</script>	