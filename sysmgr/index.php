<?php include("sec_head.php"); ?>
	
		
<section>
<!-- section - STARTS -->


<div class="login-container">
    
	<div class="login-header" style="background-color:<?php echo $cms_bg_color?>;">
	   <img src="<?php echo SITE_LOGO; ?>" alt="<?php echo SITE_TITLE_LONG; ?>" id="logo-img" style="height:60px;" /><br>
	   <span class="smart-title">Portal Admin Login</span>
	</div>
    
    <div class="login-content">
    	<form method="post" accept-charset="utf-8" class="form-signin rwdvalid" id="admin_log" action="adm_posts.php">
			<div style="display:none;">
		     	<input type="hidden" name="_method" value="POST">
		     	<input name="formname" type="hidden" value="admin_log">
		    </div>   
			     
			<div class="form-group">
				<label for="admin_uname">Admin Email</label>
				<input type="email" name="admin_uname" id="admin_uname" class="form-control required " placeholder="Admin Email" maxlength="75">
			</div>
			<div class="form-group">
				<label for="admin_pword"> Password </label>
				<input type="password" name="admin_pword" id="admin_pword" class="form-control required" placeholder="Password">
			</div>
			
			<div class="login-btn-container">
				<button id="save_btn" data-loading-text="Please Wait..." type="submit" class="btn btn-default">Login</button>
			</div>
		</form>
    </div>
		
		
		<!--<div class="login-footer">
			<div class="row">
				<div class="col-xs-6 col-sm-6">
					<a href="#">Forgot password</a>
				</div>
				<div class="col-xs-6 col-sm-6 text-right">
					<a class="" href="#">Register account</a>
				</div>
			</div>
		</div>-->

    </div>
		
<!-- section - ENDS -->			
</section>

					
<?php include("sec_foot.php"); ?>					
