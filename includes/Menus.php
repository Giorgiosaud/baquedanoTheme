<?php
namespace Giorgiosaud\Baquedano;
Class Menus{
	public function __construct()
	{
		$this->menus=array(
			'menu_principal'=>__('Menu Principal')
		);
		add_action('init',array($this,'registerMenus'));
	}
	/**
	 * undocumented function
	 *
	 * @return void
	 */
	public function registerMenus()
	{
		register_nav_menus($this->menus);
		return null;
	}
	
}
