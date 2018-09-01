<?php 
//Make it a JavaScript file
header("Content-type: text/javascript");
if(file_exists('../../../../wp-load.php')) {
	include '../../../../wp-load.php';
}
else {
	include '../../../../../wp-load.php';
}
?>


/*--- Video Background ---*/

jQuery(document).ready(function($) {

	var video_bg_width  = parseInt($('#ml-video-bg-width').val());
	var video_bg_height = parseInt($('#ml-video-bg-height').val());

	function ml_fit_video_bg() {

		var browser_width  = $(window).outerWidth();
		var browser_height = window.innerHeight ? window.innerHeight : $(window).outerHeight();

		var video_bg_ratio  = video_bg_width / video_bg_height;
		var browser_ratio = browser_width / browser_height;

		var ratio = (video_bg_ratio < browser_ratio)
			? video_bg_width / browser_width
			: video_bg_height / browser_height;

		var new_video_bg_width  = (video_bg_width / ratio);
		var new_video_bg_height = (video_bg_height / ratio);

		$('.ml-video-bg-wrapper').css({
			'height' : new_video_bg_height,
			'left'   : (browser_width - new_video_bg_width) / 2,
			'top'    : (browser_height - new_video_bg_height) / 2,
			'width'  : new_video_bg_width
		});

	}

	ml_fit_video_bg();

	$(window).resize(function() {
		ml_fit_video_bg();
	});


	var file_m4v        = $('#ml-m4v').val();
	var file_ogv        = $('#ml-ogv').val();

	console.log(file_m4v);
	console.log(file_ogv);

	function ml_fire_video_bg() {
		$("#ml-video-bg").jPlayer({
			loop: true,
			ready: function () {
				$(this).jPlayer("setMedia", {
					m4v: file_m4v,
					ogv: file_ogv
				}).jPlayer("play");
			},
			swfPath: "<?php echo get_template_directory_uri() ?>/js/libs",
			supplied: "m4v, ogv"
		});
	}

	ml_fire_video_bg();

});


// hover fade
jQuery(document).ready(function($) {
	//prevent to load the fade effect on IE8 (poor quality)
	//add the class "fade-hover" to any element you want to add the Fade effect
	if (!($.browser.msie  && parseInt($.browser.version) < 9)) {
		$(".ml_fade-hover, .featured-image.ml_icon_picture img, .featured-image.ml_icon_video img, .featured-image.ml_icon_html img, .ml_social a").hover(
			function() {
				$(this).fadeTo(300, 0.5, 'easeOutQuad');
			},
			function() {
				$(this).fadeTo(400, 1, 'easeInQuad');
			}
		);
	}
	$(".ml_grayscale_thumb img").hover(
		function() {
			$(this).fadeTo(400, 0, 'easeOutQuad');
		},
		function() {
			$(this).fadeTo(500, 1, 'easeInQuad');
		}
	);	
});


/*--- Portfolio Filter ---*/
jQuery(document).ready(function($) {
	//start when the link is clicked
	$(".ul-portfolio-categories a").click(function() {
		$(this).css("outline","none");
		$(".ul-portfolio-categories .selected").removeClass("selected");
		$(this).parent().addClass("selected");
		
		//get the link value
		var preFilterVal = $(this).text();
		//set the path to the AJAX sanitizer
		var sanitizeUrl = '<?php echo get_template_directory_uri().'/includes/sanitize.php'; ?>';		
		//get the sanitized link via AJAX (with sanitize_title() wordpress function) and starts the magic
		$.get(sanitizeUrl, {slug: preFilterVal}, function (data) {
			var filterVal = data;
			//no conflict
			var filterVal = '.skill_' + filterVal;
			
			//when click All, show all
			if(filterVal == ".skill_<?php echo sanitize_title(__('All', 'meydjer')) ?>") {
				$('.ml_portfolio_masonry').isotope({ filter: '*' });
			} 
			
			//show portfolio items by skill
			else {
				$('.ml_portfolio_masonry').isotope({ filter: filterVal });
			}
		});
		return false;
	});
});


/*-------------------------------------------------*/
/*	Custom Javascripts
/*-------------------------------------------------*/
<?php echo of_get_option('ml_custom_js'); ?>