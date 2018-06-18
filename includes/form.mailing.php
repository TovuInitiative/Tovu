<?php 
if(!isset($_SESSION['sess_mrfc_member'])) {
?>

<h4>Signup For Alerts</h4>
<div class="box-cont border_top_only padd0_l">
<?php /*?><h5 class="foot_col_header ">Signup For Alerts. </h5><?php */?>
<div class="<?php echo $side_wrap; ?> clearfix" id="mailing-bar">

<form class="mailingtiny" id="mailingtiny" action="posts.php" method="post" >
<div class="padd10_0">
<?php /*?><label class="label"><span>Signup For News <br />Alerts </span><?php */?>
<input type="text" title="Enter a valid email" name="email_nl" id="email_nl" style="width:260px;margin:0 !important;" class="input required email form-control" maxlength="40" placeholder="Enter your email here..." /><br />
<input type="submit" value="Subscribe" class="submit"  style="margin:0 !important;"/>
</label>
<input name="formname" type="hidden" value="mailingtiny" />
<input name="nah_snd" id="nah_snd" type="text" />
</div>
</form>
</div>
</div>

<?php } ?>