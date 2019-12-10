/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {

	$("#primary-menu > li > a").each(function(){
		var cloud = $("#cloud").html();
		$(this).append(cloud);
	});
	
	/* Slideshow */
	var swiper = new Swiper('#slideshow', {
		slidesPerView: 1,
		spaceBetween: 0,
		effect: 'slide', /* "fade", "cube", "coverflow" or "flip" */
		loop: true,
		autoplay: {
			delay: 8000,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
    });
	
	/* Colorbox */
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	/* Equal Heights Divs */
	//$('.js-blocks').matchHeight();
	var currentScreenW = window.innerWidth;

	$.fn.equalHeights = function(){
		var max_height = 0;
		$(this).each(function(){
			max_height = Math.max($(this).height(), max_height);
		});
		$(this).each(function(){
			$(this).height(max_height);
		});
	};

	function do_js_blocks() {
		if(currentScreenW >= 960) {
			$('.js-blocks').equalHeights();
		} else {
			$('.js-blocks').removeAttr("style");
		}
	}

	do_js_blocks();
	window.onresize = function(event) {
		var currentScreenW = window.innerWidth;
		if(currentScreenW >= 960) {
			$('.js-blocks').equalHeights();
		} else {
			$('.js-blocks').removeAttr("style");
		}
	};

	/* WOW Animation */
	new WOW().init();


	$(document).on("click","#toggleMenu",function(){
		$(this).toggleClass('open');
		$('.main-navigation').toggleClass('open');
		$('body').toggleClass('menu-open');
	});

	$(document).on("click","#oVerlay",function(){
		$("#toggleMenu").trigger("click");
	});

	/* Facebook Feeds */
	if( $("#cff .cff-page-name").length ) {
		var fbLink = $("#cff .cff-page-name").first().find("a").attr("href");
		$("#fbLink").attr("href",fbLink).attr("target","_blank");
	}

	/* Remove Blan <p> */
	$("#calendarEvents p").each(function(){
		var $this = $(this);
		if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
		$this.remove();
	});

	$("#calendarEvents .simcal-day").each(function(){
		var target = $(this);
		var border = "<div class='divider'></div>";
		$(border).insertAfter( target );
	});


	/* === AJAX MORE ITEMS === */
	   /* NEWS */

	// $(document).on("click","a.seemore",function(e){
	// 	e.preventDefault();
	// 	var target = $(this);
	// 	var currentpage = $(this).attr("data-currentpage");
	// 	var total = $(this).attr("data-count");
	// 	var ptype  = $(this).attr('data-type');
	// 	var container  = $(this).attr('data-container');
	// 	var orderby  = $(this).attr('data-orderby');
	// 	var perpage  = $(this).attr('data-perpage');
	// 	var orderbyArr  = $(this).attr('data-orderby');
	// 	var buttonDiv = $(this).parents(".buttondiv");
	// 	var spinner = buttonDiv.find(".spinner");
	// 	var noMorePost = '<span class="imorebtn">No more items to load</span>';

	// 	$.ajax({
	// 		url : frontajax.ajaxurl,
	// 		type : 'post',
	// 		dataType : "json",
	// 		data : {
	// 			action : 'get_the_next_entries',
	// 			pg : currentpage,
	// 			posttype : ptype,
	// 			perpage : perpage,
	// 			orderby : orderbyArr
	// 		},
	// 		beforeSend:function(){
	// 			spinner.addClass("show");
	// 		},
	// 		success: function( obj ) {
	// 			var result = obj.content;
	// 			if( result ) {
	// 				var nextPage = obj.next_page;
	// 				var lastBatch = obj.last_batch;
	// 				$(container).html(result);
	// 				if(lastBatch) {
	// 					buttonDiv.append(noMorePost);
	// 					target.remove();
	// 				}
	// 			}
	// 			spinner.removeClass("show");
	// 		}
	// 	});

	// });


});// END #####################################    END