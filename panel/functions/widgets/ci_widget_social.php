<?php 
if( !class_exists('CI_Social') ):
class CI_Social extends WP_Widget {

	function CI_Social(){
		$widget_ops = array('description' => __('Social Icons widget placeholder','acoustic'));
		$control_ops = array('width' => 300, 'height' => 400);
		parent::WP_Widget('ci_social_widget', $name='-= CI Social =-', $widget_ops, $control_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = $instance['title'];
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;

		if(ci_setting('social_rss_show')=='enabled')
		{
			if (ci_setting('social_new_window')) {
				echo '<a target="_blank" href="'.ci_rss_feed().'" class="icn rss" title="'.ci_setting('social_rss_text').'">'.ci_setting('social_rss_text').'</a>';
			}
			else {
				echo '<a href="'.ci_rss_feed().'" class="icn rss" title="'.ci_setting('social_rss_text').'">'.ci_setting('social_rss_text').'</a>';
			}
		}

		$services = ci_social_services();
		foreach($services as $key=>$value)
		{
			$enabled = ci_setting('social_'.$key.'_show');
			$url = ci_setting('social_'.$key.'_url');
			$text = ci_setting('social_'.$key.'_text');
			
			if($enabled=='enabled' and !empty($url))
			{
				if (ci_setting('social_new_window')) {
					echo '<a target="_blank" href="'.$url.'" class="icn '.$key.'" title="'.$text.'">'.$text.'</a>';
				}
				else {
					echo '<a href="'.$url.'" class="icn '.$key.'" title="'.$text.'">'.$text.'</a>';
				}
			}
		}

		echo $after_widget;
	} // widget

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		return $instance;
	} // save
	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('title'=>'') );
		$title = htmlspecialchars($instance['title']);
		echo "<p>".__('This widget is a placeholder for Social Media icons. You may configure those icons from the CSSIgniter\'s panel, under the <strong>Social Options</strong> tab.', 'acoustic')."</p>";
		echo '<p><label>' . __('Title:', 'acoustic') . '</label><input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" class="widefat" /></p>';
	} // form

} // class

function CI_SocialWidget() {
	register_widget('CI_Social');
}

add_action('widgets_init', 'CI_SocialWidget');

endif; //class_exists
?>