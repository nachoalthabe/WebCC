<?php 
if( !class_exists('CI_About') ):

class CI_About extends WP_Widget {

	function CI_About(){
		$widget_ops = array('description' => __('About me widget','acoustic'));
		$control_ops = array('width' => 300, 'height' => 400);
		parent::WP_Widget('ci_about_widget', $name='-= CI About Me =-', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$ci_title = $instance['ci_title'];
		$ci_image = $instance['ci_image'];
		$ci_align = $instance['ci_align'];
		$ci_about = $instance['ci_about'];
		
		echo $before_widget;
		if ($ci_title) echo $before_title . $ci_title . $after_title;
		echo '<div class="widget_about group">';
		if ($ci_image) echo '<img src="' . $ci_image . '" class="' . $ci_align . '" alt="about me" />';
		echo $ci_about;
		echo "</div>";
		echo $after_widget;
	} // widget

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['ci_title'] = stripslashes($new_instance['ci_title']);
		$instance['ci_image'] = stripslashes($new_instance['ci_image']);
		$instance['ci_align'] = esc_attr($new_instance['ci_align']);
		$instance['ci_about'] = stripslashes($new_instance['ci_about']);
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('ci_title'=>'', 'ci_image'=>'', 'ci_about'=>'', 'ci_align'=>'alignleft') );
		$ci_title = htmlspecialchars($instance['ci_title']);
		$ci_image = htmlspecialchars($instance['ci_image']);
		$ci_align = htmlspecialchars($instance['ci_align']);
		$ci_about = htmlspecialchars($instance['ci_about']);
		echo '<p><label>' . __('Title:','acoustic') . '</label><input id="' . $this->get_field_id('ci_title') . '" name="' . $this->get_field_name('ci_title') . '" type="text" value="' . $ci_title . '" class="widefat" /></p>';
		echo '<p><label>' . __('Image:','acoustic') . '</label><input id="' . $this->get_field_id('ci_image') . '" name="' . $this->get_field_name('ci_image') . '" type="text" value="' . $ci_image . '" class="widefat" /></p>';

		?><p>
			<label><?php __('Image alignment:','acoustic'); ?></label>
			<select name="<?php echo $this->get_field_name('ci_align'); ?>" class="widefat" id="<?php echo $this->get_field_id('ci_align'); ?>">
				<option value="alignnone" <?php if($ci_align == "alignnone"){ echo "selected='selected'";} ?>>None</option>
				<option value="alignleft" <?php if($ci_align == "alignleft"){ echo "selected='selected'";} ?>>Left</option>
				<option value="alignright" <?php if($ci_align == "alignright"){ echo "selected='selected'";} ?>>Right</option>    
			</select>
		</p><?php

		echo '<p><label>' . __('About text:','acoustic') . '</label><textarea cols="30" rows="10" id="' . $this->get_field_id('ci_about') . '" name="' . $this->get_field_name('ci_about') . '" class="widefat" >'. $ci_about .'</textarea></p>';
	} // form

} // class

function CI_AboutWidget() {
	register_widget('CI_About');
}

add_action('widgets_init', 'CI_AboutWidget');

endif; //class_exists
?>