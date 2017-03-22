<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcQuote extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'vc_quote_mapping' ) );
		add_shortcode( 'vc_quote', array( $this, 'vc_quote_html' ) );
	}

	// Element Mapping
	public function vc_quote_mapping() {

		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
			// Map the block with vc_map()
		vc_map(array(
			'name'=>__('Seccion Quote','baquedano'),
			'base'=>'vc_quote',
			'description'=>__('Add Quote to the page'),
			'class'=>'quote-container',
			'show_settings_on_create'=>true,
			'weight'=>10,
			'category'=>__('Structure'),
			'group'=>__('Partes Baquedano'),
			'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
			'params'=>array(
				array(
					'type' => 'textfield',
					'holder' => 'h1',
					'class' => 'section-header',
					'heading' => __( 'Titulo' ),
					'param_name' => 'titulo',
					'value' => __( 'WWW.BAQUEDANOCONSULTORES.CL. <i></i>', 'baquedano' ),
					'description' => __( 'Titulo', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'label' => __( 'Informacion', 'baquedano' ),
					'holder' => 'p',
					'type' => 'textarea_html',
					'param_name' => 'content',
					'value'=>__('Te ofrecemos soluciones habitacionales adaptadas a tus necesidades.','baquedano'),
					'description' => __( 'Informacion', 'baquedano' ),
					'group' => 'Partes Baquedano',
					),
				array(
					'type' => 'textfield',
					'holder'=>'div',
					'heading' => __( 'Boton' ),
					'param_name' => 'boton',
					'value' => __( '<a href="#">SOLICITAR MÁS INFORMACIÓN</a>', 'baquedano' ),
					'description' => __( 'Boton', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'attach_image',
					'heading' => __( 'Imagen', 'baquedano' ),
					'param_name' => 'imagen',
					'description' => __( 'Imagen a Mostrar', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					)
				),
			));
	} 


	// Element HTML
	public function vc_quote_html( $atts ) {
		extract(shortcode_atts(array(
			'titulo'=>__('WWW.BAQUEDANOCONSULTORES.CL. <i></i>'),
			'content'=>__('Te ofrecemos soluciones habitacionales adaptadas a tus necesidades.'),
			'imagen'=>'83',
			'boton'=>'<a href="#">SOLICITAR MÁS INFORMACIÓN</a>'

			),$atts));
		$arrayImages=explode(',', $imagenes);
		ob_start();  
		?>


		<div class="quote-container">
			<div class="right-banner" style="background:url(<?= wp_get_attachment_url($imagen) ?>) no-repeat 0 0"></div>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="quote-box animate-effect">
						<h4><?= $titulo?></h4>
							<p>
								<?= $content?>
							</p>
							<?= $boton?>
						</div>
					</div>
				</div>
			</div>
		</div>		<?php
		$output_string = ob_get_contents();
		ob_end_clean();

		return $output_string;

		//.. the Code is in the next steps ..//

	} 

} // End Element Class

// Element Class Init
new vcQuote();    