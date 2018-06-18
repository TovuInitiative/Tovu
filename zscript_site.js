/*global $, jQuery, alert, document, window, console, require*/
jQuery.noConflict();

function rotateImages() {
	jQuery(document).ready(function($){
		var oCurPhoto = $('#photoShow div.current');
		var oNxtPhoto = oCurPhoto.next();
		if (oNxtPhoto.length == 0) { oNxtPhoto = $('#photoShow div:first'); }
	
		oCurPhoto.removeClass('current').addClass('previous').css('zIndex', -2);
		oNxtPhoto.css({ opacity: 0.0 }).addClass('current').animate({ opacity: 1.0 }, 500,
			function() { oCurPhoto.removeClass('previous'); }).css('zIndex', -1);
	});
}


function pagerSetup(target) {
	jQuery(document).ready(function ($) {	
		var pages = $(target).children().size();
		var pagerSize = (100 / pages);
		$(target).children().css('width',pagerSize + '%');
		$(target).children(':last').css('backgroundImage','none');
		$(target).children(':first').css('border','none');
	});
}


function menuWidths(target) {
	jQuery(document).ready(function ($) {	
		var menupages = $(target).children().size();
		var pagerSize = (98 / menupages);
		$(target).children().css('width',pagerSize + '%');
	});
}


function responsiveContent(opt){ 
    jQuery(document).ready(function ($) {
        if(opt === "canvas"){
            $('.sf-menu-main').html('');
            $('.uk-nav-offcanvas').html(menu_main + menu_header);            
        } else {
            $('.sf-menu-main').html(menu_main);
            $('.uk-nav-offcanvas').html('');
        }
    });    
}


/*jQuery.metadata.setType("attr", "validate");*/

jQuery(document).ready(function ($) {
	
	/*var userbrowser     = jQuery.browser.browser();
	$('#browser').html(userbrowser);*/
	
	var token = Math.random();
	/*//MENUS*/
	$("ul.sf-menu li:has(ul)").children("a").addClass("sf-with-ul");
	
	//$("ul.sf-menu li ul li:has(ul)").addClass("sf-with-ul");
	$('ul.sf-menu li:has(li.current)').children(':first').addClass("current");
	$("ul.sf-menu li, ul.sf-menu li li").hover(function(){ $(this).addClass("sfHover"); }, function(){ $(this).removeClass("sfHover"); } );
	
	//========== @Login - Expand 
	$("a#slide-open").click(function(){
		$("div#slide-panel").show();  $(this).addClass("current"); return false;
	});	
	
	//========== @Login - Collapse 
	$("a#slide-close").click(function(){
		$("div#slide-panel").hide(); 
		$("a#slide-open").removeClass("current");
		return false;
	});	
	
	/* 
    ================================
    #Toggle Search
    ================================
    */
    $("a#slide-search", this).live("click", function(e) {
        e.preventDefault(); $(this).addClass("current");
        $(".top-search").slideToggle();
    });
    
    $("a#canvas-search-btn").live("click", function(e) {
        $(".top-search").toggle();
        $("#offcanvas").removeClass("uk-active");
         $(".uk-offcanvas-bar").removeClass("uk-offcanvas-bar-show");
    });
	
	$(".input-group-addon.close-search").on("click", function() {
		$(".top-search").slideUp();
	});
	
    /* 
    ================================
    #v5:NEW RESPONSIVE
    ================================
    */

    $("#at-navbar").click(function (i) {
      $("#offcanvas").toggleClass("uk-active");
      $(".uk-offcanvas-bar").toggleClass("uk-offcanvas-bar-show");
      i.preventDefault();
    });

    jQuery(document).keyup(function(event){

        if( $("#offcanvas").hasClass("uk-active")) {		
            if (event.keyCode == 27) {
                $("#offcanvas").removeClass("uk-active");
                $(".uk-offcanvas-bar").removeClass("uk-offcanvas-bar-show");
            }
        }		
    });


    $(window).resize(function() {
        var winwidth = $(window).width(); 
        var menu_opt = (winwidth > 1024) ?  "main" : "canvas";
        responsiveContent(menu_opt);
        
        responsiveMenu();
        
    });
	
	
/* 
================================
#v4: end:: NEW RESPONSIVE
================================
*/		
		
	if( $('div.event-box').length ) { $('div.event-box img').wrap($("<span class='evboxChopa'>"));	}
			
	
	/*//GENERAL*/
	$('a[href^="out.php"], a[href^="http://"], a[href^="https://"], a[href^="mailto:"], a[href^="tel:"], a[href*="lib.php"]').attr({ target: "_blank" });	
	if( $('.close-notify').length ){
    	$('.close-notify a').click(function () { $('#box_alert').hide();  }); //closeHelpDiv();
	}	
	
	
	if( $('div.main-guts address').length ) {
		$('div.main-guts address').append('<span class="q_c">&nbsp;</span>').wrap($("<div class='q_w'><div class='q_o'><em>")); 
	}
	
	
	/* @@ equal height */
	if($('div.equalized').length){ boxEqualHeight('equalized'); }
	if($('div.equalizedb').length){ boxEqualHeight('equalizedb'); }
	//if($('div.equalfoot').length){ boxEqualHeight('equalfoot'); }

	if($('div.pager').length){
		var pagerWidth = $(this).width();
		if(pagerWidth > 767){  $('.pager').each(function () { pagerSetup(this); }); }
	}
	
	/* ============= @@ forms ======================== */
	
	jQuery.validator.addMethod("notDefault", function(value, element) { return value != element.defaultValue;	}, "Required");
	
	$('label.required').append('<span class="rq"> *</span>');	
	
	if( $('select.optionItem').length )  {
		$('select.optionItem option').each(function(){		
			var parentId = $(this).parent("select").attr("name"); 		
			var oplink = $(this).text();
			var opLoad = $(this).attr('value');
			
			if(opLoad=='feedback.php' || opLoad=='onlineservice.php'){
				var opRedr = opLoad+'?com=66&sel='+parentId+'&form='+oplink;
				$(this).attr('value',opRedr )
			}																	
		});
	}
		
	if( $('.zebra').length ) 	{ 
		$(".zebra:odd, .zebra li:odd").addClass("odd"); }
		
		
	if( $('#searchform').length ) 	{ 
		$("#searchform").validate({errorPlacement: function(error, element) { }}); }
	
	
	if( $('#fm_dir_search').length ) { 
		$("#fm_dir_search").validate({ errorPlacement: function(error, element) {}, 
			rules: { 
				/*dir_type: { require_from_group: [1, ".dir-group"] },*/ 
				dir_keywords: { require_from_group: [1, ".dir-group"] } 
				} 
		}); 
	}
	
	
	if( $('#mailingtiny').length ) { $("#mailingtiny").validate(); }
		
	if( $('#mailingdetail').length ) 	{ 
		$("#mailingdetail").validate({errorContainer: ".errorBox" , errorPlacement: function(error, element) { }, rules: { txtCaptcha: {required: true, remote: "assets/captchajx/ajax_process.php"}}, messages: { txtCaptcha: "Correct captcha is required." }}); }
	
	
	if( $('#feedback').length ) {  
		$("#feedback").validate({errorContainer: ".errorBox" , errorPlacement: function(error, element) { }, rules: { txtCaptcha: {required: true, remote: "assets/captchajx/ajax_process.php"}}, messages: { txtCaptcha: "Correct captcha is required." }});
	}
	
	doFormsValidate();
	
	
	
	if($('.iframe_call').length){
		var iFrame = $('.iframe_call');
		iFrame.bind('load', function() { 
			var ifrmHeight = iFrame.contents().find(".frameguts").height()+15;
			iFrame.height(ifrmHeight);
		}); 
	}
	
	
	if($('#eventsignup').length){
		$("#eventsignup").validate({ errorContainer: ".errorBox" , errorPlacement: function(error, element) { } });
	}
	
	
	/* ============= @@ accordion ======================== */
	if( $('.accordion-box div.accordion-content').length ) { 
		doAccordion(); 
		
	}
	
	
	/* ============= @@ pagetabs ======================== */
	if( $('#dept_nav').length ) { 
		//doPageTabs(); 		
	}
	
	
	/*//AJAX-STAR-RATING*/
	if( $('.ratingblock').length ) { 
	  loadcssfile("assets/ajaxrating/js/ajaxrating.css");
	  loadjsfile("assets/ajaxrating/js/ajaxrating.js");
	}
	
});



jQuery(document).ready(function($){
    var pathname = window.location.href.split('#')[0];
    $('a[href^="#"]').each(function() {
        var $this = $(this); var alink = $this.attr('href'); $this.attr('href', pathname + alink);
    });
});


jQuery(document).ready(function($){
	$(".frmnoborder :input").not(".btn").css({"border-width":"0px 0px 1px", "background":"none"});
	$(".frmnoborder :input").not(".btn").each(function(index) {
       $(this).on("focusin", function(){ $(this).css({"background":"#fafafa"}); });
	   $(this).on("focusout", function(){ $(this).css({"background":"none"}); });
    });
	
	$(".frmNoEdit :input").prop("disabled", true).css({"border":"1px solid #ddd", "background":"none"}).removeClass("wysiwyg").removeClass("tags-field");
	$(".frmNoEdit").prop("action", "#");
	$(".frmNoEdit").find(":submit, .hideable").css("display", "none");
});



function boxEqualHeight(target) {
	jQuery(document).ready(function($) {
		if($("div."+target).length){ 
			var maxHeight = 0;
			$("div."+target).each(function(){ if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }	});
			$("div."+target).height(maxHeight);	
		}
	});	
}

function doAccordion() {
	jQuery(document).ready(function($) {
			
		$('.accordion-box div.accordion-content').hide(); 
		
		$('.accordion-box div.accordion-header a').click(function(){
			if($(this).parent().hasClass('accordion-header-active'))
			{
				$(this).parent().removeClass("accordion-header-active");
				$(this).parent().next().removeClass("accordion-content-active");
				$(this).parent().next().slideUp();
			}
			else
			{
				$(this).parent().addClass("accordion-header-active");
				$(this).parent().next().addClass("accordion-content-active");
				$(this).parent().next().slideDown();
			}
			return false;
		});
		
		$('.accordion-box').prepend('<div class="accd-com"><a class="accd-show">Expand All</a> | <a class="accd-close">Collapse All</a></div>');
		
		$('.accordion-box a.accd-close').click(function(e){
			var kids = $(e.target).parent().parent().attr("id"); 		
			$("#"+kids+" > div.accordion-content").slideUp();
			$("#"+kids+" > div.accordion-header").removeClass("accordion-header-active");
			$("#"+kids+" > div.accordion-content").removeClass("accordion-content-active");							
		});
		
		$('.accordion-box a.accd-show').click(function(e){
			var kids = $(e.target).parent().parent().attr("id"); 			
			$("#"+kids+" > div.accordion-content").slideDown();
			$("#"+kids+" > div.accordion-header").addClass("accordion-header-active");
			$("#"+kids+" > div.accordion-content").addClass("accordion-content-active");							
		});
	});	
}

function doImageDisplays() {
	jQuery(document).ready(function($) {
		
		
		/*//IMAGE FUNCTIONS*/
		if( $('div.page-bits img').length ){ $('div.page-bits img').wrap($("<span class='bitChopaTiny'>")); }
		if( $('div.news-bits img').length ){ $('div.news-bits img').wrap($("<span class='listChopa'>")); }
		
		if( $('div.eq33_cols img').length ){ $('div.eq33_cols img').wrap($("<span class='bitChopa'>")); }
		if( $('div.home-bits img').length ){ $('div.home-bits img').wrap($("<span class='bitChopa'>")); }	
		if( $('div.long-bits img').length ){ $('div.long-bits img').wrap($("<span class='bitChopa'>")); }	
		if( $('div.grid-item img').length ){ $('div.grid-item img').wrap($("<span class='bitChopa'>")); }	
		
		if( $('div.main-guts img').length ) {
			$('div.main-guts').addCaptions();
			var fncytitle;
			$('div.main-guts img').not(".midSize").each(function () {
				fncytitle = $(this).attr('title') !== undefined ? $(this).attr('title') : $(this).attr('alt');
				$(this).wrap($('<div class="gutChopa"><a class="modalpic" title="'+fncytitle+'">'));
			});
		}
	
		if( jQuery('.bitChopaWrap').length ){ jQuery('.bitChopaWrap').show(); 	
			if( jQuery('.menu-column').length ){ jQuery('.menu-column .carChopa').addClass("menuborder").show(); } }	
		if( jQuery('.bitChopa').length ){ jQuery('.bitChopa').show(); }
		if( jQuery('div.main-guts img').length ) { jQuery('div.main-guts img').show(); }
		
		
		$('.modalpic').each(function() {
			$(this).on("click", function(event){ 
		  		event.preventDefault();
				var icap = $(this).attr('title') !== '' ? $(this).attr('title') : "";
		  		var itag = '<div class="modal txtcenter"><div class="modal-content modal-auto">'+ $(this).html() +'</br>'+ icap +'<a class="close-modal" rel="modal:close">Close</a></div></div>';
		  		$(itag).appendTo('body').modal({ showClose: false});
		    });
		});
		
		$('.modalvid').each(function() {
			$(this).on("click", function(event){ 
		  		  event.preventDefault();
				  var iref = this.href; 
				  var itag = '<div class="modal txtcenter"><div class="modal-content modal-auto"><iframe src="'+iref+'" width="100%" height="500" frameborder="0" webkitallowfullscreen="" allowfullscreen=""></iframe></br>'+ $(this).attr('title') +' <a class="close-modal" rel="modal:close">Close</a></div></div>';
				  $(itag).appendTo('body').modal({ showClose: false});
		    });
		});
		
	});	
}


function doGridMasonry() {
	jQuery(document).ready(function($) {
		
		if( $('.grid-item').length ) {
            // Masonry layout
            $('.grid').masonry({
              // options
              // set positions with percent values
                percentPosition: true,
                columnWidth: '.grid-sizer',
                itemSelector: '.grid-item',
                columnWidth: 20,
                "gutter": 15
            });
        }
		
	});	
}




/*//DYNAMIC LOADERS BASE*/
jQuery(document).ready(function($){ 
	jQuery.cachedScript = function( url, options ) { 
	  options = $.extend( options || {}, { dataType: "script", cache: true, url: url }); 
	  return jQuery.ajax( options );
	};	
});

function loadcssfile(filename){  
  var fileref=document.createElement("link");
  fileref.setAttribute("rel", "stylesheet");
  fileref.setAttribute("type", "text/css");
  fileref.setAttribute("href", filename) ;
  //if (typeof fileref!="undefined") document.getElementsByTagName("head")[0].appendChild(fileref)
  if (typeof fileref!="undefined") { document.getElementById("dynaScript").appendChild(fileref); }
}

function loadjsfile(filename){
  var fileref=document.createElement('script');
  fileref.setAttribute("type","text/javascript");
  fileref.setAttribute("src", filename); 
 if (typeof fileref!="undefined") { document.getElementById("dynaScript").appendChild(fileref); }
}





/*// DYNAMIC LOADERS ACTUAL */
jQuery(document).ready(function($){ 
	
	
	//if (!$.isFunction($.fn.<functionName>) ) { <functionCall>(); }
	
	
	
	/*//JSCRIPT TRUNCATE/EXPAND*/
	if($('[class^="trunc"]').length) {
	  $.cachedScript( "assets/scripts/misc/jquery.truncator.js" ).done(function( script, textStatus ) { 
		$('.trunc400').show().truncate({max_length: 250});
		$('.trunc1200').show().truncate({max_length: 300});
	  });
	}
	
	/*//FANCY*/
	/*if( $('.fancyframe').length || $("a[rel=fancypop]").length || $('.fncy').length) { 
		loadcssfile("scripts/fancybox/jquery.fancybox-1.3.4.css");
		$.cachedScript( "scripts/fancybox/jquery.fancybox-1.3.4.pack.js" ).done(function( script, textStatus ) {		
			$("a[rel=fancypop]").fancybox({'transitionIn' : 'none','transitionOut' : 'none','titlePosition' : 'inside' });
			$("a.fancyframe").fancybox({'width' : '75%','height': '75%','autoScale': false,'transitionIn': 'none','transitionOut': 'none','type': 'iframe','titlePosition': 'outside' });
			$("a.fncy").fancybox();
		});
	}*/
	
	
	
	/*//DATA TABLE*/
	  zul_DataTable();
	
	
	/*//DATE PICKER*/
	  zul_DatePick()
	
	/*//NANO SCROLLER*/
	  nanoScroll();
	
	/*//WYSIWYG*/
	if( $('.wysiwyg').length ) { 
		loadcssfile("assets/scripts/jwysiwyg/jquery.wysiwyg.css");
		$.cachedScript( "assets/scripts/jwysiwyg/jquery.wysiwyg.js" ).done(function( script, textStatus ) {
			$('.wysiwyg').wysiwyg(); 
		});
	}
	
	
	/*//SITEMAP*/
	if( $('.sitemap').length ) { 
		loadcssfile("assets/scripts/sitemap/jquery.treeview.css");
		$.cachedScript( "assets/scripts/sitemap/jquery.treeview.js" ).done(function( script, textStatus ) {
			jQuery("#tree").treeview({ collapsed: false,animated: "medium",control:"#sidetreecontrol",persist: "location" });
		});
	}
	
	
	/*//MASKED INPUTS*/
	if( $('input[class*="mask_"]').length ) { 
	  $.cachedScript( "assets/scripts/validate/jquery.inputmask.js" ).done(function( script, textStatus ) { 
		if( $('.mask_date').length ) { $('.mask_date').inputmask( 'mm/dd/yyyy' ); }
		if( $('.mask_time').length ) { $('.mask_time').inputmask( 'h:s t' ); }
		if( $('.mask_phone').length ) { $('.mask_phone').inputmask('+999 999 999999'); }
	  });
	}
	
	
	
	/*//MULTI SELECT*/
	if( $('select.multiple').length ) { 
	  loadcssfile("assets/scripts/datatable/smoothness/jquery-ui-1.8.4.custom.css");
	  loadcssfile("assets/scripts/multiselect/jquery.multiselect.css");
	  $.cachedScript("assets/scripts/multiselect/jquery.multiselect.filter.js" ).done(function( script, textStatus ) {});
	  $.cachedScript("assets/scripts/multiselect/jquery.multiselect.js" ).done(function( script, textStatus ) { 
	  	
          if( $('select.multiple').hasClass("multi_sector") ) { 
              //alert($(this).attr('id'));
              var $callback = $("#callback");
              $("select.multi_sector").multiselect({
                  noneSelectedText: '- Select Sector -', selectedText: '# Sectors', selectedList: 1
              }); 
          } else {
              $("select.multiple").multiselect(); 
          }
          
	  });
	}
	
	
	
	/*//INTERNATIONAL PHONE*/
	if( $('.intl_phone').length ) {
	  loadcssfile("assets/scripts/intlphone/intlTelInput.css"); 
	  $.cachedScript("assets/scripts/intlphone/intlTelInput.js" ).done(function( script, textStatus ) { 
			
			$(".intl_phone").intlTelInput({utilsScript: "assets/scripts/intlphone/utils.js" });
			var intlCode = $(".intl_phone").intlTelInput("getSelectedCountryData").iso2;
			$(".country-list").on("click", function() {
			  intlCode = $(".intl_phone").intlTelInput("getSelectedCountryData").iso2; 
			});
			$(".intl_phone").on("blur", function() {
				$("input#intl_country").attr("value", intlCode);
			});			
	  });
	}
	
	
	
	/*//PAGED FORM*/
	/*if( $('form.form-paged').length ) { 
	  loadcssfile("assets/scripts/formpager/formToWizard.css");
	  $.cachedScript("assets/scripts/formpager/formToWizard.js" ).done(function( script, textStatus ) { 
	  	$("form.form-paged").formToWizard({ submitButton: 'frm_submit' })
	  });
	}*/
	
	
	
	
	
	/*//NEWS TICKER*/
	/*if( $('.breakingNews').length ) {		
		//loadcssfile("assets/scripts/newsticker/breakingNews.css");
		$.cachedScript("assets/scripts/newsticker/breakingNews.js").done(function( script, textStatus ) {			
			$("#ticker1").breakingNews({ effect :"slide-h", autoplay :true, timer :10000, color :"red", border :true });
			$('.breakingNews').css("display","block");
		});
	}*/

	if( $('.page-sidebar-menu').length ) {
		var curtab = getUrlVars()["ptab"]; 
		if ( curtab !== undefined ) { 
			var memberLink = $('a[data-id="'+curtab+'"]');
			memberLink.addClass("current"); 
			$(document).prop('title', memberLink.text()+' - '+sys_sitename);
		}
	}
	
    
    /*-----------------------------------------------------------------------------------*/
    /*	SCROLLER STUFF
    /*-----------------------------------------------------------------------------------*/
    
    if( $('#banner_flex').length ) {
		$.get('includes/wrap_banner_flex.php').done(function(data) {
          $('#banner_flex').html(data);
		  var getBanFlex = $(".bxslider").bxSlider({ mode: "fade", captions: false, pager: true, controls: false, auto: true, pause: 10000, onSlideAfter: function() { $(".bx-start").trigger("click"); }
			});
        });
	}
	
	if( $('.bxcarousel').length ) {
		$('.bxcarousel').bxSlider({
		  auto: true,pause: 10000,minSlides: 4,maxSlides: 4,slideMargin: 0, pager: false, controls: true
		});
	}
	
	
	if( $('.bxinner').length ) {
	   $('.bxinner').bxSlider();
    }
	
    
    if( $('.video').length ) {
         $(".video").click(function () {
          var theModal = $(this).data("target"),
          videoSRC = $(this).attr("data-video"),
          videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
          $(theModal + ' iframe').attr('src', videoSRCauto);
          $(theModal + ' button.close').click(function () {
            $(theModal + ' iframe').attr('src', videoSRC);
          });
        });
    }
	

	
    /*-----------------------------------------------------------------------------------*/
    /*	HITS UPDATE
    /*-----------------------------------------------------------------------------------*/

    /*$('.linkMenu').click(function () {	
        $.post("ajx_hits.php",{ ht_tb:'tb_menu',ht_id:$(this).attr("data-id"),rand:Math.random() } ,function(data){});
    });*/

    $('.linkCont').click(function () {	
        $.post("ajhits.php",{ ht_tb:'tb_cont',ht_id:$(this).attr("data-id"),rand:Math.random() } ,function(data){}); /*return false;*/
    });

    $('.linkRes').click(function () {	
        $.post("ajhits.php",{ ht_tb:'tb_docs',ht_id:$(this).attr("data-id"),rand:Math.random() } ,function(data){}); 
    });	
	
    
    if( $('.resp-tabs-container').length ) {
        $(".resp-tabs-container").ajaxComplete(function() {
            doAjaxPageStyling();
        });
    }
	
});




function zul_DataTable() {
	jQuery(document).ready(function($) {		
		
		/*//DATA TABLE*/
		if( $('table.display').length ) { 
			loadcssfile("assets/scripts/datatable/jquery.dataTables.css");
			loadcssfile("assets/scripts/datatable/jquery.dataTables.override.css");
			$.cachedScript( "assets/scripts/datatable/jquery.dataTables-1.10.12.min.js" ).done(function( script, textStatus ) {
				$('table.display').dataTable({
					"bProcessing": true
					, "bJQueryUI": true
					, "sPaginationType": "full_numbers"
					, "bStateSave": true 
					, "aaSorting":  []
					, "iDisplayLength": 10 
					, "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
					, "scrollX": true
				});
				
			});
		}
		
	});	
}

function zul_DatePick() {
	jQuery(document).ready(function($) {		
		
	if( $('.hasDatePicker').length ) { 
		
	  $('#dynaScript').append('<div style="display: none;"><img id="calimg" src="assets/scripts/datepick/calendar-green.gif" alt="Popup" class="triggerX padd5X"></div>');
	  loadcssfile("assets/scripts/datepick/jquery.datepick.css");
	  $.cachedScript( "assets/scripts/datepick/jquery.plugin.js" ).done(function( script, textStatus ) {});
	  $.cachedScript( "assets/scripts/datepick/jquery.datepick.js" ).done(function( script, textStatus ) { 
		
		if( $('.dateOne').length ) { 
			var f;
			$('.dateOne').datepick({
			onSelect: function(dates) { 
				f = new Date(dates); 
				
				if( $('.dateTwo').length ) { 
					$('.dateTwo').live('click', function() {
						$(this).datepick('destroy').datepick({showOn:'focus', minDate: f}).focus();
					});
				}
			}});
		}
		$('.hasDatePicker').datepick();
		
	  });
	}
		
	});	
}

function responsiveMenu() {	
  jQuery(document).ready(function($) {
	var wd = window.innerWidth; 
	  
	if( $("#search-bar").length ) { 		
		if(wd < 901){ 
			var searchBox = $("#search-bar").clone().end().html(); 
			$(".canvas-search").html(searchBox);
		}
	}
	  
	/*if( $("#google_translate_element").length ) {   	
		if(wd < 901){ 
			var navRightBox = $("#google_translate_element").clone().end().html(); 
			$("#google_translate_elementb").html(navRightBox);
		}
	} */ 
  });	
}


function responsiveMenuClose() {	
  jQuery(document).ready(function($) {
	if( $("#offcanvas").hasClass("uk-active")) {	
		$("#offcanvas").removeClass("uk-active");
		$(".uk-offcanvas-bar").removeClass("uk-offcanvas-bar-show");
	}	
  });	
}




function nanoScroll() {	
  jQuery(document).ready(function($) {
	  loadcssfile("assets/scripts/nanoscroll/jquery.nanoscroller.css");
	  $.cachedScript("assets/scripts/nanoscroll/jquery.nanoscroller.min.js" ).done(function( script, textStatus ) { 
		$(".nano").nanoScroller();
	  });
  });	
}


function doLoaderContPlaces() {
	
	jQuery(document).ready(function($){
		if( $('#places_container').length ) 
		{
			//$('.infinite-loading').show();
			var resParent = $('#places_container').attr('data-menu'); 
			var resPage = $('#places_container').attr('data-page'); 			
			var resLink = "includes/inc.cont.places.list.php?com="+resParent+"&page="+resPage+"";
			$.getJSON(resLink, function(data) { 
				$('#places_container').append(data.text);
				//$('.infinite-loading').hide();
				doAjaxPageStyling();
				doLoaderInfinite();
			});
		}		
	});
}


function doLoaderInfinite() {
	jQuery(document).ready(function($){
		if( $('.infinite-more-link').length )  {
			$('.infinite-more-link').live('click', function(e) 
			{
				$('.infinite-loading').show();
				var infiniRef = $(this).attr("data-href"); 
				$.getJSON(infiniRef, function(data) { 
					$('.infinite-container').append(data.text);
					$('.infinite-more-wrap').html(data.href);
					$('.infinite-loading').hide();
					
					doAjaxPageStyling();
					
				});
			});
		}
	});
}


function doColumnPlaceholders() {
	var placeholderID, numPlaceholderZIndex, placeholderHeight;
	jQuery(document).ready(function($){
		if( $('.NormalPlaceholder').length ) 
		{
			$(".NormalPlaceholder").hover(
				function(){
					placeholderID = $(this).attr('id');
					placeholderHeight = $(this).height(); 
					placeholderID = placeholderID.replace("normalplaceholder","");			
					$("#masterDiv" + placeholderID).parent().show();
					$("#masterDiv" + placeholderID).show();	
					numPlaceholderZIndex = $(this).css('zIndex');					
					$(this).css('zIndex',1005);
					$(this).addClass("active");
					$(this).height(placeholderHeight);
				},
				function(){
					placeholderID = $(this).attr('id');
					placeholderID = placeholderID.replace("normalplaceholder","");			
					$("#masterDiv" + placeholderID).parent().hide();
					$("#masterDiv" + placeholderID).hide(); 			
					$(this).css('zIndex',numPlaceholderZIndex);
					$(this).removeClass("active");
				}
			);
		}		
	});
}


function doPageTabsResponsive() {
	jQuery(document).ready(function($) {
		if( $('#verticalTab').length ) { $('#verticalTab').easyResponsiveTabs({type: 'vertical',width: 'auto',fit: true});}
	});
}


function doPageTabs() {
	jQuery(document).ready(function($) 
	{
		if( $('#dept_nav').length ) 
		{ 
			var hash = window.location.hash.substr(1); 
	        if(hash === '') { hash = $('#dept_nav li a:first').attr('data-id'); }
            
            jQuery(".pgtabsloader").show();		
			
			var href = $('#dept_nav li a').each(function(){		
				var tabId = $(this).attr('data-id');	
				var token = Math.random();		
                
				if(hash === tabId){ 			
                    jQuery("#dept_nav li a").removeClass("active");
					jQuery(this).addClass("active");
					var tabUr = $(this).attr('data-url')+'&token='+token+' #content';
					jQuery(".pgtabscontent").load(tabUr, function(){ doAjaxPageStyling(); });
					jQuery(".pgtabsloader").hide();	
				}											
			});
			
			
			jQuery("#dept_nav li a").click(function()
			{	
				jQuery(".pgtabsloader").show();	
				var tabId = jQuery(this).attr("data-id");
				var token = Math.random();				
				jQuery("#dept_nav li a").removeClass("active");
				jQuery(this).addClass("active");	
                
                window.location.hash = tabId;
				
				var tabUr = jQuery(this).attr('data-url')+'&token='+token+' #content';
				jQuery(".pgtabscontent").load(tabUr, function(){ doAjaxPageStyling(); });		
				jQuery(".pgtabsloader").hide();	
				return false;
			});
            
           
		}
	});
}

function doFormsValidate() { 
	jQuery(document).ready(function($) {		
				
		if($('.rwdvalid').length) 
		{   /* Multiselect - require one*/
			$.validator.addMethod("needsSelection", function (value, element) { var count = $(element).find('option:selected').length; return count > 0; });
			
			/* Multicheckbox - require one*/
			$.validator.addMethod("require-one", function (value, element) { return $('.require-one:checked').size() > 0; })
			
			/* WYSIWYG - required */
			$.validator.addMethod("wysi_required", function (value, element) { return $('.wysi-required').val() !== ''; })
			
			$(".rwdvalid").validate({errorContainer: ".errorBox" , errorPlacement: function(error, element) { } });
		}
	});
}


function doAjaxPageStyling() { 
	jQuery(document).ready(function($) {		
		boxEqualHeight('equalized'); 
		if( $('.accmenu').length )  {  $('.accmenu').initMenu(); }
		doImageDisplays();
		doColumnPlaceholders();
        doGridMasonry();
	});
}


function doFeedTabs(sf_feed) {
	var sf_title = sf_feed;
	if(sf_title === undefined) { sf_title = 'sf_facebook'; }	
	
	jQuery(document).ready(function($) {
		if( $('#sf_social_media').length ) 
		{ 
		$(".tabsloader").show();
		
		var feed_twitter_script = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';	
	
		$("#feed_sf_twitter").html(feed_sf_twitter + feed_twitter_script);
		$("#feed_sf_facebook").append(feed_sf_facebook);
		
		$(".tabscontent .content:first").css("display", "block");
		$(".tabsloader").hide();	
		}
	});
}


function kbModalLoaded() {
	jQuery(document).ready(function($) {		
		
		$('a[href^="out.php"], a[href^="http://"], a[href^="https://"], a[href^="mailto:"]').attr({ target: "_blank" });	
		
		if( $('.modal-body').length ) 
		{  var _self = $('.modal-body'); if (_self.outerHeight() > 400){  _self.addClass('modal-scroll'); } }
		
		if( $('#request_contact').length ) 	{ 
			$("#request_contact").validate({errorPlacement: function(error, element) { }}); }
		
		if( $('.rwdvalid').length ) { 
			$(".rwdvalid").validate({errorPlacement: function(error, element) { }}); }
				
		if( $('#fm_showcase').length ) 	{
			var template = $.validator.format($("#party_filler").val());
			function addRow_ed() { if(j<10){ j= i++;  $(template(j)).appendTo("#party tbody"); } }
			function delRow_ed() { $(".tr_party_"+j).remove(); j= j-1; }
			var j = 1; 	var i = 1; 	addRow_ed(); 
			$("#add_party").click(addRow_ed); $("#del_party").click(delRow_ed); 
			
			$("#fm_showcase").validate({errorPlacement: function(error, element) { }});
		}
		
		if( $('.modal-long').length ) 	{
			$(window).resize(function () {
                var mod_long_height = ($(window).height() > 500) ?  500 : $(window).height() - 200;
                
				$('.modal-long').css({ 'height': mod_long_height, 'padding-bottom': '100px' });
				$('.modal.current').css({ 'top':'5%', 'bottom': '5%', 'margin-top': '0px' });
			}).resize();			
		}
		
		if( $('.nano').length ){ $(".nano").nanoScroller(); }
		
		/*if( $('.bxinner').length ){ $('.bxinner').bxSlider(); }*/
	});
}



function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}




jQuery(window).load(function () {   
	
	doImageDisplays();
	responsiveMenu();
	
    doGridMasonry();
    
	doFeedTabs();
	doPageTabs();
    doPageTabsResponsive();
	
	doLoaderContPlaces();
	/*doColumnPlaceholders();*/
	
	
});

