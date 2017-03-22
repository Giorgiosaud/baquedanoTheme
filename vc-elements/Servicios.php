<?php
vc_map( array(
	"name" => __("Servicios", "my-text-domain"),
	"base" => "servicios",
    "content_element" => true,
    "show_settings_on_create" => false,
    "is_container" => true,
    'weight'=>10,
    'category'=>__('Structure'),
    'group'=>__('Partes Baquedano'),
    'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
    "params" => array(
        // add params same as with any other content element
    	array(
    		"type" => "textfield",
    		'holder' => 'h1',
    		"heading" => __("Titulo"),
    		"value"=>"Servicios",
    		"param_name" => "titulo",
    		'weight'=>1000,
    		"description" => __("Titulo de Seccion.")
    		)
    	),
    "as_parent" => array('only' => 'servicio'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)

    "js_view" => 'VcColumnView'
    ) );
add_shortcode( 'servicios', 'vc_service_html'  );
function vc_service_html( $atts,$content ) {
	extract(shortcode_atts(array(
		'titulo'=>'Servicios'
		),$atts));
	$content_slides=str_replace("[servicios ",'[servicios estilo="Slides" ',$content);
	$content_miniatura=str_replace("[servicios ",'[servicios estilo="Miniatura" ',$content);
	ob_start();  
	?>
	<div class="service-container">
		<div class="container">
			<div class="row">

				<div class="left-detail animate-effect">
					<div id="slide-items" class="flexslider">
						<ul class="slides">
							<?= do_shortcode($content_slides)?>
						</ul>
					</div>
				</div>
				<div class="right-detail animate-effect">
					<h2><span><?= $titulo ?></span></h2>
				</div>

				<div class="col-xs-12">
					<div id="carousel" class="flexslider">
						<ul class="our-service slides animate-effect clearfix">
							<?= do_shortcode($content_miniatura)?>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>




	<?php
	$output_string = ob_get_contents();
	ob_end_clean();

	return $output_string;

        //.. the Code is in the next steps ..//
} 

vc_map( array(
	"name" => __("Servicio"),
	"base" => "servicio",
	"content_element" => true,
    "as_child" => array('only' => 'servicios'), // Use only|except attributes to limit parent (separate multiple values with comma)
    'weight'=>10,
    'category'=>__('Structure'),
    'group'=>__('Partes Baquedano'),
    'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
    "params" => array(
        // add params same as with any other content element
    	array(
    		"type" => "textfield",
    		'holder' => 'h2',
    		'value'=>'Servicio',
    		"heading" => __("Titulo", "my-text-domain"),
    		"param_name" => "titulo",
    		"description" => __("Titulo Del Servicio.", "my-text-domain")
    		),
    	array(
    		'type' => 'textarea_html',
    		'label' => __( 'Informacion', 'baquedano' ),
    		'holder' => 'p',
    		'param_name' => 'content',
    		'value'=>__('<h2>WWW.BAQUEDANOCONSULTORES.CL</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>','baquedano'),
    		'description' => __( 'Informacion', 'baquedano' ),
    		),
    	array(
    		"type" => "attach_image",
    		"heading" => __("Imagen", "my-text-domain"),
    		"param_name" => "imagen",
    		'admin_label' => true,
    		"description" => __("Imagen Slide.", "my-text-domain")
    		),

    	array(
    		'type' => 'textfield',
                    // 'holder'=>'div',
    		'heading' => __( 'link' ),
    		'param_name' => 'link',
    		'value' => __( '#', 'baquedano' ),
    		'admin_label' => true,
    		'weight' => 1,
    		)
    	)
    ) );
add_shortcode( 'slide_interno',  'vc_servicio_interno_html'  );

function vc_servicio_interno_html($atts,$content){
	extract(shortcode_atts(array(
		'titulo'=>__('WWW.BAQUEDANOCONSULTORES.CL. <i></i>'),
		'imagen'=>'83',
		'link'=>'#', 
		'estilo'=>'Titulo'
		),$atts));
	if($estilo=="Slides"){
		echo "<li><h2>$titulo<i></i></h2><strong>www.baquedanoconsultores.cl</strong>$excerpt<a href='$link' class='quote'>VER MÁS</a></li>";
	}
	if($estilo=="Miniatura"){
		$imagentag=wp_get_attachment_image($imagen,'Sliders Size');
		echo "<li class='zoom'><a href='$link'><em class='fa fa-caret-up'></em><figure class='fade-effect'>$imagentag</figure> <strong> <i></i>$titulo</strong></a></li>";
	}
	
}
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Servicios extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Servicio extends WPBakeryShortCode {
	}
}
