<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ibsofts.com
 * @since      1.0.0
 *
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/admin
 * @author     iB ARts Pvt. Ltd. <support@ibarts.in>
 */
class Ib_Refer_Me_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ib_Refer_Me_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ib_Refer_Me_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        wp_register_style( 'jQueryDT', plugins_url('css/jquery.dataTables.min.css', __FILE__));
        wp_enqueue_style('jQueryDT');
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ib-refer-me-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ib_Refer_Me_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ib_Refer_Me_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        
        wp_register_script( 'jQueryDataTables', plugins_url('js/jquery.dataTables.js', __FILE__), array('jquery'));
        wp_enqueue_script( 'jQueryDataTables' );
        
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ib-refer-me-admin.js', array( 'jquery' ), $this->version, false );
	}
	
	public function ib_reference(){
	    add_menu_page('Reference Form','Referral System','administrator','Reference Data',array(__CLASS__,'ib_reference_data'),'dashicons-share-alt2');
	}
	
	public static function ib_reference_data()
	{
	   if(file_exists( plugin_dir_path(__FILE__).'partials/ib-refer-me-admin-display.php')){
	        require plugin_dir_path(__FILE__).'partials/ib-refer-me-admin-display.php';
	   }
	}

}