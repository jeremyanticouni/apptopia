<?php

// The shortcode
function apptopia_shortcode($apptopia_atts) {
	$apptopia_atts = shortcode_atts( array( 
		"url" => __('https://integrations.apptopia.com/amazing/api/login', 'apptopia'),
		"client_id" => __('', 'apptopia'),
		"client_secret" => __('', 'apptopia')
	), $apptopia_atts);

	// Set auth variables 
	$auth_params = array(
		'url' => esc_attr($apptopia_atts['url']),
		'client_id' => esc_attr($apptopia_atts['client_id']),
		'client_secret' => esc_attr($apptopia_atts['client_secret'])
	);

	$auth = false;
	$error = false;
	$sent = false;
	$info = '';

	if (empty($auth_params['client_id']) && empty($auth_params['client_secret'])) {
		$info = "Error: The <code>client_id</code> and <code>client_secret</code> shortcode params are required.";
	} else if (empty($auth_params['client_id'])) {
		$info = "Error: The <code>client_id</code> shortcode param is required.";
	} else if (empty($auth_params['client_secret'])) {
		$info = "Error: The <code>client_secret</code> shortcode param is required.";
	}

	// Display error if token failed
	$token = getToken($auth_params);
	if(substr($token, 0, 5) === "Error") {
		$info = '<p class="apptopia-info">'.$token.'</p>';
	}

	$content = '
		<!doctype html>
		<html>
		    <head>
		      <meta charset="utf-8">
		      <title>Apptopia - New Releases</title>
		    </head>
		    <body>
		      <section>
		        <h1>Apptopia - New Releases</h1>
		        <div id="nr-container">
		          Loading ...
		        </div>
		      </section>
		      <script>';
		      	if(!empty($token)) {
			        $content .= 'nr = require("js/components/new_releases")
			        nr.init("'.$token.'", "#nr-container")';
			    } else {
			    	$content .= 'console.error("Apptopia authentication failed; invalid or missing token.")';
			    }
		      $content .= '</script>
		    </body>
		</html>';

	return $info.$content;
} 
add_shortcode('apptopia', 'apptopia_shortcode');

?>