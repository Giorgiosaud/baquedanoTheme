<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcContacto extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'vc_contacto_mapping' ) );
		add_shortcode( 'vc_contacto', array( $this, 'vc_contacto_html' ) );
	}

	// Element Mapping
	public function vc_contacto_mapping() {

		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
			// Map the block with vc_map()
		vc_map(array(
			'name'=>__('Seccion Contacto','baquedano'),
			'base'=>'vc_contacto',
			'description'=>__('Add Contact form to the page'),
			'class'=>'contacto-container',
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
					'value' => __( 'ENTRA EN CONTACTO CON NOSOTROS', 'baquedano' ),
					'description' => __( 'Titulo', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'label' => __( 'Sub Titulo', 'baquedano' ),
					'type' => 'textarea',
					'holder'=>'div',
					'param_name' => 'sub_titulo',
					'value'=>__('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.','baquedano'),
					'description' => __( 'Sub Titulo', 'baquedano' ),
					'group' => 'Partes Baquedano',
					),
				array(
					'type'=>'textfield',


					'heading' => __( 'Id Contact Form' ),
					'param_name' => 'contact_form',
					'value' => '[contact-form-7 id="119" title="Formulario de contacto 1"]',
					'description' => __( 'Id Contact Form' ),
					'admin_label' => true,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					)
				
				),
			));
	} 


	// Element HTML
	public function vc_contacto_html( $atts ) {
		extract(shortcode_atts(array(
			'titulo'=>__('ENTRA EN CONTACTO CON NOSOTROS'),
			'sub_titulo'=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.',
			'contact_form'=>'[contact-form-7 id="119" title="Formulario de contacto 1"]',

			),$atts));
		$arrayImages=explode(',', $imagenes);
		ob_start();  
		?>
		<div class="col-xs-12">
			<div class="our_contact clearfix">
				<div id="success">
					<div role="alert" class="alert alert-success">
						<strong>Gracias por escribirnos</strong> Te contactaremos a la brevedad posible
					</div>
				</div>
				<h3><?= $titulo?><i></i></h3>

				<div class="left-detail clearfix">
					<strong><?= $sub_titulo ?> </strong>
					<?php echo do_shortcode( $contact_form, false );?>

				</div>

				<div class="right-detail">
					<div class="social-icons">
						<?php if(get_option('facebook_link')!='#'):?>
							<a href="<?= get_option('facebook_link')?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<?php endif; ?>
						<?php if(get_option('twitter_link')!='#'):?>
							<a href="<?= get_option('twitter_link')?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<?php endif; ?>
						<?php if(get_option('google_link')!='#'):?>
							<a href="<?= get_option('google_link')?>" target="_blank"><i class="fa fa-google-plus"></i></a>
						<?php endif; ?>

					</div>
					<address>
						<strong>OFICINA PRINCIPAL</strong>
						<ul>
							<li>
								<i class="location-svg"><img src="<?= get_template_directory_uri()?>/assets/svg/05.svg" alt="" class="svg"/></i>
								<?= get_option('direccion')?>
							</li>

							<li>
								<i class="fa fa-phone"></i>
								<span><?= get_option('telefono')?></span>
							</li>

							<li>
								<i class="fa fa-envelope-o"></i>
								<span><a href="mailto:<?= get_option('email')?>"><?= get_option('email')?></a></span>
							</li>
						</ul>
					</address>
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
new vcContacto();    