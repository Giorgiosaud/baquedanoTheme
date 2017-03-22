<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcInfoInterna extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'vc_info_interna_mapping' ) );
		add_shortcode( 'vc_info_interna', array( $this, 'vc_info_interna_html' ) );
	}

	// Element Mapping
	public function vc_info_interna_mapping() {

		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
			// Map the block with vc_map()
		vc_map(array(
			'name'=>__('Seccion Informativa Interna','baquedano'),
			'base'=>'vc_info_interna',
			'description'=>__('Add main Slider to the page based on slides custom post'),
			'class'=>'mainSlider',
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
					'heading' => __( 'Title' ),
					'param_name' => 'title',
					'value' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim,', 'baquedano' ),
					'description' => __( 'Titulo', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'type' => 'textfield',
					'holder' => 'h2',
					'class' => 'section-header',
					'heading' => __( 'Sub Title' ),
					'param_name' => 'sub_title',
					'value' => __( 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR.', 'baquedano' ),
					'description' => __( 'Sub Titulo', 'baquedano' ),
					'admin_label' => false,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					),  
				array(
					'heading'=>__( 'Informacion', 'baquedano' ),
					'label' => __( 'Informacion', 'baquedano' ),
					'type' => 'textarea_html',
					'holder' => 'div',
					// 'admin_label'=>true,
					'param_name' => 'content',
					'description' => __( 'Informacion', 'baquedano' ),
					'group' => 'Partes Baquedano',
					),
				array(
					'type' => 'attach_images',
					'heading' => __( 'Imagenes', 'baquedano' ),
					'param_name' => 'imagenes',
					'description' => __( 'Imagenes a Mostrar', 'baquedano' ),
					'admin_label' => true,
					'weight' => 0,
					'group' => 'Partes Baquedano',
					)
				),
			));
	} 


	// Element HTML
	public function vc_info_interna_html( $atts ) {
		extract(shortcode_atts(array(
			'title'=>__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim'),
			'sub_title'=>__('LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR.'),
			'content'=>__('incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
			'imagenes'=>'50,51,52,53',
			),$atts));
		$arrayImages=explode(',', $imagenes);
		ob_start();  
		?>

		<div class="col-xs-12 col-sm-6 ">
			<div class="about-detail">
				<h3> <?= $title ?> <i></i></h3>
				<h4><?= $sub_title ?></h4>

				<p>
					<?= $content ?>
				</p>

			</div>
		</div>

		<div class="col-xs-12 col-sm-6 ">
			<div class="about-img ">
				<?php for ($i=0; $i < count($arrayImages); $i++) { ?>
				<?php 
				$imagen=wp_get_attachment_image($arrayImages[$i],'full');
				if($i==0){
					$imagen=wp_get_attachment_image( $arrayImages[$i],  'full', false,array('class'=>'coll') );
				}
				echo $imagen;
				?>
				<?php }?>
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
new vcInfoInterna();    