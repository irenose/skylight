$(document).ready(function() {
	
	//$('.lightbox').lightbox();
	
	//HELP MODAL BOXES
	$('#help_content').dialog({
			autoOpen: false,
			bgiframe: true,
			buttons: {
				"Cancel": function() { $(this).dialog('close'); }}
	});
	$('.help_icon').click(function() {
		var id = $(this).attr('id');
		Show_Help(id);
		return false;
	});
	
	//PAGE/SECTION SORTING
	$("#sortable").sortable({
		update: function() {
			var order = $('#sortable').sortable('serialize');
			//alert(order);
		}
							
	}); 
	
	//CALENDAR DATE PICKER
	$('#datepicker').datepicker();
	$('#start_date').datepicker();
	$('#end_date').datepicker();
	
	//Admin PAGES section dropdown
	$('#primary_category_id').change(function() {
		var selected_category_id = $(this).attr("value");
		var page_id = $('#page_id').attr("value");
		$('#secondary_category_container').fadeOut('slow');
		if(selected_category_id != 'main' && selected_category_id != 'footer' && selected_category_id != 'global' && selected_category_id != '') {
			$.post('/ajax/dropdown', { action: "get_subcategories", selected_category_id: selected_category_id, page_id: page_id}, function(data) {
				$('#secondary_category_dropdown').children().remove();
				$('#secondary_category_dropdown').append(data);
				$('#secondary_category_container').fadeIn('slow');
			});
		} else {
			var blank_option = '<option value="">Choose a sub-category</option>';
			$('#secondary_category_dropdown').children().remove();
			$('#secondary_category_dropdown').append(blank_option);
		}
	});
	
	
	//Admin PAGES section dropdown
	$('#product_category_id').change(function() {
		var selected_category_id = $(this).attr("value");
		$('#secondary_category_container').fadeOut('slow');
		$.post('/ajax/dropdown', { action: "get_product_subcategories", selected_category_id: selected_category_id}, function(data) {
			$('#secondary_category_dropdown').children().remove();
			$('#secondary_category_dropdown').append(data);
			$('#secondary_category_container').fadeIn('slow');
		});
	});
	
	
	$('#update_page').click(function() {
		if($('#page_status_dropdown').val() == 'inactive' && $('#has_children').val() == 'yes') {
			if(confirm("This page has sub-pages associated with it. If you make it inactive, all the pages underneath it will be made inactive as well. If you do not want this to happen, please click 'Cancel'")) {
				$('#page_edit_form').submit();
			} else {
				return false;
			}
		} else {
			$('#page_edit_form').submit();
		}
	});
	
	$('#document_dropdown').change(function() {
		var file_link = $(this).attr("value");
		if(file_link != '') {
			$('#document_link').html('<p><b>Document Link:</b> <span id="file_link">' + file_link + '</span></p>');
			//highlight the text
			Select_Text('file_link');
		} else {
			$('#document_link').html('');	
		}
	});
	
	$('.delete_confirm').click(function() {
		var process_link = $(this).attr('href');
		if(confirm("Are you sure that you want to delete this item? This action cannot be undone")) {
			document.location.href = process_link;
			return false;
		} else {
			return false;
		}
	});
	
	$('body').delegate('.delete_confirm_image', 'click', function() {
		if(confirm("Are you sure that you want to delete this image? This action cannot be undone")) {
			var remove = $(this).attr('rel');
			var gallery_image_id = $(this).attr('title');
			var gallery_id = $('#gallery_id').val();
			var dealer_id = $('#dealer_id').val();
			
			$('#sortable').fadeOut('fast');
			$('#loading').fadeIn('fast');
			
			
			$.post('/ajax/delete_gallery_image', { gallery_image_id: gallery_image_id, gallery_id: gallery_id}, function(data) {
				$('#sortable').children().remove();
				$('#sortable').append(data);
				$('#sortable').fadeIn('slow');
				$('#loading').fadeOut('fast');
			});
			$('#delete_message').fadeIn('fast').animate({opacity: 1.0},3000).fadeOut('fast');
			return false;
		} else {
			return false;
		}
	});
	
	$('.reset_password').click(function() {
		var process_link = $(this).attr('href');
		if(confirm("Are you sure that you want to reset this password?")) {
			document.location.href = process_link;
			return false;
		} else {
			return false;
		}
	});
	
	//For Updating News Release - Clear file upload box if there is anything in there
	$('#delete_image_radio').click(function() {
		$('#userfile').val('');
	});
	$('#current_image_radio').click(function() {
		$('#userfile').val('');
	});
	$('#userfile').click(function() {
		$('#update_image_radio').attr('checked',true);							  
	});

	/****************** Meta Show/Hide **********************/
	$('#meta_show_hiden_btn').click(function() {
		if($('#meta_elements').is(':visible')) {
			$(this).attr({src:'/_assets/images/admin/default/buttons/meta_show_btn.gif', alt: 'Show Meta Data'}); 
			$('#meta_elements').slideUp('slow');
		} else {
			$(this).attr({src:'/_assets/images/admin/default/buttons/meta_hide_btn.gif', alt: 'Hide Meta Data'}); 
			$('#meta_elements').slideDown('slow');
		}
	});
	
	
	$('#example_sort').click(function() {
		var count = 0;
		var nav_item = new Array();
		$('input[name="nav_item[]"]').each(function() {
			nav_item[count] = $(this).val();
			count++;
		});
		$.post('/ajax/update_example_order', { nav_item: nav_item }, function(data) {
			$('#response').html(data);
		});							  
		return false;								  
	});

	$('.text_replace').click(function() {
		var $this = $(this),
			target = '#' + $this.attr('data-target'),
			source = '#' + $this.attr('data-source');
		$(target).val($(source).text());
		return false;
	});
	
});


/********** Displays Help Dialog Box *************/
function Show_Help(id) {
	$('#help_content').dialog('option','title',id);
	$('#help_content').html('You have clicked on ' + id).dialog('open');
}

/*********** Select Text *************************/
function Select_Text(element) {
	var text = document.getElementById(element);
	if($.browser.msie) {
		var range = document.body.createTextRange();
		range.moveToElementText(text);
		range.select();
	} else if($.browser.mozilla || $.browser.opera) {
		var selection = window.getSelection();
		var range = document.createRange();
		range.selectNodeContents(text);
		selection.removeAllRanges();
		selection.addRange(range);
	} else if($.browser.safari) {
		var selection = window.getSelection();
		selection.setBaseAndExtent(text,0,text,1);
	}
}