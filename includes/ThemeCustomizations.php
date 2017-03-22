<?php
namespace Giorgiosaud\Baquedano;
Class ThemeCustomizations{
	public function __construct(){
		// Setup the Theme Customizer settings and controls...

		add_action( 'customize_register', array($this,'baquedano_customizations_register') );
		// Enqueue live preview javascript in Theme Customizer admin screen

		add_action( 'customize_preview_init' , array( $this , 'live_preview' ) );
		// Output custom CSS to live site
		// add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );


	}
	/**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
	public static function header_output() {
		?>
		<!--Customizer CSS--> 
		<style type="text/css">
			<?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?> 
			<?php self::generate_css('body', 'background-color', 'background_color', '#'); ?> 
			<?php self::generate_css('a', 'color', 'link_textcolor'); ?>
		</style> 
		<!--/Customizer CSS-->
		<?php
	}
	/**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		$return = '';
		$mod = get_theme_mod($mod_name);
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
				);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
	 /**
	* This outputs the javascript needed to automate the live settings preview.
	* Also keep in mind that this function isn't necessary unless your settings 
	* are using 'transport'=>'postMessage' instead of the default 'transport'
	* => 'refresh'
	* 
	* Used by hook: 'customize_preview_init'
	* 
	* @see add_action('customize_preview_init',$func)
	* @since MyTheme 1.0
	*/
	public static function live_preview() {
		wp_enqueue_script( 
		   'baquedano-themecustomizer', // Give the script a unique ID
		   get_template_directory_uri() . '/includes/js/theme-customizer.js', // Define the path to the JS file
		   array(  'jquery', 'customize-preview' ), // Define dependencies
		   '', // Define a version (optional) 
		   true // Specify whether to put in footer (leave this true)
		   );
	}
   /**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	* 
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*  
	* @see add_action('customize_register',$func)
	* @param \WP_Customize_Manager $wp_customize
	* @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	* @since MyTheme 1.0
	*/
	public static function baquedano_customizations_register($wp_customize)
	{
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'social_links' , array(
			'title'      => __( 'Links Redes Sociales y Contacto', 'baquedano' ),
			'priority'   => 30,
		'capability' => 'edit_theme_options', //Capability needed to tweak
		'description' => __('Definir links de redes sociales y formas de contacto.', 'baquedano'), //Descriptive tooltip
		) 
		);
	//2. Register new settings to the WP database...
		$wp_customize->add_setting( 'facebook_link' , array(
			'default'     => '#',//Default setting/value to save
			'type'=>'option',//Is this an 'option' or a 'theme_mod'?
			'transport' => 'postMessage',
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			));
		$wp_customize->add_setting( 'twitter_link' , array(
			'default'     => '#',//Default setting/value to save
			'type'=>'option',//Is this an 'option' or a 'theme_mod'?
			'transport' => 'postMessage',
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			));
		$wp_customize->add_setting( 'google_link' , array(
			'default'     => '#',//Default setting/value to save
			'type'=>'option',//Is this an 'option' or a 'theme_mod'?
			'transport' => 'postMessage',
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			));

		$wp_customize->add_setting( 'telefono' , array(
			'default'     => '+56 9 6600 0066',
			'type'=>'option',//Is this an 'option' or a 'theme_mod'?
			'transport' => 'postMessage',
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) );
		$wp_customize->add_setting( 'email' , array(
			'default'     => 'info@baquedanoconsultores.cl',
			'type'=>'option',//Is this an 'option' or a 'theme_mod'?
			'transport' => 'postMessage',
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) );
		$wp_customize->add_setting( 'direccion' , array(
			'default'     => '<strong>Av. Vicuña Mackenna 2004</strong>
						<span>Santiago, Chile</span>',
			'type'=>'option',//Is this an 'option' or a 'theme_mod'?
			'transport' => 'postMessage',
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) );
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control(
			new \WP_Customize_Control(//Instantiate the Customize control class
				$wp_customize,//Pass the $wp_customize object (required)
				'facebook_link', //Set a unique ID for the control
				array(
					'label'          => __( 'Facebook Link', 'baquedano' ),//Admin-visible name of the control
					'section'        => 'social_links',//ID of the section this control should render in (can be one of yours, or a WordPress default section)
					'settings'       => 'facebook_link',//Which setting to load and manipulate (serialized is okay)
					'type'           => 'text' //Determines the order this control appears in for the specified section
					)
				)
			);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'twitter_link',
				array(
					'label'          => __( 'Twitter Link', 'baquedano' ),
					'section'        => 'social_links',
					'settings'       => 'twitter_link',
					'type'           => 'text'
					)
				)
			);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'google_plus_link',
				array(
					'label'          => __( 'Google Plus Link', 'baquedano' ),
					'section'        => 'social_links',
					'settings'       => 'google_link',
					'type'           => 'text'
					)
				)
			);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'telefono',
				array(
					'label'          => __( 'Telefono', 'baquedano' ),
					'section'        => 'social_links',
					'settings'       => 'telefono',
					'type'           => 'text'
					)
				)
			);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'email',
				array(
					'label'          => __( 'Email', 'baquedano' ),
					'section'        => 'social_links',
					'settings'       => 'email',
					'type'           => 'text'
					)
				)
			);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'direccion',
				array(
					'label'          => __( 'Direccion', 'baquedano' ),
					'section'        => 'social_links',
					'settings'       => 'direccion',
					'type'           => 'textarea'
					)
				)
			);
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	}
}
