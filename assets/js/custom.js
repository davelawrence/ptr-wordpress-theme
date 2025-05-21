(function($) {
	'use strict';
	// Navbar Menu JS
	$('.scroll-btn, .navbar .navbar-nav li a').on('click', function(e){
		var anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $(anchor.attr('href')).offset().top - 65
		}, 1000);
		e.preventDefault();
	});

	$('.navbar .navbar-nav li a').on('click', function(){
		$('.navbar-collapse').collapse('hide');
	});

	// Menu Icon JS
	$(".menu-icon").on('click', function(){
		$(".menu-icon").toggleClass("active");
		$(".header").toggleClass("active");
	})
	$(".menu-icon").on('click', function(){
		$(".sidebar").toggleClass("active")
	});	

	$(".searchbtn").on('click', function(){
		$(".formstyle").toggleClass("active");
	});	

	//Slider Carousel
	// $('.slider-carousel').owlCarousel({
	// 	margin:10,
	// 	loop:true,
	// 	autoWidth:true,
	// 	items:4
	// })


	// AOS Animation
	AOS.init();

	//reviews-carousel 
	$('.reviews-carousel').owlCarousel({
		margin:0,
		loop:false,
		items:2,
		dots:false,
		nav:false,
		autoplay:true,
		responsive : {
			0 : {
				items : 1
			},
			768 : {
				items : 2
			},
			1199 : {
				items : 2.2
			}
		}
	});

	//article-carousel 
	$('.article-carousel').owlCarousel({
		margin:30,
		loop:false,
		items:2,
		dots:false,
		nav:true,
		autoplay:true,
		navText: [
			'<img src="https://peterthompson.ca/wp-content/uploads/2025/02/arrow-left.png" />',
			'<img src="https://peterthompson.ca/wp-content/uploads/2025/02/arrow-right.png" />'
		],
		navContainer: '.article .custom-nav',
		responsive : {
			0 : {
				items : 1
			},
			768 : {
				items : 2
			},
			1199 : {
				items : 3
			}
		}
	});

})(jQuery);
