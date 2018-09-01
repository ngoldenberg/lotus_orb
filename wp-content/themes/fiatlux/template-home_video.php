<?php
/*
Template Name: Home with video
*/

get_header();

$m4v = of_get_option('ml_m4v');
$ogv = of_get_option('ml_ogv');

?>
<style type="text/css">
body {
	background: #000;
}
.ml_animated_header .ml_header_bg ,
header.ml_animated_header:hover .ml_header_bg ,
header #ml_logo .ml_logo_arrow ,
header:hover #ml_logo .ml_logo_arrow,
.sf-menu li a,
.sf-menu > li > a:hover,
.sf-menu > li.sfHover > a,
.sf-menu ul li:hover,
.sf-menu ul li.sfHover,
.sf-menu ul li:hover > a,
.sf-menu ul li.sfHover > a {
	transition: none;
		-o-transition: none;
		-moz-transition: none;
		-webkit-transition: none;
}
#supersized-loader {
	background: none;
}
</style>

<input type="hidden" id="ml-m4v" value="<?php echo $m4v ?>">
<input type="hidden" id="ml-ogv" value="<?php echo $ogv ?>">
<!-- .ml-video-bg-wrapper -->
<div class="ml-video-bg-wrapper">
	<input type="hidden" name="ml-video-bg-width" id="ml-video-bg-width" value="480">
	<input type="hidden" name="ml-video-bg-height" id="ml-video-bg-height" value="270">
	<div id="ml-video-bg" class="jp-jplayer ml-video-bg"></div>	
</div>
<!-- /.ml-video-bg-wrapper -->


<?php wp_footer(); ?>
</body>
</html>