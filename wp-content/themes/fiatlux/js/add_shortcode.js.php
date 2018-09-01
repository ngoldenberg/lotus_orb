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

/*-------------------------------------------------*/
/*	TinyMCE Shortcodes Button
/*-------------------------------------------------*/
jQuery(document).ready(function() {
  tinymce.create('tinymce.plugins.ml_add_shortcode_button', {
      init : function(ed, url) {
          ed.addButton('ml_add_shortcode_button', {
              title : 'Add Shortcode',
              image : '<?php echo get_template_directory_uri(); ?>/images/ml_magic_wand.png',
              onclick : function() {
								var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
								W = W - 80;
								H = H - 84;
								tb_show( 'Theme Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ml_shortcodes-form' );
              }
          });
      },
      createControl : function(n, cm) {
          return null;
      },
  });
  tinymce.PluginManager.add('ml_add_shortcode_button', tinymce.plugins.ml_add_shortcode_button);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<style type="text/css">\
			#ml_shortcodes-table {border: 1px solid #DDD;}\
			#ml_shortcodes-table th { color:#808080; font: italic 20px Georgia,"Times New Roman","Bitstream Charter",Times,serif;	text-align:right; width:46%; }\
			#ml_shortcodes-table tr:nth-child(even) {background-color:#f5f5f5;}\
		</style>\
		<div id="ml_shortcodes-form">\
		<table id="ml_shortcodes-table" class="form-table">\
			<tr>\
				<th><label for="ml_shortcodes-alert">Alert</label></th>\
				<td><input type="button" id="ml_shortcodes-alert" class="button-primary" value="Insert Shortcode" name="submit" /><br />\
			</tr>\
			<tr>\
				<th><label for="ml_shortcodes-button">Button</label></th>\
				<td><input type="button" id="ml_shortcodes-button" class="button-primary" value="Insert Shortcode" name="submit" /><br />\
			</tr>\
			<tr>\
				<th><label for="ml_shortcodes-column">Column</label></th>\
				<td><input type="button" id="ml_shortcodes-column" class="button-primary" value="Insert Shortcode" name="submit" /><br />\
			</tr>\
			<tr>\
				<th><label for="ml_shortcodes-dropcap">Dropcap</label></th>\
				<td><input type="button" id="ml_shortcodes-dropcap" class="button-primary" value="Insert Shortcode" name="submit" /><br />\
			</tr>\
			<tr>\
				<th><label for="ml_shortcodes-quote">Quote</label></th>\
				<td><input type="button" id="ml_shortcodes-quote" class="button-primary" value="Insert Shortcode" name="submit" /><br />\
			</tr>\
			<tr>\
				<th><label for="ml_shortcodes-tabs">Tabs</label></th>\
				<td><input type="button" id="ml_shortcodes-tabs" class="button-primary" value="Insert Shortcode" name="submit" /><br />\
			</tr>\
			<tr>\
				<th><label for="ml_shortcodes-toggles">Toggles</label></th>\
				<td><input type="button" id="ml_shortcodes-toggles" class="button-primary" value="Insert Shortcode" name="submit" /><br />\
			</tr>\
		</table>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		/*--- Alert ---*/
		form.find('#ml_shortcodes-alert').click(function(){

			var shortcode = '[ml_alert size=\'16\' color=\'#fff\' background_color=\'#000\'] ';
			shortcode += 'Alert Content ';
			shortcode += '[/ml_alert]';
			
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			tb_remove();
		});

		/*--- Button ---*/
		form.find('#ml_shortcodes-button').click(function(){

			var shortcode = '[ml_button url=\'http://google.com\' target=\'_blank\' color=\'#000\' background_color=\'#fff\' size=\'18\'] ';
			shortcode += 'Button Name ';
			shortcode += '[/ml_button]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			tb_remove();
		});

		/*--- Column ---*/
		form.find('#ml_shortcodes-column').click(function(){

			var shortcode = '[ml_column width=\'one_half OR one_third OR one_fourth OR one_fifth OR two_third OR two_fifth OR three_fourth OR three_fifth OR five_sixth\' last=\'true OR false\'] ';
			shortcode += 'Content Here... ';
			shortcode += '[/ml_column]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			tb_remove();
		});

		/*--- Dropcap ---*/
		form.find('#ml_shortcodes-dropcap').click(function(){

			var shortcode = '[ml_dropcap color=\'#000\' background_color=\'#fff\']A[/ml_dropcap]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			tb_remove();
		});

		/*--- Quote ---*/
		form.find('#ml_shortcodes-quote').click(function(){

			var shortcode = '[ml_quote author=\'John Doe\' alight=\'left OR right OR none\'] ';
			shortcode += 'Quote text... ';
			shortcode += '[/ml_quote]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			tb_remove();
		});

		/*--- Tabs ---*/
		form.find('#ml_shortcodes-tabs').click(function(){

			var shortcode = '[ml_tabsgroup] ';
			shortcode += '[ml_tab title=\'Tab #1\'] Tab #1 Content... [/ml_tab] ';
			shortcode += '[ml_tab title=\'Tab #2\'] Tab #2 Content... [/ml_tab] ';
			shortcode += '[ml_tab title=\'Tab #3\'] Tab #3 Content... [/ml_tab] ';
			shortcode += '[/ml_tabsgroup]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode );
			
			tb_remove();
		});

		/*--- Toggles ---*/
		form.find('#ml_shortcodes-toggles').click(function(){

			var shortcode = '[ml_togglesgroup open_first=\'false OR true\' one_visible_allowed=\'false OR true\'] ';
			shortcode += '[ml_toggle title="Toggle #1"] Toggle #1 Concent... [/ml_toggle] ';
			shortcode += '[ml_toggle title="Toggle #2"] Toggle #2 Concent... [/ml_toggle] ';
			shortcode += '[ml_toggle title="Toggle #3"] Toggle #3 Concent... [/ml_toggle] ';
			shortcode += '[/ml_togglesgroup]';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode );
			
			tb_remove();
		});

	});
})();