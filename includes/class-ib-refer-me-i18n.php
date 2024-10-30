<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.ibsofts.com
 * @since      1.0.0
 *
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/includes
 * @author     iB ARts Pvt. Ltd. <support@ibarts.in>
 */
class Ib_Refer_Me_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ib-refer-me',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
