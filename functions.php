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

if ( ! function_exists( 'kindly_register_block_styles' ) ) {
	function kindly_register_block_styles() {
		register_block_style(
			'core/button',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'kindly' ),
				'inline_style' => '.wp-block-button.is-style-pill .wp-block-button__link{border-radius:999px}',
			)
		);
		register_block_style(
			'core/group',
			array(
				'name'         => 'card',
				'label'        => __( 'Card', 'kindly' ),
				'inline_style' => '.wp-block-group.is-style-card{background-color:var(--wp--preset--color--base);border:1px solid color-mix(in srgb, var(--wp--preset--color--contrast) 12%, transparent);border-radius:8px;padding:var(--wp--preset--spacing--40)}',
			)
		);
	}
}
add_action( 'init', 'kindly_register_block_styles' );
