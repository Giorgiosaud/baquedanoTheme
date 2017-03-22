<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcMisionVision extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'vc_mision_vision_mapping' ) );
		add_shortcode( 'vc_mision_vision', array( $this, 'vc_mision_vision_html' ) );
	}

	// Element Mapping
	public function vc_mision_vision_mapping() {

		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
			// Map the block with vc_map()
		vc_map(array(
			'name'=>__('Mision Vision','baquedano'),
			'base'=>'vc_mision_vision',
			'description'=>__('Like Mision vision of Nosotros Page'),
			'class'=>'mision-vision-container',
			'show_settings_on_create'=>true,
			'weight'=>10,
			'category'=>__('Structure'),
			'group'=>__('Partes Baquedano'),
			'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
			'params'=>array(
				array(
					'type' => 'attach_image',
					'class' => 'images-class',
					'heading' => __( 'Imagen', 'baquedano' ),
					'param_name' => 'imagen',
					'description' => __( 'Imagen a Mostrar', 'baquedano' ),
					'admin_label' => true,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),
				array(
					'type' => 'textfield',
					'holder' => 'h2',
					'class' => 'section-header',
					'heading' => __( 'Titulo 1' ),
					'param_name' => 'titulo_1',
					'value' => __( 'Misión' ),
					'description' => __( 'Titulo 1', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textfield',
					
					'class' => 'section-header',
					'heading' => __( 'Icono 1' ),
					'param_name' => 'incono_1',
					'value' => __( 'history' ),
					'description' => __( 'Icono 1', 'baquedano' ),
					'admin_label' => true,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textarea',
					'heading' => __( 'Contenido 1' ),
					'holder' => 'p',
					'param_name' => 'contenido_1',
					'value' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim, at accumsan metus viverra. Integer neque lectus.', 'baquedano' ),
					'description' => __( 'Contenido 1', 'baquedano' ),
					'admin_label' => true,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textfield',
					'holder' => 'h2',
					'class' => 'section-header',
					'heading' => __( 'Titulo 2' ),
					'param_name' => 'titulo_2',
					'value' => __( 'VISIÓN' ),
					'description' => __( 'Titulo 2', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textfield',
					'class' => 'section-header',
					'heading' => __( 'Icono 2' ),
					'param_name' => 'incono_2',
					'value' => __( 'mission' ),
					'description' => __( 'Icono 2', 'baquedano' ),
					'admin_label' => true,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textarea',
					'heading' => __( 'Contenido 2' ),
					'holder' => 'p',
					'param_name' => 'contenido_2',
					'value' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim, at accumsan metus viverra. Integer neque lectus.', 'baquedano' ),
					'description' => __( 'Contenido 2', 'baquedano' ),
					'admin_label' => true,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				
				
				
				),
			));
	} 


	// Element HTML
	public function vc_mision_vision_html( $atts ) {
		extract(shortcode_atts(array(
			'imagen'=>'83',
			'icono_1'=>__('history'),
			'titulo_1'=>__('Misión'),
			'contenido_1'=>__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim, at accumsan metus viverra. Integer neque lectus.'),
			'icono_2'=>__('mission'),
			'titulo_2'=>__('Visión'),
			'contenido_2'=>__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim, at accumsan metus viverra. Integer neque lectus.'),
			),$atts));
		$arrayImages=explode(',', $imagenes);
		ob_start();  
		?>


		<div class="col-xs-12">
			<div class="video-container clearfix">
				<div class="video-box">
					<?= wp_get_attachment_image($imagen,'full') ?>
				</div>
				<div class="our-detail animate-effect">
					<div class="box">
						<i class="icon-<?= $icono_1?>"></i>
						<strong><?= $titulo_1 ?></strong>
						<p>
							<?= $contenido_1 ?>
						</p>
					</div>
					<div class="box">
						<i class="icon-<?= $icono_2?>"></i>
						<strong><?= $titulo_2 ?></strong>
						<p>
							<?= $contenido_2 ?>
						</p>
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

} // End Element Class

// Element Class Init
new vcMisionVision();    