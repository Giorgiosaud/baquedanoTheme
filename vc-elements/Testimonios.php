<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcTestimonios extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_testimonio_mapping' ) );
        add_shortcode( 'vc_testimonio', array( $this, 'vc_testimonios_html' ) );
    }

    // Element Mapping
    public function vc_testimonio_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
            // Map the block with vc_map()
        vc_map(
            array(
                'name'=>__('Testimonios Principal','baquedano'),
                'base'=>'vc_testimonio',
                'description'=>__('Add main project to the page based on slides custom post'),
                'class'=>'mainproject',
                'show_settings_on_create'=>true,
                'weight'=>10,
                'category'=>__('Structure'),
                'group'=>__('Partes Baquedano'),
                'front_enqueue_js'=>array(
                    // get_template_directory_uri().'/assets/js/jquery-1.11.2.min.js',
                    get_template_directory_uri().'/assets/js/jquery.easing.js',
                    get_template_directory_uri().'/assets/js/bootstrap.min.js',
                    get_template_directory_uri().'/assets/js/less.js',
                    get_template_directory_uri().'/assets/js/jquery.bxproject.js',
                    get_template_directory_uri().'/assets/js/jquery.flexproject.js',
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
                        'type'=>'textfield',
                        'holder'=>'div',
                        'class'=>'titulo',
                        'heading' => __( 'Titulo' ),
                        'param_name' => 'titulo',
                        'value' => __('<span>¿QUÉ DICEN</span> NUESTROS CLIENTES? <i></i>'),
                        'description' => __( 'Titulo de Seccion' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        ),
                    array(
                        'type'=>'textfield',
                        'holder'=>'div',
                        'class'=>'subtitulo',
                        'heading' => __( 'Sub Titulo' ),
                        'param_name' => 'subtitulo',
                        'value' => __('<strong>TESTIMONIOS DE CLIENTES SATISFECHOS</strong>'),
                        'description' => __( 'Titulo de Seccion' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        ),
                    array(
                        'type'=>'textfield',
                        'holder'=>'div',
                        'class'=>'testimonios',
                        'heading' => __( 'Cantidad de Testimonios' ),
                        'param_name' => 'testimonios',
                        'value' => 4,
                        'description' => __( 'Cantidad de Testimonios' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        )
                    )
                )
            );

    } 


    // Element HTML
    public function vc_testimonios_html( $atts ) {
        extract(shortcode_atts(array(
            'testimonios'=>4,
            'titulo'=>'<span>¿QUÉ DICEN</span> NUESTROS CLIENTES? <i></i>',
            'subtitulo'=>'<strong>TESTIMONIOS DE CLIENTES SATISFECHOS</strong>'

            ),$atts));

        $args=array(
            'post_type' => 'testimonios',
            'posts_per_page'=>$testimonios
            );
        $the_query = new \WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
            $posts=array();
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $content = get_the_content( $more_link_text, $strip_teaser );
                $content = apply_filters( 'the_content', $content );
                $content = str_replace( ']]>', ']]&gt;', $content );
                $post=array(
                    'titulo'=>get_the_title(),
                    'imagen'=>get_the_post_thumbnail(null,'full'),
                    'contenido'=>$content
                    );
                array_push($posts,$post);
            }
            wp_reset_postdata();
            
        }
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
                                        <?php foreach ($posts as $post) {
                                            ?>
                                            <li>
                                                <blockquote>
                                                    <i class="fa fa-quote-right"></i>
                                                    <p>
                                                        <?= $post['contenido']?>
                                                    </p>
                                                    <footer>
                                                        <?= $post['titulo']?>
                                                    </footer>
                                                </blockquote>
                                            </li>

                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="thumb-box animate-effect">
                                <div class="flexsilder" id="testimonial-carousel">
                                    <ul class="slides">
                                        <?php foreach ($posts as $post) {
                                            ?>
                                            <li>
                                                <a href="#">
                                                    <?=$post['imagen']?>
                                                </a>
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
new vcTestimonios();    