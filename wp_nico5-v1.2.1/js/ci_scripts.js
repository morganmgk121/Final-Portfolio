jQuery(document).ready( function($) {
	var $menu = $("#navigation");
	$menu.superfish({
		animation: {
			opacity: "show"
		},
		speed: "fast",
		delay: 250
	});

	var $container = $('.portfolio-items');
	
	$container.isotope({});
	
	// filter items when filter link is clicked
	$('.portfolio-nav li a').click(function(){
		var selector = $(this).attr('data-filter');
		$(this).parent().siblings().find('a').removeClass('selected');
		$(this).addClass("selected");
	
		$container.isotope({ 
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
	
		return false;
	});
	
	var hconfig = {
		over: zoomin,
		interval: 20,
		timeout: 0,
		sensitivity: 3,
		out: zoomout
	}
	var $item = $(".item");
	
	function zoomin() {
		$(this).find(".zoom-icon").css('display','block').animate({ opacity: 1, top: "33%" }, 'fast')
	}
	
	function zoomout() {
		$(this).find(".zoom-icon").animate({ opacity: 0, top: "25%" }, 'fast');  
	}
	
	$item.hoverIntent(hconfig);
	
	
	//slideshow 
	
	$(".slideshow").cycle({
		fx: ThemeOption.slider_effect,
		timeout: Number(ThemeOption.slider_timeout),
		sync: ThemeOption.slider_sync,
		speed: Number(ThemeOption.slider_speed),
		pager:  '.sld-nav', 
		pagerAnchorBuilder: function(idx, slide){
			return '.sld-nav li:eq(' + idx + ') a';
		},
		after: function(curr, next, opts, fwd){
				var ht = $(this).height();
				$(this).parent().animate({height: ht});
		}
		
	});
	
	//prettyPhoto
	$("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'pp_default',
		social_tools: ''
	});

});
