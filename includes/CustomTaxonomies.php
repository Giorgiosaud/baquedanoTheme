<?php 
namespace Giorgiosaud\Baquedano;
Class CustomTaxonomies{
	public function __construct()
	{
		$this->customTaxonomies=array(
			array(
				'name'=>'tipo_de_proyecto',
				'apply_to'=>array('proyecto'),
				'args' => array(
					'labels'                     => array(
						'name'                       => _x( 'Tipos', 'Taxonomy General Name', 'baquedano' ),
						'singular_name'              => _x( 'Tipo', 'Taxonomy Singular Name', 'baquedano' ),
						'menu_name'                  => __( 'Tipo', 'baquedano' ),
						'all_items'                  => __( 'Todos Los Tipos', 'baquedano' ),
						'parent_item'                => __( 'Tipo Padre', 'baquedano' ),
						'parent_item_colon'          => __( 'Tipo Padre:', 'baquedano' ),
						'new_item_name'              => __( 'Nuevo Tipo', 'baquedano' ),
						'add_new_item'               => __( 'Añadir Nuevo Tipo', 'baquedano' ),
						'edit_item'                  => __( 'Editar Tipo', 'baquedano' ),
						'update_item'                => __( 'Actualizar Tipo', 'baquedano' ),
						'view_item'                  => __( 'Ver Tipo', 'baquedano' ),
						'separate_items_with_commas' => __( 'Separar Tipos con Comas', 'baquedano' ),
						'add_or_remove_items'        => __( 'Añadir o quitar Tipos', 'baquedano' ),
						'choose_from_most_used'      => __( 'Escojer de los Mas Usados', 'baquedano' ),
						'popular_items'              => __( 'Tipos Populares', 'baquedano' ),
						'search_items'               => __( 'Buscar Tipos', 'baquedano' ),
						'not_found'                  => __( 'No Encontrado', 'baquedano' ),
						'no_terms'                   => __( 'Sin Tipos', 'baquedano' ),
						'items_list'                 => __( 'Listar Tipos', 'baquedano' ),
						'items_list_navigation'      => __( '', 'baquedano' ),
						),
					'hierarchical'               => true,
					'public'                     => true,
					'show_ui'                    => true,
					'show_admin_column'          => true,
					'show_in_nav_menus'          => true,
					'show_tagcloud'              => true,
					)
				)
				);
			add_action( 'init', array($this,'registrar_taxonomies') );

		}
		public function registrar_taxonomies(){
			foreach ($this->customTaxonomies as $value) {
				register_taxonomy( $value['name'], $value['apply_to'], $value['args'] );
			}

		}

	}	
