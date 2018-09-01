<?php 
//Make it a JavaScript file
header("Content-type: text/javascript");
if(file_exists('../../../../wp-load.php')) {
	include '../../../../wp-load.php';
}
else {
	include '../../../../../wp-load.php';
}
$prettyphoto_theme = of_get_option('ml_prettyphoto_theme','pp_default');
?>

window.log = function(){
  log.history = log.history || [];  
  log.history.push(arguments);
  arguments.callee = arguments.callee.caller;  
  if(this.console) console.log( Array.prototype.slice.call(arguments) );
};
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();)b[a]=b[a]||c})(window.console=window.console||{});


//initialize prettyPhoto
jQuery(document).ready(function(){
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		slideshow:5000,
		theme: '<?php echo $prettyphoto_theme; ?>',
		autoplay_slideshow:false
	});	
});

//jQuery Isotope
jQuery(document).ready(function(){
  jQuery('.ml_portfolio_masonry').isotope({
    // options
    itemSelector : '.ml_visible'
  });
  jQuery('.ml_galleries_masonry').isotope({
    // options
    itemSelector : '.ml_galleries_masonry article'
  });
});

//jQuery UI
jQuery(document).ready(function(){

	jQuery(".ml_ui_tabs").tabs({ fx: { opacity: 'toggle', duration: 400 } });
		
	jQuery('.ml_toggle h3').click(function() {
		/* only one is allowed to be visible */
		if(jQuery('.ml_toggle').is('.one_allowed')){
			if(jQuery(this).is('.ml_toggle_active')) {
				jQuery('.ml_toggle h3').find('span').html('+');
				jQuery('.ml_toggle h3').removeClass('ml_toggle_active').next().slideUp(500);
			}
			else {
				jQuery('.ml_toggle h3').find('span').html('+');
				jQuery('.ml_toggle h3').removeClass('ml_toggle_active').next().slideUp(500);
				jQuery(this).find('span').html('-');
				jQuery(this).toggleClass('ml_toggle_active').next().slideToggle(400);
			}
		}

		/* normal */
		else {
			jQuery(this).toggleClass('ml_toggle_active').next().slideToggle(400);
			if(jQuery(this).is('.ml_toggle_active')) {
				jQuery(this).find('span').html('-');
			}
			else {
				jQuery(this).find('span').html('+');
			}
		}
		return false;
	}).next().hide();
	
	/* if is choosed to start with the first toggle oppened */
	jQuery('.ml_toggle.toggle_first h3:first').addClass('ml_toggle_active').find('span').html('-');
	jQuery('.ml_toggle.toggle_first h3:first').next().slideToggle('400');

});


/*-------------------------------------------------*/
/*	CrossBrowser Placeholder
/*	http://www.beyondstandards.com/archives/input-placeholders/
/*-------------------------------------------------*/
function activatePlaceholders() {
	var detect = navigator.userAgent.toLowerCase(); 
	if (detect.indexOf("safari") > 0) return false;
	var inputs = document.getElementsByTagName("input");
	for (var i=0;i<inputs.length;i++) {
		if (inputs[i].getAttribute("type") == "text") {
			var placeholder = inputs[i].getAttribute("placeholder");
			if (placeholder.length > 0) {
				inputs[i].value = placeholder;
				inputs[i].onclick = function() {
					if (this.value == this.getAttribute("placeholder")) {
						this.value = "";
					}
					return false;
				}
				inputs[i].onblur = function() {
					if (this.value.length < 1) {
						this.value = this.getAttribute("placeholder");
					}
				}
			}
		}
	}
}

window.onload = function() {
	activatePlaceholders();
}


/*
CSS Browser Selector v0.4.0 (Nov 02, 2010)
Rafael Lima (http://rafael.adm.br)
http://rafael.adm.br/css_browser_selector
License: http://creativecommons.org/licenses/by/2.5/
Contributors: http://rafael.adm.br/css_browser_selector#contributors
*/
function css_browser_selector(u){var ua=u.toLowerCase(),is=function(t){return ua.indexOf(t)>-1},g='gecko',w='webkit',s='safari',o='opera',m='mobile',h=document.documentElement,b=[(!(/opera|webtv/i.test(ua))&&/msie\s(\d)/.test(ua))?('ie ie'+RegExp.jQuery1):is('firefox/2')?g+' ff2':is('firefox/3.5')?g+' ff3 ff3_5':is('firefox/3.6')?g+' ff3 ff3_6':is('firefox/3')?g+' ff3':is('gecko/')?g:is('opera')?o+(/version\/(\d+)/.test(ua)?' '+o+RegExp.jQuery1:(/opera(\s|\/)(\d+)/.test(ua)?' '+o+RegExp.jQuery2:'')):is('konqueror')?'konqueror':is('blackberry')?m+' blackberry':is('android')?m+' android':is('chrome')?w+' chrome':is('iron')?w+' iron':is('applewebkit/')?w+' '+s+(/version\/(\d+)/.test(ua)?' '+s+RegExp.jQuery1:''):is('mozilla/')?g:'',is('j2me')?m+' j2me':is('iphone')?m+' iphone':is('ipod')?m+' ipod':is('ipad')?m+' ipad':is('mac')?'mac':is('darwin')?'mac':is('webtv')?'webtv':is('win')?'win'+(is('windows nt 6.0')?' vista':''):is('freebsd')?'freebsd':(is('x11')||is('linux'))?'linux':'','js']; c = b.join(' '); h.className += ' '+c; return c;}; css_browser_selector(navigator.userAgent);
