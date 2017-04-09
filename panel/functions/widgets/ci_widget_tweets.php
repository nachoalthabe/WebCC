<?php 
if( !class_exists('CI_Tweets') ):
class CI_Tweets extends WP_Widget {

 function CI_Tweets(){
    $widget_ops = array('description' => 'Display your latest tweets');
	$control_ops = array('width' => 200, 'height' => 400);
	parent::WP_Widget('ci_twitter_widget', $name='-= CI Tweets =-', $widget_ops, $control_ops);
}

// display in frontend
function widget($args, $instance) {

	extract($args);
	$ci_title = $instance['ci_title'];
	$ci_username = $instance['ci_username'];
	$ci_number   = $instance['ci_number'];
	$callback = str_replace('ci_twitter_widget-', '', $args['widget_id']);
	echo $before_widget;
	if ($ci_title) echo $before_title . $ci_title . $after_title;
	echo '<div class="' . $args['widget_id'] . ' ' . $ci_username . $ci_number . ' twitter_update_list tul"></div>';
	?>
	<script type="text/javascript">
		function twitterCallback<?php echo $callback; ?>(twitters) {
			// Extract widget id from function name
			var widget_id = arguments.callee.toString();
			widget_id = widget_id.substr('function '.length);
			widget_id = widget_id.substr(0, widget_id.indexOf('('));
			widget_id = widget_id.replace('twitterCallback', '');

			// Continue with tweets
			var statusHTML = [];
			for (var i=0; i<twitters.length; i++){
				var username = twitters[i].user.screen_name;
				var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
					return '<a href="'+url+'">'+url+'</a>';
				}).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
					return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
				});
				statusHTML.push('<li><span>'+status+'</span> <a class="twitter-time" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id+'">'+relative_time(twitters[i].created_at)+'</a></li>');
			}
			var ci_list = jQuery('.ci_twitter_widget-'+widget_id);
			ci_list.html('<ul>' + statusHTML.join('') + '</ul>');
		}
	</script>
	<script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline.json?screen_name=<?php echo $ci_username; ?>&amp;callback=twitterCallback<?php echo $callback; ?>&amp;count=<?php echo $ci_number; ?>"></script>
	<?php 
	echo $after_widget;
}

// update widget
function update($new_instance, $old_instance){
	$instance = $old_instance;
	$instance['ci_title'] = stripslashes($new_instance['ci_title']);
	$instance['ci_username'] = stripslashes($new_instance['ci_username']);
	$instance['ci_number'] = stripslashes($new_instance['ci_number']);
	return $instance;
}

// widget form
function form($instance){
	$instance = wp_parse_args( (array) $instance, array('ci_title' => '', 'ci_username'=>'', 'ci_number'=>'') );
	$ci_title = htmlspecialchars($instance['ci_title']);
	$ci_username = htmlspecialchars($instance['ci_username']);
	$ci_number = htmlspecialchars($instance['ci_number']);
	echo '<p><label>' . 'Title:' . '</label><input id="' . $this->get_field_id('ci_title') . '" name="' . $this->get_field_name('ci_title') . '" type="text" value="' . $ci_title . '" class="widefat" /></p>';
	echo '<p><label>' . 'Username:' . '</label><input id="' . $this->get_field_id('ci_username') . '" name="' . $this->get_field_name('ci_username') . '" type="text" value="' . $ci_username . '" class="widefat" /></p>';
	echo '<p><label>' . 'Number of tweets:' . '</label><input id="' . $this->get_field_id('ci_number') . '" name="' . $this->get_field_name('ci_number') . '" type="text" value="' . $ci_number . '" class="widefat" /></p>';

} // form

} // class


function CI_DisplayTweets() {  
	register_widget('CI_Tweets'); 
}
add_action('widgets_init', 'CI_DisplayTweets');


if (is_active_widget(false, false, 'ci_twitter_widget'))
{
	add_action('wp_enqueue_scripts', 'ci_twitter_widget_js_enqueue');
}
function ci_twitter_widget_js_enqueue()
{
	wp_enqueue_script('wp_twitter', get_template_directory_uri().'/js/twitter_script.js');
}
endif; // class_exists

?>