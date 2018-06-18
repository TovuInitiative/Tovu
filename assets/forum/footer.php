	</div><!-- content -->
</div><!-- wrapper -->
<div id="footer">&nbsp;</div>


<script type="text/javascript">

jQuery(document).ready(function($) {
	
	if( $('.jtrunc').length ){
 		$('.jtrunc').truncate({max_length: 120});
		//$('.btn_jtrunc').click(function () { resizeParentFrame();  });
	}
});



function resizeParentFrame() {
	if(self == parent) return false; 
	else window.parent.resizeIframe();  
}
</script>
</body>
</html>