<?php
	// Loads child theme textdomain
	load_child_theme_textdomain( CURRENT_THEME, CHILD_DIR . '/languages' );

	add_filter( 'cherry_stickmenu_selector', 'cherry_change_selector' );
	function cherry_change_selector($selector) {
		$selector = 'header .nav-wrap';
		return $selector;
	}
	
	add_filter( 'cherry_slider_params', 'child_slider_params' );
	function child_slider_params( $params ) {
		$params['minHeight'] = '"50px"';
		$params['height'] = '"47.45%"';
	return $params;
	}

	require_once(CHILD_DIR . '/parallax-slider/php/parallax-slider-video-meta.php');

	// Loads custom scripts.
	require_once( 'custom-js.php' );
	require_once( 'shortcodes/service-box.php' );
	require_once( 'shortcodes/posts-grid.php' );
	require_once( 'shortcodes/circle-stat.php' );
	require_once( 'shortcodes/shortcodes.php' );
?>