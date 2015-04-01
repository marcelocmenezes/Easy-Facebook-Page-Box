<?php
/**
 * Plugin Name: Easy Facebook Page Box
 * Plugin URI: https://github.com/marcelocmenezes/EasyPageBox
 * Description: Plugin da nova Page Box do Facebook.
 * Author: Marcelo Menezes
 * Author URI: https://github.com/marcelocmenezes
 * Version: 1.0
 * License: GPLv2 or later
 */


if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly
}


if ( !class_exists( 'EasyPageBox' ) ) :

class EasyPageBox {

	/*
	 * Pagina do Facebook. ex: fb.com/FacebookBrasil
	 * Obs: Somento o nome ou os numeros após a barra.
	 */
	public $page = 'FacebookBrasil';


	/*
	 * Local. ex: pt_BR, en_US
	 */
	public $locale = 'pt_BR';


	/*
	 * Plugin version.
	 */
	const VERSION = '1.0.0';
	
	
	/*
	 * Instance of this class.
	 */
	protected static $instance = null;
	

	/*
	 * Inicialização do plugin.
	 */
	public function __construct() {
		
		add_action( 'wp_enqueue_scripts',  array( $this, 'stylesheeting' ), 0 );

		add_action( 'wp_footer', array( $this, 'html' ), 99 );

	}
	

	/*
	 * Criando uma instância da Classe.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}
	
		return self::$instance;
	}


	/*
	 * Registrando os estilos CSS.
	 */
	public function stylesheeting() {

		wp_enqueue_style( 'easypagebox', plugins_url( 'css/style.css', __FILE__ ) );
	}


	/*
	 * Código HTML do plugin.
	 */
	public function html() { 

		echo '
				<ul id="easypagebox">
		   			<li class="easypagebox">
		        		<img alt="facebook" src="' . plugins_url( 'images/fb.png', __FILE__ )  . '">
		        		<div class="fb-page">
		        			<iframe src="https://www.facebook.com/v2.3/plugins/page.php?container_width=1264&hide_cover=false&href=https://www.facebook.com/' . $this->page .'&locale=' . $this->locale . '&sdk=joey&show_facepile=true&show_posts=false&width=280&height=224" 
		        					style="border: medium none; visibility: visible;" title="fb:page Facebook Social Plugin" scrolling="no" allowtransparency="true" name="f14552a2be38a6" frameborder="0"></iframe>
		  				</div>
		  		    </li>
				</ul> ';

	}

}


add_action( 'plugins_loaded', array( 'EasyPageBox', 'get_instance' ), 0 );

endif;
