<?php 
//if(!isset($_SESSION['sess_klfiic_member'])) {
?>

<!--<h4>Signup For Alerts</h4>-->
<div class="box-cont marg0_b">
<div class=" clearfixX" id="mailing-bar">

<form class="mailingtiny rwdvalid" id="mailingtiny" action="posts.php" method="post" >

<div class="padd10_b txt14">Sign up with your email to get updates on data resources uploaded.</div>

<div class="form-group form-row">
<input type="text" title="Enter a valid email" name="email_nl" id="email_nl" class="required email form-control col-md-12" maxlength="40" placeholder="Enter your email here..." />
</div>

<!--<div class="form-group form-row">
<label class="nobold">Receive a summary of the datasets </label>
<div class="radio_group">
<label><input type="radio" class="radio require-one" title="Select one" name="datasets" id="datasets_d" value="daily" /> Daily </label>
<label><input type="radio" class="radio require-one" name="datasets" id="datasets_w" value="weekly" /> Weekly </label>
<label><input type="radio" class="radio require-one" name="datasets" id="datasets_m" value="monthly" /> Monthly </label>
</div>
</div>-->

<div class="padd10_0">
	<input type="submit" value="Subscribe" class="submit"  style="margin:0 !important;"/>

	<input name="formname" type="hidden" value="mailingtiny" />
	<input name="nah_snd" id="nah_snd" type="text" />
</div>

</form>
</div>
</div>

<?php //} ?>