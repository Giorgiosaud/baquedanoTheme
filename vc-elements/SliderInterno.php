<?php
/*
Element Description: VC Slider
*/
//Register "container" content element. It will hold all your inner (child) content elements
vc_map( array(
    "name" => __("Slider", "my-text-domain"),
    "base" => "slider",
    "as_parent" => array('only' => 'slide'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
            "heading" => __("Extra class name", "my-text-domain"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "my-text-domain")
            )
        ),
    "js_view" => 'VcColumnView'
    ) );
add_shortcode( 'slider', 'vc_slider_interno_html'  );

function vc_slider_interno_html($atts,$content){
    extract(shortcode_atts(array(
        ),$atts));
    $content_image=str_replace("[slide ",'[slide estilo="Imagen" ',$content);
    $content_titulo=str_replace("[slide ",'[slide estilo="Titulo" ',$content);
    $content_content=str_replace("[slide ",'[slide estilo="Content" ',$content);
    ob_start();  
    ?>
    <div id="slider">
        <div class="img-slider">
            <ul class="top-banner">
                <?=  do_shortcode($content_image) ?>
            </ul>
        </div>
        <div class="detail-content">
            <div class="container">
                <div class="detail">
                    <div class="top-row">
                        <?=  do_shortcode($content_titulo) ?>
                        <div class="direction-arrrow">
                            <a href="javascript:;" class="prv"></a>
                            <a href="javascript:;" class="next"></a>
                        </div>

                    </div>

                    <ul class="bottom-sec" id="bottom-sec">
                        <?=  do_shortcode($content_content,false) ?>
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
vc_map( array(
    "name" => __("Slide", "my-text-domain"),
    "base" => "slide",
    "content_element" => true,
    "as_child" => array('only' => 'slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
    'weight'=>10,
    'category'=>__('Structure'),
    'group'=>__('Partes Baquedano'),
    'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            'holder' => 'h1',
            "heading" => __("Titulo", "my-text-domain"),
            "param_name" => "titulo",
            "description" => __("Titulo Del Slide.", "my-text-domain")
            ),
        array(
            "type" => "attach_image",
            "heading" => __("Imagen", "my-text-domain"),
            "param_name" => "imagen",
            'admin_label' => true,
            "description" => __("Imagen Slide.", "my-text-domain")
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
            'type' => 'textfield',
                    // 'holder'=>'div',
            'heading' => __( 'link' ),
            'param_name' => 'link',
            'value' => __( '#', 'baquedano' ),
            'admin_label' => true,
            'weight' => 0,
            )
        )
    ) );
add_shortcode( 'slide',  'vc_slide_interno_html'  );
function vc_slide_interno_html($atts,$content){
    extract(shortcode_atts(array(
        'titulo'=>__('WWW.BAQUEDANOCONSULTORES.CL. <i></i>'),
        // 'content'=>__('Te ofrecemos soluciones habitacionales adaptadas a tus necesidades.'),
        'imagen'=>'83',
        'link'=>'#', 
        'estilo'=>'Titulo'
        ),$atts));
    // die(var_dump(wp_get_attachment_image($imagen,'full')));
    if($estilo=="Imagen"){
        $imagenTag=wp_get_attachment_image($imagen,'full');
        echo "<li>$imagenTag</li>";
    }
    if($estilo=="Titulo"){
        echo "<strong>$titulo</strong>";
    }
    if($estilo=="Content"){
        $contenido = $content;
        $contenido = apply_filters( 'the_content', $contenido );
        $contenido = str_replace( ']]>', ']]&gt;', $contenido );
        echo "<li class='inner-bottom-sec'>$contenido<a href='$link'>VER MÁS</a></li>";
    }
}
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Slider extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Slide extends WPBakeryShortCode {
    }
}