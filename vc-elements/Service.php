<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcService extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_service_mapping' ) );
        add_shortcode( 'vc_service', array( $this, 'vc_service_html' ) );
    }

    // Element Mapping
    public function vc_service_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
            // Map the block with vc_map()
        vc_map(
            array(
                'name'=>__('Servicios Principal','baquedano'),
                'base'=>'vc_service',
                'description'=>__('Add main service to the page based on slides custom post'),
                'class'=>'mainservice',
                'show_settings_on_create'=>true,
                'weight'=>10,
                'category'=>__('Structure'),
                'group'=>__('Partes Baquedano'),
                'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
                'params'=>array(
                    array(
                        'type'=>'textfield',
                        'holder'=>'div',
                        'class'=>'titulo',
                        'heading' => __( 'Titulo' ),
                        'param_name' => 'titulo',
                        'value' => __('Servicios'),
                        'description' => __( 'Titulo de Seccion' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        ),
                    array(
                        'type'=>'textfield',
                        'heading' => __( 'Cantidad de Servicios' ),
                        'param_name' => 'servicios',
                        'value' => 5,
                        'description' => __( 'Cantidad de Servicios' ),
                        'admin_label' => true,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        )
                    )
                )
            );

    } 


    // Element HTML
    public function vc_service_html( $atts ) {
        extract(shortcode_atts(array(
            'servicios'=>5,
            'titulo'=>'Servicios'

            ),$atts));

        $args=array(
            'post_type' => 'servicios',
            'posts_per_page'=>$servicios
            );
        $the_query = new \WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
            $posts=array();
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $excerpt = get_the_excerpt();
                $post=array(
                    'titulo'=>get_the_title(),
                    'excerpt'=>get_the_excerpt(),
                    'imagen'=>get_the_post_thumbnail(null,'full'),
                    'link'=>get_permalink(),
                    );
                array_push($posts,$post);
            }
            wp_reset_postdata();
        }
        ob_start();  
        ?>
        <div class="service-container">
            <div class="container">
                <div class="row">

                    <div class="left-detail animate-effect">
                        <div id="slide-items" class="flexslider">
                            <ul class="slides">
                                <?php
                                foreach ($posts as $post) {
                                    ?>
                                    <li>
                                        <h2><?= $post['titulo']?> <i></i></h2>
                                        <strong>www.baquedanoconsultores.cl</strong>
                                        <p>
                                            <?= $post['excerpt']?> 
                                        </p>
                                        <a href="<?= $post['link']?> " class="quote">VER MÁS</a>
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="right-detail animate-effect">
                        <h2><span><?= $titulo ?></span></h2>
                    </div>

                    <div class="col-xs-12">
                        <div id="carousel" class="flexslider">
                            <ul class="our-service slides animate-effect clearfix">
                                <?php
                                foreach ($posts as $post) {
                                    ?>
                                    <li class="zoom">
                                        <a href="#"> <em class="fa fa-caret-up"></em>
                                            <figure class="fade-effect">
                                                <?= $post['imagen']?>
                                            </figure> <strong> <i></i><?= $post['titulo']?> </strong> </a>
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
new vcService();    