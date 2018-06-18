
jQuery(window).load(function() {
	"use strict";

	// Page Preloader
	if(jQuery('#preloader').length) {
		jQuery('#preloader').delay(350).fadeOut(function(){
			jQuery('body').delay(350).css({'overflow':'visible'});
		});
	}
});

jQuery(document).ready(function() {
	"use strict";
	// Toggle Left Menu
	jQuery('.leftpanel .nav-parent > a').live('click', function() {
		
		var parent = jQuery(this).parent();
		var sub = parent.find('> ul');
		
		// Dropdown works only when leftpanel is not collapsed
		if(!jQuery('body').hasClass('leftpanel-collapsed')) {
			if(sub.is(':visible')) {
				sub.slideUp(200, function(){
				parent.removeClass('nav-active');
				jQuery('.mainpanel').css({height: ''});
				adjustmainpanelheight();
				});
			} else {
				closeVisibleSubMenu();
				parent.addClass('nav-active');
				sub.slideDown(200, function(){
					adjustmainpanelheight();
				});
			}
		}
		return false;
	});

	function closeVisibleSubMenu() {
		jQuery('.leftpanel .nav-parent').each(function() {
			var t = jQuery(this);
			if(t.hasClass('nav-active')) {
				t.find('> ul').slideUp(200, function(){
				t.removeClass('nav-active');
				});
			}
		});
	}

	function adjustmainpanelheight() {
		// Adjust mainpanel height
		var docHeight = jQuery(document).height();
		if(docHeight > jQuery('.mainpanel').height())
			jQuery('.mainpanel').height(docHeight);
	}
	adjustmainpanelheight();
	
	// Tooltip
	jQuery('.tooltips').tooltip({ container: 'body'});

	// Popover
	jQuery('.popovers').popover();

	// Close Button in Panels
	jQuery('.panel .panel-close').click(function(){
		jQuery(this).closest('.panel').fadeOut(200);
		return false;
	});

	// Form Toggles
	jQuery('.toggle').toggles({on: true});

	jQuery('.toggle-chat1').toggles({on: false});

	// Minimize Button in Panels
	jQuery('.minimize').click(function(){
		var t = jQuery(this);
		var p = t.closest('.panel');
		if(!jQuery(this).hasClass('maximize')) {
			p.find('.panel-body, .panel-footer').slideUp(200);
			t.addClass('maximize');
			t.html('&plus;');
		} else {
			p.find('.panel-body, .panel-footer').slideDown(200);
			t.removeClass('maximize');
			t.html('&minus;');
		}
		return false;
	});


	// Add class everytime a mouse pointer hover over it
	jQuery('.nav-bracket > li').hover(function(){
		jQuery(this).addClass('nav-hover');
	}, function(){
		jQuery(this).removeClass('nav-hover');
	});


	// Menu Toggle
	jQuery('.menutoggle').click(function(){
		var body = jQuery('body');
		var bodypos = body.css('position');
		
		if(bodypos != 'relative'){
			if(!body.hasClass('leftpanel-collapsed')){
				body.addClass('leftpanel-collapsed');
				jQuery('.nav-bracket ul').attr('style','');
				jQuery(this).addClass('menu-collapsed');
			}
			else{
				body.removeClass('leftpanel-collapsed chat-view');
				jQuery('.nav-bracket li.active ul').css({display: 'block'});
				jQuery(this).removeClass('menu-collapsed');
			}
		}
		else{
			if(body.hasClass('leftpanel-show'))
				body.removeClass('leftpanel-show');
			else
				body.addClass('leftpanel-show');
			
			adjustmainpanelheight();
		}
	});

	// Chat View
	jQuery('#chatview').click(function(){
		var body		= jQuery('body');
		var bodypos		= body.css('position');
		
		if(bodypos!='relative'){
			if(!body.hasClass('chat-view')){
				body.addClass('leftpanel-collapsed chat-view');
				jQuery('.nav-bracket ul').attr('style','');
			}
			else{
				body.removeClass('chat-view');
				if(!jQuery('.menutoggle').hasClass('menu-collapsed')){
					jQuery('body').removeClass('leftpanel-collapsed');
					jQuery('.nav-bracket li.active ul').css({display: 'block'});
				}
				else{
					
				}
			}
		}
		else{
			if(!body.hasClass('chat-relative-view')) {
				body.addClass('chat-relative-view');
				body.css({left: ''});
			}
			else{
				body.removeClass('chat-relative-view');
			}
		}
	});

	reposition_topnav();
	reposition_searchform();

	jQuery(window).resize(function(){
		if(jQuery('body').css('position')=='relative'){
			jQuery('body').removeClass('leftpanel-collapsed chat-view');
		}
		else{
			jQuery('body').removeClass('chat-relative-view');         
			jQuery('body').css({left: '', marginRight: ''});
		}
		reposition_searchform();
		reposition_topnav();
	});

	/* This function will reposition search form to the left panel when viewed
		* in screens smaller than 767px and will return to top when viewed higher
		* than 767px
		*/
	function reposition_searchform(){
		if(jQuery('.searchform').css('position')=='relative'){
			jQuery('.searchform').insertBefore('.leftpanelinner .userlogged');
		}
		else{
			jQuery('.searchform').insertBefore('.header-right');
		}
	}

	/* This function allows top navigation menu to move to left navigation menu
		* when viewed in screens lower than 1024px and will move it back when viewed
		* higher than 1024px
		*/
	function reposition_topnav(){
		if(jQuery('.nav-horizontal').length > 0)
		{
			// top navigation move to left nav
			// .nav-horizontal will set position to relative when viewed in screen below 1024
			if(jQuery('.nav-horizontal').css('position')=='relative'){
				if(jQuery('.leftpanel .nav-bracket').length == 2){
					jQuery('.nav-horizontal').insertAfter('.nav-bracket:eq(1)');
				}
				else{
					// only add to bottom if .nav-horizontal is not yet in the left panel
					if(jQuery('.leftpanel .nav-horizontal').length==0)
						jQuery('.nav-horizontal').appendTo('.leftpanelinner');
				}
				jQuery('.nav-horizontal').css({display: 'block'}).addClass('nav-pills nav-stacked nav-bracket');
				
				jQuery('.nav-horizontal .children').removeClass('dropdown-menu');
				jQuery('.nav-horizontal > li').each(function(){
					jQuery(this).removeClass('open');
					jQuery(this).find('a').removeAttr('class');
					jQuery(this).find('a').removeAttr('data-toggle');
				});
				
				if(jQuery('.nav-horizontal li:last-child').has('form')){
					jQuery('.nav-horizontal li:last-child form').addClass('searchform').appendTo('.topnav');
					jQuery('.nav-horizontal li:last-child').hide();
				}
			}
			else{
				// move nav only when .nav-horizontal is currently from leftpanel
				// that is viewed from screen size above 1024
				if(jQuery('.leftpanel .nav-horizontal').length > 0){
					jQuery('.nav-horizontal').removeClass('nav-pills nav-stacked nav-bracket').appendTo('.topnav');
					jQuery('.nav-horizontal .children').addClass('dropdown-menu').removeAttr('style');
					jQuery('.nav-horizontal li:last-child').show();
					jQuery('.searchform').removeClass('searchform').appendTo('.nav-horizontal li:last-child .dropdown-menu');
					jQuery('.nav-horizontal > li > a').each(function(){
						jQuery(this).parent().removeClass('nav-active');
						if(jQuery(this).parent().find('.dropdown-menu').length > 0){
							jQuery(this).attr('class','dropdown-toggle');
							jQuery(this).attr('data-toggle','dropdown');  
						}
					});
				}
			}
		}
	}
	
	// Left Panel Collapsed
	if(jQuery.cookie('leftpanel-collapsed')){
		jQuery('body').addClass('leftpanel-collapsed');
		jQuery('.menutoggle').addClass('menu-collapsed');
	}

	// Check if leftpanel is collapsed
	if(jQuery('body').hasClass('leftpanel-collapsed'))
		jQuery('.nav-bracket .children').css({display: ''});
		
		
	// Handles form inside of dropdown 
	jQuery('.dropdown-menu').find('form').click(function (e){
		e.stopPropagation();
	});
	
	/** BEGIN - REMOVE TOP & MAIN NOTIFICATIONS **/
	if ($('#remove-top-notification').length > 0){
		$("#remove-top-notification").click(function(){
			"use strict";
			
			// Remove classes...
			$(".headerbar").removeClass("has-top-notification");
			$(".rightpanel").removeClass("has-top-notification");
			$(".logopanel").removeClass("has-top-notification");
			$(".pageheader").removeClass("has-top-notification");
			$(".leftpanel").removeClass("has-top-notification");
			$(".mainpanel").removeClass("has-top-notification");
			$(".contentpanel").removeClass("has-top-notification");
			$(".top-notification").addClass("close-notification");
			
			// Set cookie...
			removeNotification('notify-phpkb-autosave','no',1,'remove-top-notification||remove-main-notification');
		});
	}
	if($('#remove-main-notification').length > 0){
		$('#remove-main-notification').click(function(){
			"use strict";
			
			// Remove classes...
			$(".headerbar").removeClass("has-top-notification");
			$(".rightpanel").removeClass("has-top-notification");
			$(".logopanel").removeClass("has-top-notification");
			$(".pageheader").removeClass("has-top-notification");
			$(".leftpanel").removeClass("has-top-notification");
			$(".mainpanel").removeClass("has-top-notification");
			$(".contentpanel").removeClass("has-top-notification");
			$(".top-notification").addClass("close-notification");
			
			// Set cookie...
			removeNotification('notify-phpkb-autosave','no',1,'remove-top-notification||remove-main-notification');
		});
	}
	/** END - REMOVE TOP & MAIN NOTIFICATION **/
	
	// Header search...
	jQuery(".searchform").submit(function(event){
		event.preventDefault();
		var _h_sp_kwds = jQuery('#header_sp_keywords').val();
		if(_h_sp_kwds!=''){
			window.location='manage-articles.php?status=search&sp=y&sp_search_in=all&sp_keywords='+encodeURIComponent(_h_sp_kwds);
		}
	});
	
	// Panel click events...
	jQuery("#header_logo_panel").click(function(){
		window.location='index.php';
	});
	jQuery("#dashboard_visits_panel").click(function(){
		window.location='report-traffic.php';
	});
	jQuery("#dashboard_articles_panel").click(function(){
		window.location='manage-articles.php?status=pending';
	});
	jQuery("#dashboard_tickets_panel").click(function(){
		window.location='manage-tickets.php?status=open';
	});
	jQuery("#dashboard_comments_panel").click(function(){
		window.location='manage-comments.php';
	});
	
	
	(function (jQuery){
		jQuery.fn.showDialog = function (options, callback){
			jQuery('#permanent_action').unbind().modal();
			jQuery('#permanent_action .pa_button').unbind().on('click', function (){
				callback();
			});
		}
	}(jQuery));
	
	jQuery('.bulkaction').click(function (event){
		event.preventDefault();
		var action_id	= jQuery('#bulk_action_id').val();
		var num_results	= jQuery('#ba_num_results').val();
		var Count = parseInt(num_results);
		if(Count > 0){
			var ids='';
			var countCheck=0;
			for(var i=1; i<=Count; i++){
				if(document.getElementById('bulkcheckbox'+i).checked==true){
					ids += document.getElementById('bulkcheckbox'+i).value+'|||';
					countCheck++;
				}
			}
		}
		if(	(action_id=='Delete Selected'||action_id=='Delete Revisions'||action_id=='Remove Comments'||action_id=='Delete Selected'||
			action_id=='Discard Selected'||action_id=='Purge Selected') && countCheck > 0){
			jQuery(this).showDialog(null, function (){
				jQuery('#permanent_action').modal('hide');
				jQuery("#bulkActionForm").submit();
			});
		}
		else{
			jQuery("#bulkActionForm").submit();
		}
	});
	
	function hide_messages()
	{
		// Success message (if any)...
		setTimeout(function(){
			jQuery("#success_msg").hide(); 
		}, 15000);
		setTimeout(function(){
			jQuery("#custom_success_msg").hide(); 
		}, 15000);
		
		/**
		// DON'T HIDE ERROR/WARNING/CUSTOM MESSAGES...
		// error message (if any)...
		setTimeout(function(){
			jQuery("#error_msg").hide(); 
		},15000);
		// Warning message (if any)...
		setTimeout(function(){
			jQuery("#warning_msg").hide(); 
		}, 15000);
		// Info message (if any)...
		setTimeout(function(){
			jQuery("#info_msg").hide(); 
		}, 15000);
		// Custom message (if any)...
		setTimeout(function(){
			jQuery("#custom_msg").hide(); 
		}, 15000);
		*/
	}
	// Do hide...
	hide_messages();
	
	/** BEGIN BACK TO TOP **/
	jQuery(function () {
		jQuery("#back-top").hide();
	});
	jQuery(function (){
		jQuery(window).scroll(function (){
			if(jQuery(this).scrollTop() > 100){
				$('#back-top').fadeIn();
			}
			else{
				$('#back-top').fadeOut();
			}
		});
		$('#back-top a').click(function (){
			$('body,html').animate({
				scrollTop: 0
			}, 400);
			return false;
		});
	});
	/** END BACK TO TOP **/
});