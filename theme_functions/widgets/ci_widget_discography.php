<?php 
/**
 * Recent discography Widgets.
 */
class CI_discography extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'ci_discography_widget', // Base ID
			'-= CI Latest Albums =-', // Name
			array( 'description' => __( 'Display your latest albums', 'acoustic' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters( 'widget_title', $instance['title'] );
		$disc_no 	= $instance['disc_no'];

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			$latest_discography = new WP_Query( 
			array( 
				'post_type' => 'cpt_discography',
				'posts_per_page' => $disc_no
			)); 					
					
			while ( $latest_discography->have_posts() ) : $latest_discography->the_post();
			global $post;
			$album_date	= explode("-", get_post_meta($post->ID, 'ci_cpt_discography_date', true));
		    ?>
			
			<div class="widget-content">
				<a href="<?php the_permalink(); ?>">	
					<?php
						$attr = array('class'=> "scale-with-grid");
						the_post_thumbnail('ci_rectangle', $attr);
					?>	
				</a>
				<div class="album-info">
					<h4 class="pair-title"><?php the_title(); ?></h4>
					<p class="pair-sub"><?php _e('Release date:','acoustic'); ?> <?php echo $album_date[2]; ?>-<?php echo themonth($album_date[1]); ?>-<?php echo $album_date[0]; ?></p>
					<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','acoustic'); ?></a>
				</div>
			</div><!-- widget-content -->
			
			<?php
			endwhile; wp_reset_postdata();
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['disc_no'] 	= strip_tags( $new_instance['disc_no'] );
		return $instance;
	}

	function form($instance){
		$instance 	= wp_parse_args( (array) $instance, array('title'=>'', 'disc_no'=>''));
		$title 		= htmlspecialchars($instance['title']);
		$disc_no 	= htmlspecialchars($instance['disc_no']);
		echo '<p><label>' . __('Title:','acoustic') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></p>';
		echo '<p><label>' . __('Albums Number:','acoustic') . '</label><input id="' . $this->get_field_id('disc_no') . '" name="' . $this->get_field_name('disc_no') . '" type="text" value="' . $disc_no . '" class="widefat" /></p>';
	} // form

} // class CI_discography

add_action( 'widgets_init', create_function( '', 'register_widget( "CI_discography" );' ) );
?>