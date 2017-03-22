<?php
namespace Giorgiosaud\Baquedano;
Class Style{
	public function __construct()
	{
		add_action('wp_enqueue_scripts',array($this,'styles'));
		add_action('wp_enqueue_scripts',array($this,'scripts'));
	}
	
	public function styles(){
		wp_register_style('GoogleFonts','http://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300%7CLibre+Baskerville:400,400italic,700%7CLato:400,300,300italic,400italic,700,700italic,900,900italic',null,'all');
		wp_register_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css',array('GoogleFonts'),'all');
		wp_register_style('font-awesome',get_template_directory_uri().'/assets/css/font-awesome.min.css',array('bootstrap'),'all');
		wp_register_style('global',get_template_directory_uri().'/assets/css/global.css',array('font-awesome','bootstrap'),'all');
		wp_register_style('settings',get_template_directory_uri().'/assets/css/settings.css',array('global'),'all');
		wp_register_style('mainStyle',get_template_directory_uri().'/assets/css/style.css',array('settings'),'all');
		wp_register_style('responsive',get_template_directory_uri().'/assets/css/responsive.css',array('mainStyle'),'all');
		wp_register_style('skin',get_template_directory_uri().'/assets/css/skin.less',array('responsive'),'all');
		wp_enqueue_style('skin');
	}
	public function scripts(){
		wp_deregister_script('jquery');	
		wp_register_script('jquery',get_template_directory_uri().'/assets/js/jquery-1.11.2.min.js',null,null,true);
		wp_register_script('jqueryeasing',get_template_directory_uri().'/assets/js/jquery.easing.js',array('jquery'),null,true);
		wp_register_script('bootstrap',get_template_directory_uri().'/assets/js/bootstrap.min.js',array('jqueryeasing'),null,true);
		wp_register_script('less',get_template_directory_uri().'/assets/js/less.js',array('bootstrap'),null,true);
		wp_register_script('bxslider',get_template_directory_uri().'/assets/js/jquery.bxslider.js',array('less'),null,true);
		wp_register_script('flexslider',get_template_directory_uri().'/assets/js/jquery.flexslider.js',array('bxslider'),null,true);
		wp_register_script('mainSite',get_template_directory_uri().'/assets/js/site.js',array('flexslider','bxslider'),null,true);
		wp_enqueue_script('mainSite');
	}
}
