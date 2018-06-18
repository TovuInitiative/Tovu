
<?php
$request = $_REQUEST;
$modal_head = $modal_foot = '';
if(isset($_REQUEST['rel'])){
	require_once("../../../classes/cls.constants.php");	 
	$urequest = array_map("clean_request", $_REQUEST); 
	//displayArray($urequest);
	$modal_head = modHeader('Sign In');
	$modal_foot = modFooter();
}
echo $modal_head;
?>


<div style="max-width:500px;margin:auto;">
<?php
$conf_token = time(); //echo $this_page;
$redirect = 'profile.php?tab=profile&token='.$conf_token.'#dashboard';
if(substr($ref_back,0,5) <> 'index' and substr($ref_back,0,6) <> 'result' and substr($ref_back,0,1) <> '?') 
{ $redirect = $ref_back;  }
    
    if($this_page == 'contribute.php' or $this_page == 'profile.php'){
        echo '<h3 class="txtcenter">Login to Proceed</h3>';
        $redirect = 'contribute.php?ptab=dashboard';
    }

?>


<div>

<div id="sign_result" class="txtred"></div>

<form  name="fm_login"  id="fm_login" class="rwdform rwdfullb" action="<?php echo $GLOBALS['MODULAR_ACCOUNTS_POST']; ?>" method="post"  >
<div class="errorBox" id="errorLogin" style="display:none">Highlighted fields are required!</div>
<input name="formname" type="hidden" value="ac_login" />
<input name="redirect" id="log_red" type="hidden" value="<?php echo $redirect; ?>" />

<div>
<?php /*?><label for="log_emailb" class="required">Email Address:</label><?php */?>
<div class="input-group margin-bottom-sm">
	<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
	<input type="text" name="log_email" id="log_email" class="required email form-control" maxlength="50" placeholder="Email Address" value="<?php echo $ureg; ?>" autocomplete="off" />	
</div>
</div>


<span id="emailbox" style="display:none"></span>

<div>
<div class="padd5"></div>
</div>

<div id="field_log_passw">
<?php /*?><label for="log_passwb" class="required">Password:</label><?php */?>
<div class="input-group margin-bottom-sm">
  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
  <input type="password" name="log_passw" id="log_passwb" class="required form-control" autocomplete="off" maxlength="50" placeholder="Password" >
</div>
</div>

<div>
<div class="padd5"></div>
</div>


<div class="row">
	<div class="col-md-4">
		<button type="input" name="submit" value="login" class="btn btn-primary btn-icon col-md-12"> Sign In</button> 
	</div>
	<div class="col-md-8 padd10_t txtright">
		<!--ajforms.php?d=pass_reset-->
		<a data-href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']; ?>php/form.account.pass.reset.php?rel=modal" id="pass_reset" rel="modal:open" class="txtgreen bold">Forgot your password?</a> &nbsp; &nbsp; 
		<!--ajforms.php?d=signup-->
		<a data-href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']; ?>php/form.account.register.php?rel=modal" id="btn_signup" rel="modal:open" class="txtgreen bold">Sign Up</a>
	</div>
	
</div>


</form>



</div>
</div>


<script language="javascript">

jQuery(document).ready(function($)
{
	$("#fm_login").validate({
		errorContainer: "#errorLogin" , 
		errorPlacement: function(error, element) { },
		submitHandler: function(form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				beforeSend: function() {
					$('#fm_login').hide();
					$('#sign_result').html('<img src="image/icons/a-loader.gif" alt="loading..."  />');
				},
				success: function(response) {
					var str2 = "log_1";
					var redre = $('#log_red').prop("value");
					if(response.indexOf(str2) != -1) 
					{ location.href= redre + '&tk='+Math.random(); } else 
					{ $('#fm_login').show(); $('#sign_result').html(response); } 				
					
				}            
			});
		}
	}); 
});
</script>


<?php echo $modal_foot; ?>
