/**
*	@name							Accordion
*	@descripton						This Jquery plugin makes creating accordions pain free
*	@version						1.4
*	@requires						Jquery 1.2.6+
*
*	@author							Jan Jarfalk
*	@author-email					jan.jarfalk@unwrongest.com
*	@author-website					http://www.unwrongest.com
*
*	@licens							MIT License - http://www.opensource.org/licenses/mit-license.php
*/
;
(function($) {
    $.fn.extend({
        accordion: function() {
            return this.each(function() {
                function b(c, b) {
                    $(c).parent(d).siblings().removeClass(e).children(f).slideUp(g);
                    $(c).siblings(f)[b || h](b == "show" ? g : !1, function() {
                        $(c).siblings(f).is(":visible") ? $(c).parents(d).not(a.parents()).addClass(e) : $(c).parent(d).removeClass(e);
                        b == "show" && $(c).parents(d).not(a.parents()).addClass(e);
                        $(c).parents().show()
                    })
                }
                var a = $(this),
                    e = "active",
                    h = "slideToggle",
                    f = "ul, div",
                    g = "fast",
                    d = "li";
                if (a.data("accordiated")) return !1;
                $.each(a.find("ul, li>div"),
                    function() {
                        $(this).data("accordiated", !0);
                        $(this).hide()
                    });
                $.each(a.find(".opener"), function() {
                    $(this).click(function() {
                        //b(this, h)
						/*rage */
						if($(this).parent('li').hasClass('active')){
							$(this).parent('li').removeClass('active').children(f).slideUp(g);
						} else {
							$(this).parent('li').siblings().removeClass('active').children(f).slideUp(g);
							$(this).parent('li').addClass('active');
						}
                    });
                    /*$(this).bind("activate-node", function() {
                        a.find(f).not($(this).parents()).not($(this).siblings()).slideUp(g);
                        b(this, "slideDown")
                    })*/
                });
                var i = location.hash ? a.find("a[href=" + location.hash + "]")[0] : a.find("li.current a")[0];
                i && b(i, !1)
            })
        }
    })
})(jQuery);