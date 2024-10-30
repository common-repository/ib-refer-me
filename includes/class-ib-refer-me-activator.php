<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.ibsofts.com
 * @since      1.0.0
 *
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/includes
 * @author     iB ARts Pvt. Ltd. <support@ibarts.in>
 */
class Ib_Refer_Me_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
        $table=$wpdb->prefix.'ib_referral';
        $table2=$wpdb->prefix.'ib_contact_form';
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql="CREATE TABLE $table (
		`id` mediumint(9) AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(30) NOT NULL,
        `email` VARCHAR(40) NOT NULL UNIQUE,
        `reference_id` VARCHAR(40) NOT NULL UNIQUE,
		`date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `status` VARCHAR(30) DEFAULT 'Pending'
        ) $charset_collate;";
		$wpdb->query($sql);
		
		$sql2="CREATE TABLE $table2 (
		 id mediumint(9) AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(30) NOT NULL,
         email VARCHAR(40) NOT NULL UNIQUE,
         subject VARCHAR(60) NOT NULL,
         message TEXT(150) NOT NULL,
         referral_id VARCHAR(30) NULL
        ) $charset_collate;";
		$wpdb->query($sql2);

	}

}