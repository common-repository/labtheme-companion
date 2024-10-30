jQuery(document).ready(function($) {
	$(document).on('click','.expand-faq', function(e){
		e.preventDefault();
		if($(this).children('svg').hasClass('fa-toggle-on')){
			$(this).children('svg').toggleClass('fas fa-toggle-off');
		}
		else if($(this).children('svg').hasClass('fa-toggle-off')){
			$(this).children('svg').toggleClass('fas fa-toggle-on');
		}
		if(!$('.labtheme-faq-holder .inner').hasClass('open'))
		{
			$('.labtheme-faq-holder .inner').addClass('open');
			$('.labtheme-faq-holder li').addClass('show');
			$('.labtheme-faq-holder .inner').slideDown('slow');
		}
		else
		{
			$('.labtheme-faq-holder .inner').removeClass('open');
			$('.labtheme-faq-holder li').removeClass('show');
			$('.labtheme-faq-holder .inner').slideUp('slow');
		}
	});
	$('.faq-answer').slideUp();
	$('.toggle').click(function(e) {
	  	e.preventDefault();
	  
	    var $this = $(this);
	  
	    if ($this.parent().hasClass('show')) {
	        $this.parent().removeClass('show');
	        $this.next().slideUp(350);
	    } 
	    else
	    {
	        $this.parent().removeClass('show');
	        $this.next().slideUp(350);
	        $this.parent().toggleClass('show');
	        $this.next().slideToggle(350);
	    }
	});
});

jQuery(document).ready(function(a) {
    a(".shortcode-slider .slides").lightSlider({
        mode: "slide",
        item: 1,
        slideMargin: 0,
        pager: !1,
        enableDrag: !1
    }), a(".labtheme_accordian .labtheme_accordian_content").hide(), a(".labtheme_accordian:first").children(".labtheme_accordian_content").show(), a(".labtheme_accordian:first").children(".labtheme_accordian_title").addClass("active"), a(".labtheme_accordian_title").click(function() {
        a(this).hasClass("active") || (a(this).parent(".labtheme_accordian").siblings().find(".labtheme_accordian_content").slideUp(), a(this).next(".labtheme_accordian_content").slideToggle(), a(this).parent(".labtheme_accordian").siblings().find(".labtheme_accordian_title").removeClass("active"), a(this).toggleClass("active"))
    }), a(".labtheme_toggle.close .labtheme_toggle_content").hide(), a(".labtheme_toggle.open .labtheme_toggle_title").addClass("active"), a(".labtheme_toggle_title").click(function() {
        a(this).next(".labtheme_toggle_content").slideToggle(), a(this).toggleClass("active")
    }), a(".labtheme_tab").hide(), a(".labtheme_tab_wrap").prepend('<div class="labtheme_tab_group clearfix"></div>'), a(".labtheme_tab_wrap").each(function() {
        a(this).children(".labtheme_tab").find(".tab-title").prependTo(a(this).find(".labtheme_tab_group")), a(this).children(".labtheme_tab").wrapAll("<div class='labtheme_tab_content clearfix' />")
    }), a("#page").each(function() {
        a(this).find(".labtheme_tab:first-child").show(), a(this).find(".tab-title:first-child").addClass("active")
    }), a(".labtheme_tab_group .tab-title").click(function() {
        a(this).siblings().removeClass("active"), a(this).addClass("active"), a(this).parent(".labtheme_tab_group ").next(".labtheme_tab_content").find(".labtheme_tab").hide();
        var t = a(this).attr("id");
        a(this).parent(".labtheme_tab_group ").next(".labtheme_tab_content").find("." + t).show()
    })
});