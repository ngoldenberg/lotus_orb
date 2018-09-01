/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {
	
	// Fade out the save message
	jQuery('.fade').delay(1000).fadeOut(1000);
	
	// Color Picker
	jQuery('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = jQuery(Othis).next('input').attr('value');
		jQuery(this).ColorPicker({
		color: initialColor,
		onShow: function (colpkr) {
		jQuery(colpkr).fadeIn(500);
		return false;
		},
		onHide: function (colpkr) {
		jQuery(colpkr).fadeOut(500);
		return false;
		},
		onChange: function (hsb, hex, rgb) {
		jQuery(Othis).children('div').css('backgroundColor', '#' + hex);
		jQuery(Othis).next('input').attr('value','#' + hex);
	}
	});
	}); //end color picker
	
	// Switches option sections
	jQuery('.group').hide();
	jQuery('.group:first').fadeIn();
	jQuery('.group .collapsed').each(function(){
		jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if (jQuery(this).hasClass('last')) {
					jQuery(this).removeClass('hidden');
						return false;
					}
				jQuery(this).filter('.hidden').removeClass('hidden');
			});
	});
           					
	jQuery('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		if (jQuery(this).attr('checked')) {
			jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			jQuery(this).parent().parent().parent().nextAll().each( 
			function(){
				if (jQuery(this).filter('.last').length) {
					jQuery(this).addClass('hidden');
					return false;		
					}
				jQuery(this).addClass('hidden');
			});
           					
		}
	}
	
	// Image Options
	jQuery('.of-radio-img-img').click(function(){
		jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		jQuery(this).addClass('of-radio-img-selected');		
	});
		
	jQuery('.of-radio-img-label').hide();
	jQuery('.of-radio-img-img').show();
	jQuery('.of-radio-img-radio').hide();
	
	jQuery('#of-nav li:first').addClass('current');
	jQuery('#of-nav li a').click(function(evt) {
		jQuery('#of-nav li').removeClass('current');
		jQuery(this).parent().addClass('current');
		var clicked_group = jQuery(this).attr('href');
		jQuery('.group').hide();
		jQuery(clicked_group).fadeIn();
		evt.preventDefault();
	}); 	 		
});	