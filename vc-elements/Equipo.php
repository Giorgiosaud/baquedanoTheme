<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcEquipo extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_equipo_mapping' ) );
        add_shortcode( 'vc_equipo', array( $this, 'vc_equipo_html' ) );
    }

    // Element Mapping
    public function vc_equipo_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
            // Map the block with vc_map()
        vc_map(
            array(
                'name'=>__('Equipo de Trabajo','baquedano'),
                'base'=>'vc_equipo',
                'description'=>__('Equipo de Trabajo estilo Nosotros'),
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
                        'value' => __( 'Nuestro Equipo', 'baquedano' ),
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
                        'value' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'baquedano' ),
                        'description' => __( 'Sub Titulo', 'baquedano' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        ),  
                    array(
                        'type'=>'textfield',
                        'heading' => __( 'Cantidad de Miembros A Mostrar' ),
                        'param_name' => 'cantidad',
                        'value' => 3,
                        'description' => __( 'Cantidad de Miembros A Mostrar' ),
                        'admin_label' => true,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',

                        ),
                    )
                )
            );

    } 


    // Element HTML
    public function vc_equipo_html( $atts ) {
        extract(shortcode_atts(array(
            'slides'=>3,
            'title'=>'Nuestro Equipo',
            'sub_title'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',

            ),$atts));

        $args=array(
            'post_type' => 'equipo',
            'posts_per_page'=>$slides
            );
        $the_query = new \WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
            $equipo=array();
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $excerpt = apply_filters( 'the_content', get_the_excerpt() );
                $miembro=array(
                    'nombre'=>get_the_title(),
                    'cargo'=>get_field('cargo'),
                    'imagen'=>get_the_post_thumbnail(null,'full'),
                    'contenido'=>$excerpt,
                    'link'=>get_permalink(),
                    );
                array_push($equipo,$miembro);
            }
            wp_reset_postdata();
        } else {
            $equipo=array(
                array(
                    'nombre'=>'Nombre y Apellido',
                    'imagen'=>"<img src='' alt='imagen miembro'",
                    'cargo'=>'cargo',
                    'contenido'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim.',
                    'link'=>'#',
                    ),
                array(
                    'nombre'=>'Nombre y Apellido',
                    'imagen'=>"<img src='' alt='imagen miembro'",
                    'cargo'=>'cargo',
                    'contenido'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim.',
                    'link'=>'#',
                    ),
                array(
                    'nombre'=>'Nombre y Apellido',
                    'imagen'=>"<img src='' alt='imagen miembro'",
                    'cargo'=>'cargo',
                    'contenido'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ornare odio et massa dignissim.',
                    'link'=>'#',
                    )
                );
    // no posts found
        }
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
                                <?php 
                                foreach($equipo as $miembro ){
                                    ?>
                                    <li class="zoom">
                                        <div>
                                            <figure class="img-box fade-effect">
                                                <a href="<?=$miembro['link']?>"><?=$miembro['imagen']?></a>
                                            </figure>
                                            <div class="member-detail">
                                                <span class="name"><a href="<?=$miembro['link']?>"><?=$miembro['nombre']?></a></span>
                                                <span class="designation"><?=$miembro['cargo']?> <i></i></span>
                                                <P>
                                                    <?=$miembro['contenido']?>
                                                </P>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>

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

} // End Element Class

// Element Class Init
new vcEquipo();    