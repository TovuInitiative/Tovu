
			<div id="text-41" class="widget-even widget-last widget-4 more-widget widget clearfix widget_text">
			<div class="padd15_l padd15_r">
			
			<h3 class="txtwhite">Want to find out more?</h3>			
			<div class="txtblack"><p>Call +254-792-424501 / +254-737-947497 to discuss your requirements, or request a callback below</p>
			
			
<?php $fredirect = $_SERVER['REQUEST_URI']; ?>		

		
<form action="posts.php" method="post" class="rwdvalid" name="fm_course_enquiry" id="fm_course_enquiry" >
<input name="formname" type="hidden" value="frm_course_enquiry" />
<input name="course_name" type="hidden" value="<?php echo @$currCont['title']; ?>" />
<input name="formtype" type="hidden" value="Course Enquiry" />
<input name="nah_snd" id="nah_snd" type="text" />  
<input name="redirect" type="hidden" value="<?php echo $fredirect; ?>" />
<fieldset>
<p class=" col-md-6 nopadd" id="element_avia_1_1">
	<label for="fullname">Name <abbr class="required" title="required">*</abbr></label>
	<input name="fullname" class="form-control required" type="text" id="fullname" value="">
</p>

<p class=" col-md-6 nopadd" id="element_avia_2_1">
	<label for="phone">Phone Number <abbr class="required" title="required">*</abbr></label>
	<input name="phone" class="form-control required" type="text" id="phone" value="">
</p>
<p class=" first_form  form_element form_fullwidth" id="element_avia_3_1">
	<label for="details">I’m interested in <abbr class="required" title="required">*</abbr></label> 
	<select name="details" class="form-control required" id="details"><option value="" selected></option><option value="Open courses">Open courses</option><option value="In-house/bespoke courses">In-house/bespoke courses</option><option value="Other">Other</option></select>
</p>

<div id="avia_4_1" class="av-form-text">
<p class="txt10">Available during office hours only, Monday to Friday 9am to 5pm. We’ll call you as soon as we can.</p>
</div>
<p class="hidden"><input type="text" name="avia_5_1" class="hidden " id="avia_5_1" value=""></p>
<p class="form_element ">
	<input type="hidden" value="1" name="avia_generated_form1">
	<button type="input" name="submit" value="Call me" class="btn btn-primary col-md-6">CALL ME</button> 
	</p>
</fieldset>
</form>
<div id="ajaxresponse_1" class="ajaxresponse ajaxresponse_1 hidden"></div>
</div>
		</div>
		</div>
			
			