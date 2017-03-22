<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcSliderInterno extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_slider_mapping' ) );
        add_shortcode( 'vc_slider', array( $this, 'vc_slider_html' ) );
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
                'name'=>__('Slider Principal','baquedano'),
                'base'=>'vc_slider',
                'description'=>__('Add main Slider to the page based on slides custom post'),
                'class'=>'mainSlider',
                'show_settings_on_create'=>true,
                'weight'=>10,
                'category'=>__('Structure'),
                'group'=>__('Partes Baquedano'),
                'icon'=>get_template_directory_uri().'/assets/img/logo_baquedano.png',
                'params'=>array(
                    array(
                        'type'=>'textfield',
                        'class'=>'slides',
                        'heading' => __( 'Cantidad de Slides' ),
                        'param_name' => 'slides',
                        'value' => 3,
                        'description' => __( 'Cantidad de Slides' ),
                        'admin_label' => true,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',

                        )
                    )
                )
            );

    } 


    // Element HTML
    public function vc_slider_html( $atts ) {
        extract(shortcode_atts(array(
            'slides'=>3,

            ),$atts));

        $args=array(
            'post_type' => 'slider',
            'posts_per_page'=>$slides
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
                    'imagen'=>get_field('imagen_slider'),
                    'contenido'=>$content,
                    'link'=>get_field('link'),
                    );
                array_push($posts,$post);
            }
            wp_reset_postdata();
        } else {
            $posts=array(
                array(
                    'titulo'=>'BAQUEDANO CONSULTORES 1',
                    'imagen'=>29,
                    'contenido'=>'<h2>WWW.BAQUEDANOCONSULTORES.CL</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                    'link'=>'projects-details.html',
                    ),
                array(
                    'titulo'=>'BAQUEDANO CONSULTORES 2',
                    'imagen'=>30,
                    'contenido'=>'<h2>WWW.BAQUEDANOCONSULTORES.CL</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                    'link'=>'projects-details.html',
                    ),
                array(
                    'titulo'=>'BAQUEDANO CONSULTORES 3',
                    'imagen'=>29,
                    'contenido'=>'<h2>WWW.BAQUEDANOCONSULTORES.CL</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                    'link'=>'projects-details.html',
                    ),
                );
    // no posts found
        }
        ob_start();  
        ?>
        <div class="img-slider">
            <ul class="top-banner">
                <?php 
                foreach ($posts as $post) {
                    ?>
                    <li>
                        <?php
                        echo wp_get_attachment_image($post['imagen'],'Sliders Size');
                        ?>
                    </li>
                    <?php 
                }
                ?>
            </ul>
        </div>
        <div class="detail-content">
            <div class="container">
                <div class="detail">
                    <div class="top-row">
                        <?php 
                        foreach ($posts as $post) {
                            ?>
                            <strong><?= $post['titulo']?></strong>
                            <?php 
                        }
                        ?>
                        <div class="direction-arrrow">
                            <a href="javascript:;" class="prv"></a>
                            <a href="javascript:;" class="next"></a>
                        </div>

                    </div>

                    <ul class="bottom-sec" id="bottom-sec">

                        <?php 
                        foreach ($posts as $post) {
                            ?>
                            <li class="inner-bottom-sec">
                                <?= $post['contenido']?>
                                <a href="<?= $post['link']?>">VER MÁS</a>
                            </li>
                            <?php 
                        }
                        ?>
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