jQuery(document).ready(function() {
	
// ---------------------------------------
//	COMMON -----------  check element and ex fun
// ---------------------------------------
function checkElement(params,fun){
	var list = jQuery(params);

	if(list.length <= 0) {return false;}
	
	for (var w=0; w<list.length; w++)	{
		fun(list[w]);
	}
}

// ---------------------------------------
//	Tabs & SideTabs
// ---------------------------------------
function tabsInit(){
		
		//alert("yeeah");
	/* tabs */
	checkElement(".tabs",tabsBack);
	
	/* side tabs */
	checkElement(".sidetabs",sideTabsBack);
	
	function refreshTabWidth(params){
		jQuery(params).find('.tabs-container .tabs-content').css('width',(jQuery(params).width()-30));
	}
	
	/* back fun */
	function tabsBack(params){
		openTabs(params,".tabs-nav li",".tabs-content");
		jQuery(window).resize(function() {
			refreshTabWidth(params);
		});
		refreshTabWidth();
	}
	
	function sideTabsBack(params){
		openTabs(params,".sidetabs-nav li",".sidetabs-content");
	}
	
	function openTabs(params,pname1,pname2){
		var ot_items = jQuery(params).find(pname1);
		var citems = jQuery(params).find(pname2);
		var ot_s1 = 0;
		var ot_sm = ot_items.length;
		var ot_new;
		
		jQuery(ot_items).click(function() {
			if(ot_s1 === jQuery(this).index()) {
				return false;
			}
			
			jQuery(citems[ot_s1]).stop(true,true);
			jQuery(citems[ot_s1]).css("opacity",1);
			
			ot_new = jQuery(this).index();
			
			jQuery(ot_items[ot_s1]).removeClass("current");
			jQuery(ot_items[ot_new]).addClass("current");
			
			if(jQuery(citems[ot_s1]) !== null) {
				jQuery(citems[ot_s1]).fadeOut("fast","",runNewTabs);
			}
		});
		
		function runNewTabs(){
			ot_s1 = ot_new;
			showElement(ot_s1,citems);
		}
		
		for(var k=0; k<ot_sm;k++) {
			if(ot_s1 === k){
				if(jQuery(ot_items[k]).hasClass("current") === false) {
					jQuery(ot_items[k]).addClass("current");
				}
				showElement(k,citems);
			}else{
				if(jQuery(ot_items[k]).hasClass("current") === true)	{
					jQuery(ot_items[k]).removeClass("current");
				}
				hideElement(k,citems);
			}
		}
	}
	
	function showElement(k,citems){
		if(jQuery(citems[k]) !== null)	{
			jQuery(citems[k]).fadeIn("fast");
		}
	}
	
	function hideElement(k,citems){
		if(jQuery(citems[k]) !== null)	{
			jQuery(citems[k]).fadeOut("fast");
		}
	}
	
	
}/* end tabs */

	//if($('.tabs-nav li').length){
		tabsInit();
	//}
});