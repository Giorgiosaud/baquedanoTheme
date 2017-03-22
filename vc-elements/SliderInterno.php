<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcSliderInterno extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_slider_interno_mapping' ) );
        add_shortcode( 'vc_slider_interno', array( $this, 'vc_slider_interno_html' ) );
    }

    // Element Mapping
    public function vc_slider_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
            // Map the block with vc_map()
        vc_map(
            array(
                'name'=>__('Slider Interno','baquedano'),
                'base'=>'vc_slider_interno',
                "as_parent" => array('only' => 'vc_slide'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "is_container" => true,
                "js_view" => 'VcColumnView',
                'description'=>__('Add Slider to the page'),
                'show_settings_on_create'=>true,
                'weight'=>10,
                'category'=>__('Structure'),
                'group'=>__('Partes Baquedano'),
                'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
                'params'=>array(
                    )
                )
            );

    } 


    // Element HTML
    public function vc_slider_interno_html( $atts,$content ) {
        extract(shortcode_atts(array(
            ),$atts));
        ob_start();  
        ?>
        <div class="img-slider">
            <ul class="top-banner">
                <?= $content ?>
            </ul>
        </div>
        <div class="detail-content">
            <div class="container">
                <div class="detail">
                    <div class="top-row">
                        <?= $content ?>
                        <div class="direction-arrrow">
                            <a href="javascript:;" class="prv"></a>
                            <a href="javascript:;" class="next"></a>
                        </div>

                    </div>

                    <ul class="bottom-sec" id="bottom-sec">
                        <?= $content ?>
                    </ul>

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
new vcSliderInterno();   
class vcSlideInterno extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_slide_interno_mapping' ) );
        add_shortcode( 'vc_slide_interno', array( $this, 'vc_slide_interno_html' ) );
    }

    // Element Mapping
    public function vc_slide_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
            // Map the block with vc_map()
        vc_map(array(
            "name" => __("Slider Item", "my-text-domain"),
            "base" => "vc_slide_interno",
            "content_element" => true,
            "as_child" => array('only' => 'vc_slider_interno'), // Use only|except attributes to limit parent (separate multiple values with comma)
            "params"=> array(
              array(
                "type" => "textfield",
                "heading" => __("Titulo", "my-text-domain"),
                "param_name" => "titulo",
                "description" => __("Titulo Del Slide.", "my-text-domain")
                ),
              array(
                "type" => "attach_image",
                "heading" => __("Imagen", "my-text-domain"),
                "param_name" => "imagen",
                "description" => __("Imagen Slide.", "my-text-domain")
                ),
              array(
                'label' => __( 'Informacion', 'baquedano' ),
                'holder' => 'p',
                'type' => 'textarea_html',
                'param_name' => 'content',
                'value'=>__('<h2>WWW.BAQUEDANOCONSULTORES.CL</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>','baquedano'),
                'description' => __( 'Informacion', 'baquedano' ),
                'group' => 'Partes Baquedano',
                ),
              array(
                'type' => 'textfield',
                    // 'holder'=>'div',
                'heading' => __( 'link' ),
                'param_name' => 'link',
                'value' => __( '#', 'baquedano' ),
                'admin_label' => true,
                'weight' => 0,
                'group' => 'Partes Baquedano',
                ),  
              )

            ))
    }
    public function vc_slide_interno_html(){
        extract(shortcode_atts(array(
            'titulo'=>__('WWW.BAQUEDANOCONSULTORES.CL. <i></i>'),
            'content'=>__('Te ofrecemos soluciones habitacionales adaptadas a tus necesidades.'),
            'imagen'=>'83',
            'boton'=>'<a href="#">SOLICITAR MÁS INFORMACIÓN</a>', 
            'estilo'=>'Titulo'
            ),$atts));
        ob_start();
        ?>

        <h1><?= $titulo?></h1>
        <?php
        $output_string = ob_get_contents();
        ob_end_clean();
        return $output_string;
    }
}
new vcSlideInterno();