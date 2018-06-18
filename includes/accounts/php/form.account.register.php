<?php
$request = $_REQUEST;
$modal_head = $modal_foot = '';
if(isset($_REQUEST['rel'])){
	require_once("../../../classes/cls.constants.php");	 
	$urequest = array_map("clean_request", $_REQUEST); 
	//displayArray($urequest);
	$modal_head = modHeader('Sign Up');
	$modal_foot = modFooter();
}
echo $modal_head;
?>

<?php

$rec_country = '';
$check_p = ''; $check_b = ' checked ';
$reg_op = @$_REQUEST['reg'];
if($reg_op == 'partner') { $check_p = ' checked '; $check_b = '';}
?>


<div>
<form  name="fm_register"  id="fm_register" class="rwdform rwdfullb" action="<?php echo $GLOBALS['MODULAR_ACCOUNTS_POST']; ?>" method="post" >

<!--<div class="errorBox" id="errorReg">All fields are required!</div>-->

<div class="form-group">
	<label for="ac_namefirst" class="col-md-3">Full Name</label>
	<div class="col-md-9">
		<INPUT TYPE="text"  id="ac_namefirst" NAME="ac_namefirst"  class="required form-control col-md-6" maxlength="50" placeholder="First Name"  />
		<INPUT TYPE="text"  id="ac_namelast" NAME="ac_namelast"  class="required form-control col-md-6" maxlength="100" placeholder="Last Name"  /> 
	</div>
</div>
	
<div class="form-group">
	<label for="ac_email" class="col-md-3">Email</label>
	<div class="col-md-9">
		<input type="email" class="form-control required" name="ac_email" id="ac_email"  maxlength="50" placeholder="Your Email" />
	</div>
</div>	

<div class="form-group">
	<label for="ac_pass" class="col-md-3">Password</label>
	<div class="col-md-9">
		<input type="password" name="ac_pass" id="ac_pass" class="required form-control col-md-6" minlength="6" maxlength="20" placeholder="New Password" >
		<input type="password" name="ac_passconfirm" id="ac_passconfirm" class="required form-control col-md-6" equalTo="#ac_pass" placeholder="Repeat password" >
	</div>
</div>

<div class="form-group">
	<label for="" class="col-md-3">&nbsp;</label>
	<div class="col-md-9">
	<div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input required" name="ac_agreeterms" id="ac_agreeterms" /> I agree to the <a href="#" target="_blank">Terms of Use</a>
      </label>
    </div>
    </div>
</div>		


	

<?php /*?>
<div><div><?php include("includes/form.captchajx.php"); ?></div></div>
<?php */?>


<div class="form-group">
	<label class="col-md-3">&nbsp;</label>
	<div class="col-md-9">
		<div class="col-md-4 nopadd">
			<button type="input" name="signupSubmit" value="Sign Up" class="btn btn-primary btn-icon col-md-12"> Sign Up</button> 
		</div>
		<div class="col-md-1 nopadd">
			<input  NAME="formname" type="hidden" value="ac_signup" />
			<input NAME="formtype" type="hidden" value="Individual" />
			<input NAME="nah_snd" id="nah_snd" type="text">  
			<input name="redirect" type="hidden" value="result.php<?php echo $ref_qrystr; ?>" />
		</div>
		<div class="col-md-7 padd10_t txtright"> 
			<a class="txtgreen bold" data-href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']; ?>php/form.account.login.php?rel=modal" id="btn_signin" rel="modal:open"> Sign In</a>
			<!--data-href="ajforms.php?d=signin"-->
			
			
		</div>
	</div>
</div>


</form>

<div id="reg_result"></div>


</div>


<script language="javascript">

jQuery(document).ready(function($)
{
	/*$("#fm_register").validate();*/
	$("#fm_register").validate({
		errorContainer: "#errorReg" , 
		errorPlacement: function(error, element) { },
		/*rules: { ac_passconfirm: { required: true, equalTo: "#ac_pass" }},*/ 
	    messages: { ac_agreeterms: "You must agree to the Terms of Service." }
		,submitHandler: function(form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				beforeSend: function() {
					$('#fm_register').hide();
					$('#col_signin').hide();
					$('#reg_result').html('<img src="image/icons/a-loader.gif" alt="loading..."  />');
				},
				success: function(response) {
					$('#reg_result').html(response);
					/*location.href='home/?tk='+Math.random();*/
				}            
			});
		}
	}); 
	
	
	
});
</script>
<?php echo $modal_foot; ?>