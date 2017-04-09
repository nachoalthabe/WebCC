<?php 
/**
 * Recent Events Widgets.
 */
class CI_Artists extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ci_artists_widget', // Base ID
			'-= CI Artists =-', // Name
			array( 'description' => __( 'Displays a list of artists', 'acoustic' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 			= apply_filters( 'widget_title', $instance['title'] );
		$artists_no 	= $instance['artists_no'];

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			$artists = new WP_Query( array( 
				'post_type' => 'cpt_artists',
				'orderby'	=> 'rand',
				'posts_per_page' => $artists_no
			));				
					
			echo '<ul class="widget-artists">';
			while ( $artists->have_posts() ) : $artists->the_post();
			global $post;
			
			$artist_role = get_post_meta($post->ID, 'ci_cpt_artists_text', true);
				    
		    ?>
			<li class="gradient group">						
				<p class="artist-photo"><?php the_post_thumbnail('ci_rectangle'); ?></p>
				<div class="artist-info title-pair">
					<h4 class="pair-title"><?php the_title(); ?></h4>
					<p class="pair-sub"><?php echo $artist_role; ?></p>
					<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','acoustic'); ?></a>
				</div>
			</li>		    			
			<?php
			endwhile; wp_reset_postdata();
			echo '</ul>';

		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['artists_no']	= strip_tags( $new_instance['artists_no'] );
		$instance['artists_rand'] = strip_tags( $new_instance['artists_rand'] );
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'artists_no'=>'', 'artists_rand' => '', 'artists_category' => false) );
		$title = htmlspecialchars($instance['title']);
		$artists_no = htmlspecialchars($instance['artists_no']);
		$artists_rand = htmlspecialchars($instance['artists_rand']);
		$artists_category = intval ($instance['artists_category']);
				
		echo '<p><label>' . __('Title:','acoustic') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></p>';
		echo '<p><label>' . __('Artists number:','acoustic') . '</label><input id="' . $this->get_field_id('artists_no') . '" name="' . $this->get_field_name('artists_no') . '" type="text" value="' . $artists_no . '" class="widefat" /></p>'; ?>
		<p>
			<label><?php _e('Random order:','acoustic'); ?></label>
			<input id="<?php echo $this->get_field_id('artists_rand'); ?>" name="<?php echo $this->get_field_name('artists_rand'); ?>" type="checkbox" class="checkbox" <?php checked($instance['artists_rand'], 'on'); ?> />
		</p>
		<?php 
	} // form

} // class CI_Artists

add_action( 'widgets_init', create_function( '', 'register_widget( "CI_Artists" );' ) );
?>