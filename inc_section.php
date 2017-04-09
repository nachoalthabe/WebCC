<?php 
$social = true; 

if(is_single()){
	if('discos' == get_post_type()){
		$artista = get_post_meta($post->ID,'artista',true);
		$title = single_post_title('',false).'<span class="normal"> | '.$artista['post_title'].'</span>';
	}else{
		$title = single_post_title('',false);
	}
}elseif(is_archive()){
	if(is_tax('posts_type')){
		$terms = get_terms('posts_type');
		$termsNames = array();
		foreach($terms as $term) {
			$termsNames[] = $term->name;
		}
		$title = get_query_var('posts_type');
	}else{
		$title = post_type_archive_title('',false);
	}
}elseif(is_home()){
	$title = "Abstracto, infinito y Recurrente.";
}elseif(is_page()){
	$title = get_the_title();
}else{
	$taxonomy = 'posts_type';
	$queried_term = get_query_var($taxonomy);
	$terms = get_terms($taxonomy, 'slug='.$queried_term);
	$title = "";
	if ($terms) {
		foreach($terms as $term) {
			$title .= $term->name;
		}
	}
}
//var_dump($_SERVER);
?>
<div class="row bc">
	<div class="twelve columns breadcrumb">
		<h3 class="section-title"><?php echo $title; ?></h3>
		<div id="sharing">
		  <div id="shareme" data-url="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" data-text="<?php echo $title; ?>"></div>
		</div>
		<script>
		var shareBtn = function($){
		$('#shareme').sharrre({
		  share: {
		    twitter: true,
		    facebook: true,
		    googlePlus: true
		  },
		  template: '<div class="box"><div class="left">compartir</div><div class="middle"><a href="#" class="facebook">f</a><a href="#" class="twitter">t</a><a href="#" class="googleplus">+1</a></div></div>',
		  enableHover: false,
		  enableTracking: true,
		  render: function(api, options){
		  $(api.element).on('click', '.twitter', function() {
		    api.openPopup('twitter');
		  });
		  $(api.element).on('click', '.facebook', function() {
		    api.openPopup('facebook');
		  });
		  $(api.element).on('click', '.googleplus', function() {
		    api.openPopup('googlePlus');
		  });
		}
		});
		}(jQuery);
		</script>
		<?php if(false): ?>
		<div id="sharing">
			<a class="btn">compartir</a>
			<div>
				<span class='st_googleplus_large' displayText='Google +'></span>
				<span class='st_facebook_large' displayText='Facebook'></span>
				<span class='st_twitter_large' displayText='Tweet'></span>
				<span class='st_linkedin_large' displayText='LinkedIn'></span>
				<span class='st_pinterest_large' displayText='Pinterest'></span>
				<span class='st_email_large' displayText='Email'></span>
			</div>
		</div>
		<script type="text/javascript">
			var sharingBtn = function($){
				$("#sharing > div").hide();
				$("#sharing .btn").on('click',function(ev){
					$("#sharing > div").toggle();
				})
			}(jQuery);
		</script>
		<?php endif; ?>
	</div><!-- /twelve columns -->
</div><!-- /bc -->