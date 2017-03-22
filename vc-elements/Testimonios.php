<?php


vc_map( array(
    "name" => __("Testimonios"),
    "base" => "testimonios",
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
            "value"=>"¿QUÉ DICEN</span> NUESTROS CLIENTES?",
            "param_name" => "titulo",
            'weight'=>10,
            "description" => __("Titulo de Testimonios")
            ),
        array(
            "type" => "textfield",
            'holder' => 'h1',
            "heading" => __("Sub Titulo"),
            "value"=>"TESTIMONIOS DE CLIENTES SATISFECHOS",
            "param_name" => "sub_titulo",
            'weight'=>10,
            "description" => __("Sub Titulo de Equipo.")
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
        ),
    "as_parent" => array('only' => 'testimonio'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)

    "js_view" => 'VcColumnView'
    ) );
add_shortcode( 'testimonios', 'vc_testimonios_html'  );

function vc_testimonios_html( $atts ,$content) {
    extract(shortcode_atts(array(
        'titulo'=>'<span>¿QUÉ DICEN</span> NUESTROS CLIENTES? <i></i>',
        'subtitulo'=>'<strong>TESTIMONIOS DE CLIENTES SATISFECHOS</strong>'

        ),$atts));
    $testimonio_full=str_replace("[testimonio ",'[testimonio estilo="Full" ',$content);
    $testimonio_imagen=str_replace("[testimonio ",'[testimonio estilo="Imagen" ',$content);

    ob_start();  
    ?>
    <div class="testimonial-container">
        <div class="container">
            <i class="corve"><img src="<?= get_template_directory_uri()?>/assets/svg/corve.svg" alt="" class="svg"/></i>
            <div class="row">
                <div class="col-xs-12 col-sm-6 tag-bg animate-effect">
                    <div class="customer-says">
                        <h2><?= $titulo?></h2>
                        <?= $subtitulo?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="testimonial-box">
                        <div class="view-list animate-effect">
                            <div class="flexslider" id="testimonial-silder">
                                <ul class="slides">
                                    <?= do_shortcode($testimonio_full)?>

                                </ul>
                            </div>
                        </div>
                        <div class="thumb-box animate-effect">
                            <div class="flexsilder" id="testimonial-carousel">
                                <ul class="slides">
                                    <?= do_shortcode($testimonio_imagen)?>
                           
                                </ul>
                            </div>
                        </div>
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
    "name" => __("Testimonio"),
    "base" => "testimonio",
    "content_element" => true,
    "as_child" => array('only' => 'testimonios'), // Use only|except attributes to limit parent (separate multiple values with comma)
    'weight'=>10,
    'category'=>__('Structure'),
    'group'=>__('Partes Baquedano'),
    'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            'holder' => 'h2',
            'value'=>'Nombre',
            "heading" => __("Nombre y Apellido"),
            "param_name" => "nombre",
            "description" => __("Nombre y Apellido.")
            ),
        array(
            'type' => 'textarea_html',
            'label' => __( 'Testimonio', 'baquedano' ),
            'holder' => 'p',
            'param_name' => 'content',
            'value'=>__('<p>06 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>'),
            'description' => __( 'Testimonio', 'baquedano' ),
            ),
        array(
            "type" => "attach_image",
            "heading" => __("Imagen"),
            "param_name" => "imagen",
            'admin_label' => true,
            "description" => __("Imagen Miembro.")
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
add_shortcode( 'testimonio',  'vc_testimonio'  );
function vc_testimonio( $atts,$content ) {
    extract(shortcode_atts(array(
        'nombre'=>'Nombre y Apellido',
        'imagen'=>36,
        'link'=>'#',
        'estilo'=>'Full'
        ),$atts));

    $contenido = $content;
    $contenido = apply_filters( 'the_content', $contenido );
    $contenido = str_replace( ']]>', ']]&gt;', $contenido );
    if($estilo=="Full"){
        echo "<li><blockquote><i class='fa fa-quote-right'></i>$contenido<footer>$nombre</footer></blockquote></li>";
    }
    if($estilo=="Imagen"){
        $imagentag=wp_get_attachment_image($imagen,'full');

        echo "<li><a href='$link'>$imagentag</a></li>";
    }
    
} 
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Testimonios extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Testimonio extends WPBakeryShortCode {
    }
}
