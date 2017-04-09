jQuery(window).load(function() {
    jQuery('.flexslider').flexslider({
        smoothHeight: true,
        directionNav: false,
        slideshow: false,
        after: function(slider){

	      var currentSlide = slider.slides.eq(slider.currentSlide);
	      currentSlide.siblings().each(function() {
		      var src = jQuery(this).find('iframe').attr('src');
		      jQuery(this).find('iframe').attr('src',src);
		  })

		}
	});
});

jQuery.fn.exists = function(){ return this.length>0; }

jQuery(document).ready(function($) {

    // Main navigation
	$('ul.sf-menu').superfish({
	    delay:       1000,
	    animation:   { opacity:'show' },
	    speed:       'fast',
	    dropShadows: false
	});

	// Tracklisting
	if ($('.track-listen').exists()) {
		$('.track-listen').click(function(){
			var target 		= $(this).siblings('.track-audio');
			var siblings	= $(this).parents('.track').siblings().children('.track-audio');
			siblings.slideUp('fast');
			target.slideToggle('fast');
			return false;
		});
	}

	// Responsive Menu
    // Create the dropdown base
    $("<select class='alt-nav' />").appendTo(".top-navigation").wrap("<div class='alt-nav-wrap' />");

    // Create default option "Go to..."
    $("<option />", {
       "selected": "selected",
       "value"   : "",
       "text"    : "Go to..."
    }).appendTo(".top-navigation select");

    // Populate dropdown with menu items
    $(".navigation a").each(function() {
     var selected = "";
     var el = $(this);
     var cl = $(this).parents('li').hasClass('current-menu-item');
     if (cl) {
	     $("<option />", { "value": el.attr("href"), "text" : el.text(), "selected": selected }).appendTo(".navigation select");
	 }
	 else {
		 $("<option />", { "value": el.attr("href"), "text" : el.text() }).appendTo(".navigation select");
	 }
    });

    $(".alt-nav").change(function() {
      window.location = $(this).find("option:selected").val();
    });

    // Responsive videos
    $(".content, .video-slide").fitVids();

    // Lightbox
	if ($("a[data-rel^='prettyPhoto']").exists()) {
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			show_title: false
		});
		$("a[data-rel^='prettyPhoto']").each(function() {
			$(this).attr("rel", $(this).data("rel"));
		});
	}

	$(".media-block").hover(
	  function () {
	    $(this).find('.media-act').fadeIn('fast');
	  },
	  function () {
	    $(this).find('.media-act').fadeOut('fast');
	  }
	);

	// Tour dates widget
	if ($('.listing').exists()) {
		//$('.listing').equalHeights();
	}

	// Latest media
	if ($('.latest-media-generate').exists()) {
		//$('.latest-media-generate').equalHeights();
	}

});

// Self-hosted Audio Player
function setupjw(playerID,track) {
	jwplayer(playerID).setup({
		autostart: false,
		file: track,
		flashplayer: ThemeOption.theme_url + '/jwplayer/jwplayer.flash.swf',
		width: "100%",
		height:"65",
		events: {
				onPlay: function(event)
				{
					if(this.id != idPlayer)
					{
						jwplayer(idPlayer).stop();
						idPlayer = this.id;
					}
					console.log("Play: " + playerID + " " + this.id + " " + idPlayer);
				}
        }
	});
}

// Self-hosted Video Player
function setupvjw(playerID,track) {
	jwplayer(playerID).setup({
		'autostart': 	false,
		'file': 		track,
		'width'	:		'100%',
		'flashplayer': 	ThemeOption.theme_url + '/jwplayer/jwplayer.flash.swf',
		'controlbar':	'bottom',
		'id'			: playerID
	});
}
