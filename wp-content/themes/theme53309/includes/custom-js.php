<?php
add_action( 'wp_enqueue_scripts', 'cherry_child_custom_scripts' );

function cherry_child_custom_scripts() {
	/**
	 * How to enqueue script?
	 *
	 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 */
	wp_enqueue_script( 'btn', get_stylesheet_directory_uri() . '/js/btn.js', array('jquery'), '1.0' );
	wp_enqueue_script( 'my_script', CHILD_URL . '/js/my_script.js', array( 'jquery' ), '1.0' );
} ?>