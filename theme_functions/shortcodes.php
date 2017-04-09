<?php
function shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

function tracklisting($params, $content = null) {
	return
		'<ul class="widget-tracks">' . 
			do_shortcode($content) . 
		'</ul>';
	}
add_shortcode('tracklisting','tracklisting');

function track($params, $content = null) {
	extract( shortcode_atts( array(
      'track_no' => '1',
      'title'	 => 'Track title',
      'subtitle' => 'Track subtitle',
      'type'	 => 'soundcloud',
      'buy_url'	 => '',
      'download_url' => ''
    ), $params ) );

    $p = "";
    $b = "";
    $d = "";
    $s = "";
    
    if ($download_url != "") {
	    $d = '<a href="'. $download_url .'" class="btn download-track">' . __('Download track','acoustic') . '</a>';
    }

    if ($buy_url != "") {
	    $b = '<a href="'. $buy_url .'" class="btn buy-track">' . __('Buy track','acoustic') . '</a>';
    }
    
    if ('soundcloud' == strtolower($type)) {
	    $p =	'<div class="btns">' . $d . $b . '</div><a href="#track' . $track_no . '" class="track-listen sc">' . __('Listen','acoustic') . '</a>'.
				'<div id="track'. $track_no . '" class="track-audio">' .
					do_shortcode($content) .
				'</div>';
    }
    else {
	    $p =	'<div class="btns">' . $d . $b . '</div><a href="#track' . $track_no . '" class="track-listen">' . __('Listen','acoustic') . '</a>' .
				'<div id="track' . $track_no . '" class="track-audio jw">' .
				'<div id="player' . $track_no . '">' . __('Loading Player','acoustic') . '</div>' .
				'<script type="text/javascript">' .
					'var idPlayer = player' . $track_no . '; ' .
					'setupjw("player' . $track_no . '","' . do_shortcode($content) . '");' .
				'</script>' .															
				'</div>';
    }
    
    if ($subtitle != "")
    	$s = '<p class="pair-sub">' . $subtitle . '</p>';
    
	return
		'<li class="gradient group">' .  
			'<span class="track-no">' . $track_no . '</span>' .
			'<div class="track-info title-pair">' .
				'<h4 class="pair-title">' . $title . '</h4>' .
				$s .
			'</div>' . $p .
		'</li>';
	}
add_shortcode('track','track');
?>