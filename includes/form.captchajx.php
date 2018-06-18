<label for="txtCaptcha" class="required txtleft nopad nomargin" style="text-transform:none">Enter the characters as seen on the image:</label>
<table border="0" class="auto_size nopadd nomargin noborder" align="left"> 
<tr>
<td><input id="txtCaptcha" type="text" name="txtCaptcha" value="" class="required nomargin" maxlength="8"  style="width:120px" onKeyUp="javascript:this.value=this.value.toUpperCase();" /></td>
<td>&nbsp;</td>
<td><img id="imgCaptcha" src="assets/captchajx/ajax_createimage.php" onclick="captchaRefresh()" /></td>
<td><span id="result" class="txtred txt11">&nbsp;</span></td>
</tr>  
</table> 