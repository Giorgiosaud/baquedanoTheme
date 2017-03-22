<?php
namespace Giorgiosaud\Baquedano;
Class CustomPosts{
	public function __construct()
	{
		$this->customPostsTypes=array(
			// array(
			// 	'customPostName'=>'slider',
			// 	'Name'=>'Sliders',
			// 	'Singular'=>'Slider',
			// 	),
			// array(
			// 	'customPostName'=>'servicios',
			// 	'Name'=>'Servicios',
			// 	'Singular'=>'Servicio',
			// 	),
			array(
				'customPostName'=>'proyecto',
				'Name'=>'Proyectos',
				'Singular'=>'proyecto',
				),
			// array(
			// 	'customPostName'=>'testimonios',
			// 	'Name'=>'Testimonios',
			// 	'Singular'=>'Testimonio',
			// 	),
			// array(
			// 	'customPostName'=>'equipo',
			// 	'Name'=>'Equipo',
			// 	'Singular'=>'Equipo',
			// 	),
			);
		add_action( 'init', array($this,'create_posts_types') );

	}
	public function create_posts_types(){
		foreach ($this->customPostsTypes as $value) {
			register_post_type( $value['customPostName'],
				array(
					'labels' => array(
						'name' => __( $value['Name'] ),
						'singular_name' => __( $value['Singular'] )
						),
					'public' => true,
					'has_archive' => true,
					'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )

					)
				);
		}

	}

}	
