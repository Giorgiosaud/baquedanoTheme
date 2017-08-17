<?php
require "vendor/autoload.php";
use Giorgiosaud\Baquedano\Style;
use Giorgiosaud\Baquedano\Menus;
use Giorgiosaud\Baquedano\ThemeSupport;
use Giorgiosaud\Baquedano\ThemeCustomizations;
use Giorgiosaud\Baquedano\CustomPosts;
use Giorgiosaud\Baquedano\CustomTaxonomies;
// use Giorgiosaud\Baquedano\ShortCodes;
new ThemeSupport();
new Style();
new Menus();
new ThemeCustomizations();
new CustomPosts();
new CustomTaxonomies();
// new Shortcodes();
// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {

    //.. Code from other Tutorials ..//

    // Require new custom Element
	require_once( get_template_directory().'/vc-elements/Slider.php' ); 
	require_once( get_template_directory().'/vc-elements/SliderInterno.php' ); 
	require_once( get_template_directory().'/vc-elements/Info.php' ); 
	require_once( get_template_directory().'/vc-elements/Service.php' ); 
	require_once( get_template_directory().'/vc-elements/Servicios.php' ); 
	require_once( get_template_directory().'/vc-elements/Projects.php' ); 
	require_once( get_template_directory().'/vc-elements/Testimonios.php' ); 
	require_once( get_template_directory().'/vc-elements/Quote.php' ); 
	require_once( get_template_directory().'/vc-elements/InfoInterna.php' ); 
	require_once( get_template_directory().'/vc-elements/MisionVision.php' ); 
	require_once( get_template_directory().'/vc-elements/Equipo.php' ); 
	require_once( get_template_directory().'/vc-elements/Contacto.php' ); 

}
add_filter( 'get_the_archive_title', function ( $title ) {

	if( is_category() ) {

		$title = single_cat_title( '', false );

	}
	if( is_post_type_archive() ) {

		$title = 'Proyectos';

	}

	return $title;

});
/*
 * custom pagination with bootstrap .pagination class
 * source: http://www.ordinarycoder.com/paginate_links-class-ul-li-bootstrap/
 */
function bootstrap_pagination( $echo = true ) {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'    => __('« Prev'),
			'next_text'    => __('Next »'),
		)
	);

	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

		$pagination = '<ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= "<li>$page</li>";
		}

		$pagination .= '</ul>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
}