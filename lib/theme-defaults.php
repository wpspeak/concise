<?php

//* Theme Setting Defaults
add_filter( 'genesis_theme_settings_defaults', 'concise_theme_defaults' );
function concise_theme_defaults( $defaults ) {

	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'full-width-content';

	return $defaults;

}

//* Theme Setup
add_action( 'after_switch_theme', 'concise_theme_setting_defaults' );
function concise_theme_setting_defaults() {

	_genesis_update_settings( array(
		'posts_nav'                 => 'numeric',
		'site_layout'               => 'full-width-content',
	) );

	update_option( 'posts_per_page', 5 );

}

//* Simple Social Icon Defaults
add_filter( 'simple_social_default_styles', 'wintersong_social_default_styles' );
function wintersong_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'aligncenter',
		'background_color'       => '#ffffff',
		'background_color_hover' => '#ffffff',
		'border_radius'          => 0,
		'icon_color'             => '#222',
		'icon_color_hover'       => '#e5554e',
		'size'                   => 46,
		);
		
	$args = wp_parse_args( $args, $defaults );
	
	return $args;
	
}