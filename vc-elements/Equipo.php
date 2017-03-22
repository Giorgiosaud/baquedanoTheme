<?php
vc_map( array(
    "name" => __("Equipo de Trabajo"),
    "base" => "equipo",
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
            "value"=>"Nuestro Equipo",
            "param_name" => "titulo",
            'weight'=>10,
            "description" => __("Titulo de Equipo.")
            ),
        array(
            "type" => "textfield",
            'holder' => 'h1',
            "heading" => __("Sub Titulo"),
            "value"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "param_name" => "sub_titulo",
            'weight'=>10,
            "description" => __("Sub Titulo de Equipo.")
            )
        ),
    "as_parent" => array('only' => 'miembro'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)

    "js_view" => 'VcColumnView'
    ) );
add_shortcode( 'equipo', 'vc_equipo_html'  );
function vc_equipo_html( $atts,$content ) {
    extract(shortcode_atts(array(
        'title'=>'Nuestro Equipo',
        'sub_title'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ),$atts));
    $miembro=array(

        );
    ob_start();  
    ?>


    <div class="our-team-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 animate-effect">
                    <h3><?= $title?> <i></i></h3>
                    <h4><?= $sub_title?></h4>
                    <div class="our-team">
                        <ul class="team-slider clearfix">
                            <?= do_shortcode($content)?>
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
    "name" => __("Miembro"),
    "base" => "miembro",
    "content_element" => true,
    "as_child" => array('only' => 'equipo'), // Use only|except attributes to limit parent (separate multiple values with comma)
    'weight'=>10,
    'category'=>__('Structure'),
    'group'=>__('Partes Baquedano'),
    'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            'holder' => 'h2',
            'value'=>'Nombre y Apellido',
            "heading" => __("Nombre y Apellido"),
            "param_name" => "nombre",
            "description" => __("Nombre y Apellido.")
            ),
        array(
            "type" => "textfield",
            'holder' => 'h3',
            'value'=>'cargo',
            "heading" => __("cago"),
            "param_name" => "cargo",
            "description" => __("Cargo del Miembro.")
            ),
        array(
            "type" => "attach_image",
            "heading" => __("Imagen"),
            "param_name" => "imagen",
            'admin_label' => true,
            "description" => __("Imagen Miembro.")
            ),
        array(
            'type' => 'textarea_html',
            'label' => __( 'Informacion', 'baquedano' ),
            'holder' => 'p',
            'param_name' => 'content',
            'value'=>__('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec erat erat. Integer blandit, nulla quis fermentum hendrerit, nisi diam viverra metus, porta semper est ipsum et sapien. feugiat viverra diam.felis tortor, euismod ac tortor ut.</p>'),
            'description' => __( 'Informacion', 'baquedano' ),
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
add_shortcode( 'miembro',  'vc_miembro'  );
function vc_miembro( $atts,$content ) {
    extract(shortcode_atts(array(
        'nombre'=>'Nombre y Apellido',
        'cargo'=>'cargo',
        'imagen'=>36,
        'link'=>'#'
        ),$atts));
    $contenido = $content;
    $contenido = apply_filters( 'the_content', $contenido );
    $contenido = str_replace( ']]>', ']]&gt;', $contenido );
    $imagentag=wp_get_attachment_image($imagen,'full');
    echo "<li class='zoom'><div><figure class='img-box fade-effect'><a href='$link'>$imagentag</a></figure><div class='member-detail'><span class='name'><a href='$link'>$nombre</a></span><span class='designation'>$cargo<i></i></span>$contenido</div></div></li>";

    return;
} 
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Equipo extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Miembro extends WPBakeryShortCode {
    }
}
