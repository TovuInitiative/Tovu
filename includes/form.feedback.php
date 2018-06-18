<div class="row">&nbsp;</div>
<div class="row">

<?php echo display_PageTitle('Locate Us', 'h3', 'nocaps'); ?>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3988.8427224885822!2d36.801409!3d-1.2670838!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f174039607b13%3A0x7b930c46964c52da!2sCouncil+of+Governors!5e0!3m2!1sen!2ske!4v1520241370696" width="100%" height="355" frameborder="0" style="border:0" allowfullscreen></iframe>
	
</div>

<div class="row">&nbsp;</div>

<?php $redirect = $_SERVER['REQUEST_URI'];  ?>
<a id="fm-feedback"></a>
<?php echo display_PageTitle('Send us your Feedback or Enquiries', 'h3', 'nocaps'); ?>
<p>To make an Enquiry and/or Suggestion, please fill in the Form below:-</p>


<div >
<form class="rwdform rwdfullX rwdvalid"  action="posts.php" method="post" name="feedback" id="feedback">

  <div>
    <label class="required col-md-3"  for="fullname">Full Name</label>
    <div>
      <input name="fullname" id="fullname" type="text" class="form-control required col-md-9" value="" tabindex="1" placeholder="Full Name" >
    </div>
  </div>
  
  <div>
    <label class="required col-md-3"  for="email" >Email</label>
    <div>
      <input id="email" name="email" type="email" spellcheck="false" value="" maxlength="255" tabindex="2" class="required col-md-9" placeholder="Email" > 
    </div>
  </div>
  
  <div>
    <label class="desc col-md-3"  for="phone">Phone</label>
    <div>
      <input id="phone" name="phone" type="text"  class="mask_phone col-md-9" value=""  tabindex="3" placeholder="e.g. +254 777 123456">
    </div>
  </div>
  

  <div>
    <label class=" col-md-3"  for="subject">Subject</label>
    <div>
      <input id="subject" name="subject" type="text"  class=" col-md-9" value="" maxlength="50" tabindex="4" placeholder="Area of concern">
    </div>
  </div>
  
  <div>
    <label class="required col-md-3"  for="details">Message</label>
    <div>
      <textarea id="details" name="details"  class="required col-md-9" spellcheck="true" tabindex="5" placeholder="Message"></textarea>
    </div>
  </div>

   <div>
   	<label class="required col-md-3"  >Human Verification</label>
    <div class="col-md-9 padd0_l">
    <?php include("includes/form.captchajx.php"); ?>
    </div>
  </div>
  
  <div>
   
    <label class="col-md-3"  >&nbsp;</label>
    <div class="col-md-9 padd0_l">
		<?php /*?><input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset"><?php */?>
		<input id="saveForm" name="saveForm" type="submit" value="Submit" tabindex="7" />
		<input name="formname" type="hidden" value="feedback" />
		<input name="formtype" type="hidden" value="Feedback Post" />
		<input name="nah_snd" id="nah_snd" type="text" />  
		<input name="redirect" type="hidden" value="<?php echo $redirect; ?>" />
    </div>
  </div>
  
<div>
	
</div>
</form>


</div>
<div class="clearfix padd10"></div>