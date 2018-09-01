jQuery(document).ready(function($) {
	// datepicker field
	jQuery('.rw-date').each(function(){
		var $this = jQuery(this),
			format = $this.attr('rel');

		$this.datepicker({
			showButtonPanel: true,
			dateFormat: format
		});
	});

	// timepicker field
	jQuery('.rw-time').each(function(){
		var $this = jQuery(this),
			format = $this.attr('rel');

		$this.timepicker({
			showSecond: true,
			timeFormat: format
		});
	});

	// colorpicker field
	jQuery('.rw-color-picker').each(function(){
		var $this = jQuery(this),
			id = $this.attr('rel');

		$this.farbtastic('#' + id);
	});
	jQuery('.rw-color-select').click(function(){
		jQuery(this).siblings('.rw-color-picker').toggle();
		return false;
	});

	// add more file
	jQuery('.rw-add-file').click(function(){
		var $first = jQuery(this).parent().find('.file-input:first');
		$first.clone().insertAfter($first).show();
		return false;
	});

	// delete file
	jQuery('.rw-upload').delegate('.rw-delete-file', 'click' , function(){
		var $this = jQuery(this),
			$parent = $this.parent(),
			data = $this.attr('rel');
		$.post(ajaxurl, {action: 'rw_delete_file', data: data}, function(response){
			response == '0' ? (alert('File has been successfully deleted.'), $parent.remove()) : alert('You do NOT have permission to delete this file.');
		});
		return false;
	});

	// reorder images
	jQuery('.rw-images').each(function(){
		var $this = jQuery(this),
			order, data;
		$this.sortable({
			placeholder: 'ui-state-highlight',
			update: function (){
				order = $this.sortable('serialize');
				data = order + '|' + $this.siblings('.rw-images-data').val();

				$.post(ajaxurl, {action: 'rw_reorder_images', data: data}, function(response){
					response == '0' ? alert('Order saved') : alert("You don't have permission to reorder images.");
				});
			}
		});
	});

	// thickbox upload
	jQuery('.rw-upload-button').click(function(){
		var data = jQuery(this).attr('rel').split('|'),
			post_id = data[0],
			field_id = data[1],
			backup = window.send_to_editor;		// backup the original 'send_to_editor' function which adds images to the editor

		// change the function to make it adds images to our section of uploaded images
		window.send_to_editor = function(html) {
			jQuery('#rw-images-' + field_id).append(jQuery(html));

			tb_remove();
			window.send_to_editor = backup;
		};

		// note that we pass the field_id and post_id here
		tb_show('', 'media-upload.php?post_id=' + post_id + '&field_id=' + field_id + '&type=image&TB_iframe=true');

		return false;
	});

	// add checkboxes to select images to add
	jQuery('#media-items .new').each(function() {
		var id = jQuery(this).parent().attr('id').split('-')[2];
		jQuery(this).prepend('<input type="checkbox" class="item_selection" id="attachments[' + id + '][selected]" name="attachments[' + id + '][selected]" value="selected" /> ');
	});

	// add checkboxes to select images to add
	jQuery('.ml-submit').live('mouseenter',function() {
		jQuery('#media-items .new').each(function() {
			var id = jQuery(this).parent().children('input[value="image"]').attr('id');
			if (!id) return;
			id = id.split('-')[2];
			jQuery(this).not(':has("input")').prepend('<input type="checkbox" class="item_selection" id="attachments[' + id + '][selected]" name="attachments[' + id + '][selected]" value="selected" /> ');
		});
	});

	// add 'Insert selected images' button
	// we need to pull out the 'field_id' from the url as the media uploader is an iframe
	var field_id = get_query_var('field_id');
	jQuery('.ml-submit:first').append('<input type="hidden" name="field_id" value="' + field_id + '" /> <input type="submit" class="button" name="rw-insert" value="Insert selected images" />');

	// helper function
	// get query string value by name, http://goo.gl/r0CH5
	function get_query_var(name) {
		var match = RegExp('[?&]' + name + '=([^&#]*)').exec(location.href);

		return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
	}
});