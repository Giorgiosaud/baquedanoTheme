<?php
namespace Giorgiosaud\Baquedano;
Class ThemeSupport{
	public function __construct()
	{
		add_action( 'after_setup_theme', array($this,'theme_supports') );
		add_filter( 'get_custom_logo', array($this,'change_logo_class') );
		add_filter('nav_menu_css_class',array($this,'change_active_class_in_menu'),10,4);

	}
	public function change_active_class_in_menu($classes,$item,$args,$depth)
	{
		if( in_array('current-menu-item', $classes) ){
			$classes[] = 'active ';
		}
		return $classes;
	}
	public function change_logo_class( $html ) {
		$html = str_replace( 'custom-logo-link', 'logo', $html );
		return $html;
	}
	
	public function theme_supports()
	{
		add_theme_support( 'custom-logo' ,array(
			'height'      => 50,
			'width'       => 200,
			'flex-width' => true,
		));
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'title-tag' );
		add_image_size( 'Sliders Size', 1970, 780, true );

	}

}	
