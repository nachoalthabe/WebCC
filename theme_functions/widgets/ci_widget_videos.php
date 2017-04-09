<?php 
/**
 * Recent videos Widgets.
 */
class CI_videos extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ci_videos_widget', // Base ID
			'-= CI Latest Videos =-', // Name
			array( 'description' => __( 'Display your latest videos', 'acoustic' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$videos_no 	= $instance['videos_no'];

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			$latest_videos = new WP_Query( 
				array( 
					'post_type' => 'cpt_videos',
					'posts_per_page' => $videos_no)); 					
			$i = 1; 
			while ( $latest_videos->have_posts() ) : $latest_videos->the_post();
			global $post;
			$video_url 	= get_post_meta($post->ID, 'ci_cpt_videos_url', true);
			$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);
		    
		    ?>
			<div class="media-block widget-content">
				<a href="<?php if ($video_type == 1): echo "#player" . $i . "-wrap"; else: echo $video_url; endif; ?>" data-rel="prettyPhoto">
					<span class="media-act"></span>	
					<?php the_post_thumbnail('ci_featured'); ?>
				</a>
				<div class="album-info">
					<h4 class="pair-title"><?php the_title(); ?></h4>
					<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','acoustic'); ?></a>
				</div>
				<?php if ($video_type == 1): ?>
				<div id="player<?php echo $i; ?>-wrap" class="video-player video-player-archive">
					<div id="player<?php echo $i; ?>"><?php _e('Loading the player','acoustic'); ?></div>
					<script type="text/javascript">
						setupvjw('player<?php echo $i; ?>','<?php echo $video_url; ?>');												
					</script>
				</div><!-- /player-wrapp -->																			
				<?php endif; ?>	
			</div><!-- widget-content -->		    			
			<?php
			endwhile; wp_reset_postdata();
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['videos_no'] 	= strip_tags( $new_instance['videos_no'] );
		return $instance;
	}

	function form($instance){
		$instance 	= wp_parse_args( (array) $instance, array('title'=>'', 'videos_no'=>'') );
		$title 		= htmlspecialchars($instance['title']);
		$videos_no 	= htmlspecialchars($instance['videos_no']);
		echo '<p><label>' . __('Title:','acoustic') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></p>';
		echo '<p><label>' . __('Videos Number:','acoustic') . '</label><input id="' . $this->get_field_id('videos_no') . '" name="' . $this->get_field_name('videos_no') . '" type="text" value="' . $videos_no . '" class="widefat" /></p>';
	} // form

} // class CI_videos

add_action( 'widgets_init', create_function( '', 'register_widget( "CI_videos" );' ) );
?>