<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'kindly_setup' ) ) {
	function kindly_setup() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		load_theme_textdomain( 'kindly', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'kindly_setup' );

if ( ! function_exists( 'kindly_enqueue_styles' ) ) {
	function kindly_enqueue_styles() {
		wp_enqueue_style( 'kindly-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'kindly_enqueue_styles' );

if ( ! function_exists( 'kindly_register_pattern_categories' ) ) {
	function kindly_register_pattern_categories() {
		register_block_pattern_category(
			'kindly',
			array( 'label' => __( 'Kindly', 'kindly' ) )
		);
	}
}
add_action( 'init', 'kindly_register_pattern_categories' );
