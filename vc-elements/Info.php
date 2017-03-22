<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcInfo extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'vc_info_mapping' ) );
		add_shortcode( 'vc_info', array( $this, 'vc_info_html' ) );
	}

	// Element Mapping
	public function vc_info_mapping() {

		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
			// Map the block with vc_map()
		vc_map(array(
			'name'=>__('Seccion Informativa','baquedano'),
			'base'=>'vc_info',
			'description'=>__('Add main Slider to the page based on slides custom post'),
			'class'=>'mainSlider',
			'show_settings_on_create'=>true,
			'weight'=>10,
			'category'=>__('Structure'),
			'group'=>__('Partes Baquedano'),
			'front_enqueue_js'=>array(
					// get_template_directory_uri().'/assets/js/jquery-1.11.2.min.js',
				get_template_directory_uri().'/assets/js/jquery.easing.js',
				get_template_directory_uri().'/assets/js/bootstrap.min.js',
				get_template_directory_uri().'/assets/js/less.js',
				get_template_directory_uri().'/assets/js/jquery.bxslider.js',
				get_template_directory_uri().'/assets/js/jquery.flexslider.js',
				get_template_directory_uri().'/assets/js/site.js',
				),
			'front_enqueue_css'=>array(
				get_template_directory_uri().'/assets/css/bootstrap.min.css',
				get_template_directory_uri().'/assets/css/font-awesome.min.css',
				get_template_directory_uri().'/assets/css/global.css',
				'http://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300%7CLibre+Baskerville:400,400italic,700%7CLato:400,300,300italic,400italic,700,700italic,900,900italic',
				get_template_directory_uri().'/assets/css/style.css',
				get_template_directory_uri().'/assets/css/responsive.css',
				get_template_directory_uri().'/assets/css/skin.less',

				),
			'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
			'params'=>array(
				array(
					'type' => 'textfield',
					'holder' => 'h2',
					'class' => 'section-header',
					'heading' => __( 'Title' ),
					'param_name' => 'title',
					'value' => __( '¿Quienes Somos?', 'baquedano' ),
					'description' => __( 'Titulo', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'label' => __( 'Informacion', 'baquedano' ),
					'type' => 'textarea_html',
					'param_name' => 'content',
					'description' => __( 'Informacion', 'baquedano' ),
					'group' => 'Partes Baquedano',
					),
				array(
					'type' => 'textarea_raw_html',
					'heading' => __( 'Primer Destacado' ),
					'param_name' => 'primer_destacado',
					'value' => __( '<strong><span>PRIMER</span>DESTACADO</strong>', 'baquedano' ),
					'description' => __( 'Primer Destacado', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textarea_raw_html',
					'heading' => __( 'Segundo Destacado' ),
					'param_name' => 'segundo_destacado',
					'value' => __( '<strong><span>SEGUNDO</span>DESTACADO</strong>', 'baquedano' ),
					'description' => __( 'Segundo Destacado', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textarea_raw_html',
					'heading' => __( 'Tercer Destacado' ),
					'param_name' => 'tercer_destacado',
					'value' => __( '<strong><span>Tercer</span>DESTACADO</strong>', 'baquedano' ),
					'description' => __( 'Tercer Destacado', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				
				array(
					'type' => 'attach_images',
					'holder' => 'div',
					'class' => 'images-class',
					'heading' => __( 'Imagenes', 'baquedano' ),
					'param_name' => 'imagenes',
					'description' => __( 'Imagenes a Mostrar', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					)
				),
			));
	} 


	// Element HTML
	public function vc_info_html( $atts ) {
		extract(shortcode_atts(array(
			'title'=>__('¿Quienes Somos?'),
			'content'=>__('Baquedano Consultores nace de la necesidad de un mejor financiamiento hipotecario, que es entregado haciendo competir a las distintas entidades (bancos, compañías de seguro, leasing), logrando mejores condiciones comerciales a nuestros clientes. Desde aquí se Proyecta al servicio de Corretaje de Propiedades, con la ventaja competitiva de conectar los clientes compradores con Créditos ya aprobados y los propietarios que requieren la venta, esto conjugado con el servicio de arriendo y administración de propiedades de uso habitacional. Ingresando finalmente al sector de terrenos Industriales y/o paños. Logrando la mejor oferta posible a los dueños de terreno o sitio.'),
			'imagenes'=>'50,51,52,53',
			'primer_destacado'=>'<strong><span>PRIMER</span>DESTACADO</strong>',
			'segundo_destacado'=>'<strong><span>SEGUNDO</span>DESTACADO</strong>',
			'tercer_destacado'=>'<strong><span>TERCER</span>DESTACADO</strong>'

			),$atts));
		$arrayImages=explode(',', $imagenes);
		ob_start();  
		?>



		<div class="info-container">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 about-us">
						<header class="section-header">
							<h2><?= $title?><i></i></h2>
						</header>
						<p><?= $content ?></p>
						<ul class="our-quality clearfix">
							<li class="active">
								<i class="check-svg "><img src="<?= get_template_directory_uri()?>/assets/svg/09.svg" alt="" class="svg" /></i>
								<?= $primer_destacado?>
							</li>
							<li>
								<i class="check-svg"><img src="<?= get_template_directory_uri()?>/assets/svg/09.svg" alt="" class="svg" /></i>
								<?= $segundo_destacado?>
							</li>
							<li>
								<i class="check-svg"><img src="<?= get_template_directory_uri()?>/assets/svg/09.svg" alt="" class="svg" /></i>
								<?= $tercer_destacado?>
							</li>
						</ul>
					</div>

					<div class="col-xs-12 col-sm-6 our-images">
						<ul>
							<?php 
							for ($i=0; $i < 2; $i++) { 
								?>
								<li class="zoom">
									<figure>
										<a href="#"> 
											<?= wp_get_attachment_image($arrayImages[$i],'full');?>
										</a>
									</figure>
								</li>
								<?php
							}?>
						</ul>
						<ul>
							<?php 
							for ($i=2; $i < 5; $i++) { 
								?>
								<li class="zoom">
									<figure>
										<a href="#"> 
											<?= wp_get_attachment_image($arrayImages[$i],'full');?>
										</a>
									</figure>
								</li>
								<?php
							}?>
						</ul>
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
new vcInfo();    