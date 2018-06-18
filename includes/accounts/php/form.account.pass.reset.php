<?php
$request = $_REQUEST;
$modal_head = $modal_foot = '';
if(isset($_REQUEST['rel'])){
	require_once("../../../classes/cls.constants.php");	 
	$urequest = array_map("clean_request", $_REQUEST); 
	//displayArray($urequest);
	$modal_head = modHeader('Forgot Password');
	$modal_foot = modFooter();
}
echo $modal_head;
?> 

<div style="margin:0px auto;  width: ;">
	<!--<h2>Account Reset</h2>-->
<div class="box-gray curvy padd15x">
	
	<div id="sign_result" class="txtred"></div>
	
	
	
	
	<form class="frm-be-bas rwdvalid" name="frm_passgen" id="frm_passgen" method="post" action="<?php echo $GLOBALS['MODULAR_ACCOUNTS_POST']; ?>" >
	<div class="padd10_5 txtgray txt16 margin-bottom">Enter your username / email below click "Reset" to generate a new password.</div>
	<div class="input-group margin-bottom-sm">
	<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
	<input type="email" name="rf_email" id="rf_email" class="email form-control required" maxlength="50" placeholder="Your Email Address" title="Valid email is required." />
	</div>
	<div></div>
	<div>
		<div class="subcolumns">
			<div class="txtcenter padd10_t">
				<button type="input" name="accreset" value="Reset" class="btn btn-primary btn-icon col-md-4"> Reset Password</button> 
				<input name="formname" type="hidden" value="ac_pwreset" />
				<input name="redirect" type="hidden" value="home/" />
				<input name="nah_snd" id="nah_snd" type="text">
			</div>

		</div>

		<div style="border-top:2px dotted #ddd;" class="marg10_t padd10_0 txtcenter">
		<!--<a data-href="ajforms.php?d=account" id="reset_login" rel="modal:open" class="txtred bold">&larr; Sign up OR Sign In</a>-->
		</div>


	</div>
	
    </form>
	
</div>
</div>

<div class="clearfix padd10"></div>

<script language="javascript">

jQuery(document).ready(function($)
{
	$("#frm_passgen").validate({
		errorContainer: "#errorLogin" , 
		errorPlacement: function(error, element) { },
		submitHandler: function(form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				beforeSend: function() {
					$('#frm_passgen').hide();
					$('#sign_result').html('<img src="image/icons/a-loader.gif" alt="loading..."  />');
				},
				success: function(response) {
					$('#sign_result').html(response);					
				}            
			});
		}
	}); 
});	
</script>


<?php echo $modal_foot; ?>
