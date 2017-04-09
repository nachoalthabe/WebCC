<?php 
/**
 * Recent Events Widgets.
 */
class CI_Artist extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'CI_Artist_widget', // Base ID
			'-= CI Artist =-', // Name
			array( 'description' => __( 'Display a single artist', 'acoustic' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 			= apply_filters( 'widget_title', $instance['title'] );
		$artist			= intval($instance['artist']);

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			$artist = new WP_Query( array( 
				'post_type' => 'cpt_artists',
				'p'	=> $artist
			));				
					
			while ( $artist->have_posts() ) : $artist->the_post();
			global $post;
			
			$artist_role = get_post_meta($post->ID, 'ci_cpt_artists_text', true);
				    
		    ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ci_rectangle'); ?></a>
			<div class="title-pair">
				<h4 class="pair-title"><?php the_title(); ?></h4>
				<p class="pair-sub"><?php echo $artist_role; ?></p>
				<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','acoustic'); ?></a>
			</div>		    			
			<?php
			endwhile; wp_reset_postdata();


		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['artist'] = intval( $new_instance['artist'] );
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'artist'=>'') );
		$title = htmlspecialchars($instance['title']);
		$artist = intval ($instance['artist']);
					
		echo '<p><label>' . __('Title:','acoustic') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></p>';
		?>
				
		<p>
			<label for="<?php echo $this->get_field_id('artist'); ?>"><?php _e( 'Select Artist:','acoustic' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('artist'); ?>" name="<?php echo $this->get_field_name('artist'); ?>">				
				<?php $a = new WP_Query( apply_filters( 'widget_posts_args', array( 'post_status' => 'publish', 'post_type' => 'cpt_artists' ) ) ); ?>
					<?php while ( $a->have_posts() ) : $a->the_post(); ?>
						<?php $the_id = get_the_ID(); echo $the_id; ?>
						<option value="<?php the_ID(); ?>" <?php selected( get_the_ID(), $artist); ?>><?php the_title(); ?></option>
					<?php endwhile;	wp_reset_postdata(); ?>
			</select>
		</p>	
		
		<?php 
	} // form

} // class CI_Artist

add_action( 'widgets_init', create_function( '', 'register_widget( "CI_Artist" );' ) );
?>