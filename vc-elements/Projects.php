<?php
/*
Element Description: VC Info Box
*/

// Element Class 
class vcProject extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_projects_mapping' ) );
        add_shortcode( 'vc_projects', array( $this, 'vc_project_html' ) );
    }

    // Element Mapping
    public function vc_projects_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
            // Map the block with vc_map()
        vc_map(
            array(
                'name'=>__('Proyectos Principal','baquedano'),
                'base'=>'vc_projects',
                'description'=>__('Add main project to the page based on slides custom post'),
                'class'=>'mainproject',
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
                        'value' => __('<span>NUESTROS <strong>PROYECTOS</strong> <em></em> </span>'),
                        'description' => __( 'Titulo de Seccion' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        ),
                    array(
                        'type'=>'textfield',
                        'heading' => __( 'Cantidad de Proyectos' ),
                        'param_name' => 'proyectos',
                        'value' => 2,
                        'description' => __( 'Cantidad de Proyectos' ),
                        'admin_label' => true,
                        'weight' => 0,
                        'group' => 'Partes Baquedano',
                        ),
                    array(
                        'type'=>'vc_link',
                        'heading' => __( 'Link del Titulo' ),
                        'param_name' => 'link',
                        // 'value' => 'https://baquedanoconsultores.cl/home/proyecto',
                        'description' => __( 'Link a Proyectos' ),
                        // 'admin_label' => true,
                        // 'weight' => 0,
                        'group' => 'Partes Baquedano',
                        )
                    )
                )
            );

    } 


    // Element HTML
    public function vc_project_html( $atts ,$link) {
        extract(shortcode_atts(array(
            'proyectos'=>2,
            'titulo'=>'<span>NUESTROS <strong>PROYECTOS</strong> <em></em> </span>',
            'link'=>'#'
            ),$atts));
        die(var_dump($link));
        $args=array(
            'post_type' => 'proyecto',
            'posts_per_page'=>$proyectos
            );
        $the_query = new \WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
            $posts=array();
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $excerpt = get_the_excerpt();
                $is_builded=has_term( 'construccion', 'tipo_de_proyecto' );
                $is_selled=has_term( 'venta', 'tipo_de_proyecto' );
                $post=array(
                    'titulo'=>get_the_title(),
                    'imagen'=>get_the_post_thumbnail(null,'full'),
                    'link'=>get_permalink(),
                    'construccion'=>$is_builded,
                    'venta'=>$is_selled,
                    );
                array_push($posts,$post);
            }
            wp_reset_postdata();
            
        }
        ob_start();  
        ?>
        <div class="project-container">
            <div class="container">
                <div class="row">
                    <a href="#" class="our-project"><?=$titulo?></a>
                    <?php $iterator=0;
                    foreach ($posts as $post) 
                    {
                        $iterator++;
                        ?>
                        <div class="col-xs-12 <?php if($iterator%2==0){ echo 'odd';}?>">
                            <div class="detai-box animate-effect">

                                <h2><?= $post['titulo']?></h2>
                                <strong>¿QUÉ HICIMOS?</strong>
                                <ul class="clearfix">
                                    <?php 
                                    if($post['construccion'])
                                    {
                                        ?>
                                        <li>
                                            <a href="<?= $post['link']?>"><i class="icon-design fa fa-pencil"></i> <span>CONSTRUCCIÓN</span></a>
                                        </li>
                                        <?php 
                                    };
                                    if($post['venta'])
                                    {
                                        ?>
                                        <li>
                                            <a href="<?= $post['link']?>"><i class="icon-manegement fa fa-asterisk"></i> <span>VENTA</span></a>
                                        </li>
                                        <?php 
                                    } ?>
                                </ul>
                            </div>
                            <div class="img-box fade-effect">
                                <a href="<?= $post['link']?>">
                                    <?= $post['imagen']?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }?>



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
new vcProject();    