jQuery(document).ready(function($) {
 
	// delay equivalent for jQuery 1.3.2
	$.fn.hold = function(time){
		var o = $(this);
		o.queue(function(){
			setTimeout(function() {
				o.dequeue();
			}, time);
		});
		return this;
	};

	 //tabs
	$('.tab').hide();
	$('.one').show();

	$('#ci_sidebar ul li a').click( function() {
		$(this).addClass('active').parents('li').siblings().find('a').removeClass('active');
		var tab = $(this).attr('rel');
		$('#ci_options div#'+tab).show().siblings().hide();
		return false;
	});
 
	//form submission 
	$("#ci_panel .success").hide();
	$("#ci_panel .resetbox").hold(2000).fadeOut(500);
	
	$('input.save').click(function() {
		var theoptions = $('#theform').serialize();
		$.ajax({
			type: "POST",
			url: "options.php",
			data: theoptions,
			beforeSend: function() { $("#ci_panel .success").html('<p class="modal-working">Working...</p>').fadeIn(500); },
			success: function(response){ $("#ci_panel .success").html('<p class="modal-saved">Settings saved!</p>').hold(1000).fadeOut(500); }
		});
		return false;  
	});	 


	$('#bg_color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	}).bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});

	var isEnabled = $('.toggle-button').attr('checked');
	var pane = $('.toggle-pane');
	if (isEnabled) { pane.hide(); } else { pane.show(); }
	
	$('.toggle-button').click(function(){
		var pane = $(this).parents('div.tab').children('.toggle-pane');
		if ($(this).attr('checked')=="checked") {
			pane.fadeOut();
		}
		else {
			pane.fadeIn();
		}
	});
	//$('.toggle-button').click();


	$('input#ci_create_sample_content').click(function() {
		var button = $(this);
		var answer = confirm('Are you sure? Sample content will be created!');		
		if(answer)
		{
			var data = { action: 'ci_create_sample_content'	};
			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: data,
				beforeSend: function() { $("#ci_panel .success").html('<p class="modal-working">Working...</p>').fadeIn(500); }, 
				success: function(response){ 
					$("#ci_panel .success").html('<p class="modal-saved">Sample content created!</p>').hold(2000).fadeOut(500); 
					button.fadeOut();
				}
			});
		}
		return false; 
	});	 
	$('input#ci_delete_sample_content').click(function() {
		var button = $(this);
		var answer = confirm('Are you sure? All sample content will be lost!');		
		if(answer)
		{
			var data = { action: 'ci_delete_sample_content'	};
			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: data,
				beforeSend: function() { $("#ci_panel .success").html('<p class="modal-working">Working...</p>').fadeIn(500); }, 
				success: function(response){ 
					$("#ci_panel .success").html('<p class="modal-saved">Sample content deleted!</p>').hold(2000).fadeOut(500); 
					button.fadeOut();
				}
			});
		}
		return false;  
	});

	//Native upload window
	var target,set_interval,fileurl = "";
	window.ci_opener = { trigger : '' };

	$('.ci-upload').click(function() {
		
		var trigger = $(this).attr('id');
		trigger == "ci-upload-background" ? window.ci_opener = { trigger : 'ci-upload-background' } : window.ci_opener = { trigger : '' };  
		
		target = $(this).siblings('.uploaded');
		set_interval = setInterval( function() {
			jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use this image');
		}, 2000 );

		postID = 0;
		tb_show('', 'media-upload.php?post_id='+postID+'&amp;type=image&amp;TB_iframe=true');
		return false;
	});


	window.original_send_to_editor = window.send_to_editor;

	window.send_to_editor = function(html){
		if (target) {
			clearInterval(set_interval);
			fileurl = $('img',html).attr('src');
			
			if (window.ci_opener.trigger == 'ci-upload-background') {
		
				var imgstr = $('<div>').append($('img',html).clone()).html();
				var regex = /(?:class=".*wp-image-)(\d*)(?:")/;
				var result = imgstr.match(regex);
				if(result != null)
					$('#default_header_bg_hidden').val(result[1]);
			}

			target.val(fileurl);
			tb_remove();
		} else {
			window.original_send_to_editor(html);
		}
	};

});