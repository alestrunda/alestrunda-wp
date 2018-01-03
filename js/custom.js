// JavaScript Document

"use strict";

(function($){
	$(document).ready(function(e) {
		//fixed header
		var page_header = $('#page-header');
		updateHeaderSize();
		$(window).on('scroll', _.throttle(updateHeaderSize, 200));

		function updateHeaderSize() {
			if($(window).scrollTop() > 200 && false === page_header.hasClass('page-header--small'))
				page_header.addClass('page-header--small');
			else if($(window).scrollTop() < 200)
				page_header.removeClass('page-header--small');
		}
		
		//page loader hide trigger
		$('.loader-page__hide').on('click', function(e) {
			$('#loader-page').fadeOut('slow');
		});
		
		//one-page-nav activation
		var $one_page_nav_list = $('#main-menu-list');
		var $main_nav = $('#main-page-nav');
		$one_page_nav_list.onePageNav({
			currentClass: 'active'
		});
		$one_page_nav_list.find('a').on('click', function() {
			var mql = window.matchMedia("screen and (max-width: 1024px)");
			if(mql.matches) {
				$main_nav.slideUp();
			}
		});

		//menu button
		$('#main-nav-btn').on('click', function(e) {
			e.preventDefault();
			$main_nav.slideToggle();
		});
		
		//scroll to anchor
		$('.scroll-to').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 60
			}, 800);
		});
				
		//on-scroll animations
		var delay_default = 200;
		var max_delay_mobile = 300;
		var mobile_break_px = 767;
		$('.onscroll-animate').each(function(index, element) {
			$(this).one('inview', function (event, visible) {
				var el = $(this);
				var anim = (el.data("animation") !== undefined) ? el.data("animation") : "anim-fade-in-up";
				var delay = (el.data("delay") !== undefined ) ? el.data("delay") : delay_default;

				var mql = window.matchMedia("screen and (max-width: " + mobile_break_px + "px)");
				if(mql.matches && delay > max_delay_mobile) {
					delay = max_delay_mobile;
				}
					
				if(visible === true) {
					setTimeout(function() {
						el.addClass(anim);
					}, delay);
				}
				else {
					el.removeClass(anim);
					el.css('opacity', 0);
				}
			});
		});
		
		//top slider
		var $top_text_slider = $("#slider-top");
		$top_text_slider.slick({
			autoplay: true,
			autoplaySpeed: 3500,
			speed: 1000,
			nextArrow: '<div class="slick-next slider-arrow-super"><span class="slider-arrow-super__dot slider-arrow-super__dot--1"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--2"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--3"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--4"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--5"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--6"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--7"></span></div>',
			prevArrow: '<div class="slick-prev slider-arrow-super"><span class="slider-arrow-super__dot slider-arrow-super__dot--1"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--2"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--3"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--4"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--5"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--6"></span><span class="slider-arrow-super__dot slider-arrow-super__dot--7"></span></div>',
			fade: true,
			draggable: false,
			pauseOnHover: false
		});
		$top_text_slider.slick('slickPause');
		$(window).on('load', function() {
			$top_text_slider.slick('slickPlay');
		});
		
		//bottom logos slider
		$('#slider-logos').slick({
			autoplay: true,
			autoplaySpeed: 3000,			
			arrows: false,
			dots: true,
			slidesToShow: 5,
			slidesToScroll: 5,
			speed: 4000,
			infinite: true,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						speed: 3500,
						slidesToShow: 4,
						slidesToScroll: 4
					}
				},
				{
					breakpoint: 600,
					settings: {
						speed: 3000,
						slidesToShow: 3,
						slidesToScroll: 3
					}
				},
				{
					breakpoint: 480,
					settings: {
						speed: 2000,
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}
			]
		});
		
		//testimonials slider
		$('#testimonials-slider').slick({
			arrows: false,
			dots: true,
			speed: 1000,
			adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 800,
					settings: {
						speed: 600,
					}
				},
				{
					breakpoint: 480,
					settings: {
						speed: 400,
					}
				}
			]
		});
		
		var $btn_multiple_filter = $('#btn-multiple-filter');
		//show all filters for works
		$('#show-all-works-filters').on('click', function(e) {
			e.preventDefault();
			$(this).hide();
			$btn_multiple_filter.show();
			$('#works-filters .list-filters__item--secondary').removeClass('list-filters__item--secondary');
		});

		$btn_multiple_filter.on('click', function() {
			$(this).toggleClass('toggled');
		});
		
		//popup windows
		var $screen_cover = $('#cover-screen');
		var $popup_windows = $('.popup-window');
		var popup_screen_pos = 3;	//center of the popup in 1/3 height of the screen
		var popup_top_offset = 15;
		if($('.popup-window').length > 0) {
			$('.popup-window-trigger').on('click', function(e) {
				e.preventDefault();
				var $popup;
				if($(this).attr('href'))
					$popup = $($(this).attr('href'));
				else if($(this).data('popup'))
					$popup = $($(this).data('popup'));
				else
					return;
				openPopup($popup);
			});
			
			$screen_cover.on('click', function(e) {
				closePopups();
			});
			
			$('.popup-window-close').on('click', function(e) {
				closePopups();
			});
			
			$(window).on('resize', function(e) {
				$popup_windows.each(function(index, item) {
					if($(this).hasClass('active'))
						return;
					$(this).css('top', 0);
				});
			});
		}
		
		function openPopup($popup_window) {
			var popup_pos_y;
			if($(window).height()/popup_screen_pos < $popup_window.height()/2 + popup_top_offset)
				popup_pos_y = $(window).scrollTop() + popup_top_offset;
			else
				popup_pos_y = $(window).scrollTop() + $(window).height()/popup_screen_pos - $popup_window.height()/2;
			$popup_window.css('top', popup_pos_y);
			$popup_window.addClass('active');
			$screen_cover.addClass('active');
		}
		
		function closePopups() {
			$popup_windows.removeClass('active');
			$screen_cover.removeClass('active');
		}
		
		//bootstrap tooltips
		//$('[data-toggle="tooltip"]').tooltip();
	});
	
	$(window).load(function(e) {
		//portfolio works filter
		var $btn_multiple_filter = $('#btn-multiple-filter');
		var $isotope_filter_root = $('#works-filters');
		var isotopeEl = $('#works').isotope({
			itemSelector: '.work-item',
			layoutMode: 'fitRows'
		});
		$('.isotope-filter').on('click', function(e) {
			e.preventDefault();
			var parent_li_el = $(this).parent('li');
			if($btn_multiple_filter.hasClass('toggled')) {
				if(parent_li_el.hasClass('list-filters__item--all')) {
					$isotope_filter_root.children('.active').removeClass('active');
					parent_li_el.addClass('active');
				}
				else {
					parent_li_el.toggleClass('active');
					if($isotope_filter_root.children('.active').length === 0)
						$isotope_filter_root.children('.list-filters__item--all').addClass('active');
					else
						$isotope_filter_root.children('.list-filters__item--all').removeClass('active');
				}
			} else {
				$isotope_filter_root.children('.active').removeClass('active');
				parent_li_el.addClass('active');
			}
			var filterStr = "";
			$isotope_filter_root.children('.list-filters__item').each(function() {
				if(!$(this).hasClass('active'))
					return;
				filterStr += $(this).children('.isotope-filter').data('filter');
			});
			isotopeEl.isotope({ filter: filterStr });
			$(window).trigger('resize');
		});
		
		
		//activate parralax only on no-touch devices
		if (!Modernizr.touch) {
			//top slide paralax
			skrollr.init({
				smoothScrollingDuration: 10,
				forceHeight: false
			});
			
			//paralax
			$.stellar({
				horizontalScrolling: false,
				verticalOffset: -60,
				responsive: true,
			});
		}
		
		$('#loader-page').fadeOut('slow');
	});
})(jQuery);
