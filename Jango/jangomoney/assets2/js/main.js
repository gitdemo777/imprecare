/*
Template Name: Sander - App Landing Page
Author: AsceticDesigners
Version: 1.0
Email: md.ashiful.haque@gmail.com
*/
(function($){
	'use strict';
/*============= HEADER EFFECT ===========*/
function FixedHeader(){
	$(window).on("scroll",function(){
		var scrollPos = $(window).scrollTop(),
			SliderHeight = $(".slider-area").height();
		if(scrollPos >150){
			$(".navbar-fixed-top").addClass("open");
			if(scrollPos >= SliderHeight){
				$(".navbar-fixed-top").addClass("padding-less");
			}
			else{
				$(".navbar-fixed-top").removeClass("padding-less");
			}
		}
		else if(scrollPos < 150){
			$(".navbar-fixed-top").removeClass("open");
		}
		return false;
	});
}
	
	
/*============= HEADER CURRENT SECTION ACTIVE LINK ===========*/
function currentNav(){
	$('#top-menu').onePageNav({
		currentClass: 'active'
	});
}	

/*============= SMOOTHSCROLL ===========*/
function smoothScroll(){
	$('.slide-btn a, #top-menu li a').on("click",function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top
			}, 800);
			return false;
		  }
		}
	});
}
		
/*============= MAIN SLIDER ===========*/
function mainSlider(){
	$("#mainslider,#mainslider2").owlCarousel({
		items:1,
		autoplay:true,
		autoplayTimeout:8000,
		loop:true,
		margin:0,
		nav:false,
		dots:true,
		responsiveClass:true,
		autoHeight: true
	 });	
}

/*============= TESTIMONIAL SECTION CUAROSEL ===========*/
function testimonialCarousel(){
	$(".testimonial-carousel").owlCarousel({
		items:1,
		autoplay:true,
		autoplayTimeout:4000,
		loop:true,
		margin:0,
		nav:false,
		dots:true,
		responsiveClass:true,
		autoHeight: true
	 });	
}	

/*============= SLIDER BUTTON HOVER ACTIVE ===========*/
function slideBtn(){
	$(".slide-btn a").hover(function(){
		$(".slide-btn a").removeClass("s-btn-active");
		$(this).addClass("s-btn-active");
	});
}

/*============= WOW JS INSTALL ===========*/
function WowJsInitT(){
	new WOW().init();
}

/*============= TAB NAV MAGICLINE CURRENT ITEM ===========*/
function feturedNavActive(){
	$('#fetured-nav li a').on('click',function(event){
		event.preventDefault();
		$('li').each(function(){  $(this).removeClass('current-iem');           

		});
		$(this).parent().addClass('current-iem');
		Tabmagicline();
	});
}

/*============= WHYCHOOSE SECTION LIST ICON ACTIVE ===========*/
function whychooseList(){
	$(".whychoose-list ul li").hover(function(){
		$(".whychoose-list ul li").removeClass("choose-list-active");
		$(this).addClass("choose-list-active");
	});
}

/*============= SVG IMAGE TO CODE CONVERT ===========*/
function svgInline(){
	$('img.svg-icon').each(function(){
		var $img = $(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		$.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			var $svg = $(data).find('svg');

			// Add replaced image's ID to the new SVG
			if(typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			// Add replaced image's classes to the new SVG
			if(typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass+' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Replace image with new SVG
			$img.replaceWith($svg);

		}, 'xml');

	});
}

/*============= TESTIMONIAL SECTION RATING ===========*/
function bootstrapRating(){
	$('.rating-tooltip-manual').rating();
}

/*============= ACCORDION ACTIVE EXPAND ===========*/
function accordionExpand(){
	$(".accordion-heading a").on("click",function(){
		var expand = $(this).parents(".panel").attr("id"),
			expandBtn = $(".accordion-heading a");
		expandBtn.parents(".panel").removeAttr("id","expand");
		if(expand == "expand"){
			expandBtn.parents(".panel").removeAttr("id","expand");
		}
		else{
			 $(this).parents(".panel").attr("id","expand");
		}
		
	});
}



/*============= PRICING TABLE BUTTON HOVER ACTIVE ===========*/
function priceActive(){
	$(".single-price").hover(function(){
		$(".single-price").removeClass("active");
		$(this).addClass("active");
	});
}

/*============= WINDOW  LOAD FUNCTION ===========*/
$(window).on("load resize scroll", function(){
	if (typeof Navmagicline == 'function'){ 
			Navmagicline(); 
		}
	if (typeof Tabmagicline == 'function'){ 
		Tabmagicline(); 
	}

});

/*=============All FUNCTION WHEN DOCUMENT  READY ===========*/
$(function(){
	if (typeof FixedHeader == 'function'){ 
			FixedHeader(); 
		}
	if (typeof currentNav == 'function'){ 
			currentNav(); 
		}
	if (typeof smoothScroll == 'function'){ 
			smoothScroll(); 
		}
	if (typeof owlCarouselInit == 'function'){ 
			owlCarouselInit(); 
		}
	if (typeof mainSlider == 'function'){ 
			mainSlider(); 
		}
	if (typeof mainSlider2 == 'function'){ 
			mainSlider(); 
		}
	if (typeof testimonialCarousel == 'function'){ 
			testimonialCarousel(); 
		}
	if (typeof slideBtn == 'function'){ 
			slideBtn(); 
		}
	if (typeof WowJsInitT == 'function'){ 
		WowJsInitT(); 
	}	
	if (typeof feturedNavActive == 'function'){ 
			feturedNavActive(); 
		}
	if (typeof whychooseList == 'function'){ 
			whychooseList(); 
		}
	if (typeof svgInline == 'function'){ 
			svgInline(); 
		}
	if (typeof bootstrapRating == 'function'){ 
			bootstrapRating(); 
		}
	if (typeof accordionExpand == 'function'){ 
			accordionExpand(); 
		}
	if (typeof priceActive == 'function'){ 
			priceActive(); 
		}	
	
});



/*============= preloder ===========*/	
$(window).load(function(){
	$("#loader-wrapper").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
	$("body").removeClass("preloder_priview");
});



})(jQuery);
