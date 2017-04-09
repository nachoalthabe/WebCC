<?php 
/**
 * An  Widgets.
 */
class CI_Event extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'CI_Event_widget', // Base ID
			'-= CI Event =-', // Name
			array( 'description' => __( 'Display a single event', 'acoustic' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 			= apply_filters( 'widget_title', $instance['title'] );
		$event			= intval($instance['event']);

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			$event = new WP_Query( array( 
				'post_type' => 'cpt_events',
				'p'	=> $event
			));				
			
			echo '<ul class="widget-events">';
			while ( $event->have_posts() ) : $event->the_post();
			global $post;

			$event_date 	= explode("-",get_post_meta($post->ID, 'ci_cpt_events_date', true));
			$event_location = get_post_meta($post->ID, 'ci_cpt_events_location', true);
			$event_venue 	= get_post_meta($post->ID, 'ci_cpt_events_venue', true);
				    
		    ?>
			<li class="group">
				<p class="event-flyer gradient"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ci_width'); ?></a></p>
				<p class="event-date"><span class="day"><?php echo $event_date[2]; ?></span> <span class="month"><?php echo strtoupper(themonth($event_date[1])); ?></span><span class="year"><?php echo $event_date[0]; ?></span></p>
				<div class="event-info title-pair">
					<h4 class="pair-title"><?php echo $event_location; ?></h4>
					<p class="pair-sub"><?php echo $event_venue; ?></p>
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
		$instance['event'] = intval( $new_instance['event'] );
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'event'=>'') );
		$title = htmlspecialchars($instance['title']);
		$event = intval ($instance['event']);
					
		echo '<p><label>' . __('Title:','acoustic') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></p>';
		?>
				
		<p>
			<label for="<?php echo $this->get_field_id('event'); ?>"><?php _e( 'Select event:','acoustic' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('event'); ?>" name="<?php echo $this->get_field_name('event'); ?>">				
				<?php $a = new WP_Query( apply_filters( 'widget_posts_args', array( 'post_status' => 'publish', 'post_type' => 'cpt_events' ) ) ); ?>
					<?php while ( $a->have_posts() ) : $a->the_post(); ?>
						<?php $the_id = get_the_ID(); echo $the_id; ?>
						<option value="<?php the_ID(); ?>" <?php selected( get_the_ID(), $event); ?>><?php the_title(); ?></option>
					<?php endwhile;	wp_reset_postdata(); ?>
			</select>
		</p>
				
		<?php 
	} // form

} // class CI_Event

add_action( 'widgets_init', create_function( '', 'register_widget( "CI_Event" );' ) );
?>