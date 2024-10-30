<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.ibsofts.com
 * @since      1.0.0
 *
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/public
 * @author     iB ARts Pvt. Ltd. <support@ibarts.in>
 */
class Ib_Refer_Me_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ib-refer-me-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

        wp_register_script( 'ajaxHandle', plugins_url('js/refer_me.js', __FILE__), array(), false, true );
        wp_enqueue_script( 'ajaxHandle' );
        wp_localize_script('ajaxHandle','ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
	
	public function register_shortcodes(){
	    add_shortcode('ib_referral_form',array($this,'ib_custom_form'));
		add_shortcode( 'ib_contact_form', array($this,'cf_shortcode') );
	}
	
	public function ib_custom_form(){
	    ob_start();
	    require plugin_dir_path(__FILE__).'partials/ib-refer-me-public-display.php';
        $output = ob_get_clean( );
        return $output;
        ob_flush();
	}
	public function cf_shortcode() {
		ob_start();
	    require plugin_dir_path(__FILE__).'partials/contact-form.php';
        $output = ob_get_clean( );
        return $output;
        ob_flush();
	}
	public function ib_action(){
	    global $wpdb;
	    $reference_id = uniqid();
	    $name = sanitize_text_field( $_POST['name']);
	    $email = sanitize_text_field( $_POST['email']);
	    $url = home_url();
	    $table = $wpdb->prefix.'ib_referral';
        
        $checkemail = $wpdb->get_var( $wpdb->prepare( 'SELECT email FROM '. $wpdb->prefix.'ib_referral WHERE email = %s', $email ) );

        if ($checkemail == $email){
	        $results=$wpdb->get_results($wpdb->prepare( 'SELECT reference_id FROM '. $wpdb->prefix.'ib_referral WHERE email = %s', $email ));
	        $reference_id=$results->reference_id;
	        $ref_url = $url.'/contact?referral_id='.$results[0]->reference_id;
	        echo esc_url( $ref_url );
        }
        else {
            $wpdb->query( $wpdb->prepare( 'INSERT INTO '. $wpdb->prefix.'ib_referral ( name, email, reference_id ) VALUES ( %s, %s, %s )', $name, $email, $reference_id ) );
            
            $ref_url = $url.'/contact?referral_id='.$reference_id;
            echo esc_url( $ref_url );
        }
	    wp_die();
	}
	
	public function ib_contact_action(){
	    global $wpdb;
	    $table = $wpdb->prefix.'ib_referral';
	    $table2 = $wpdb->prefix.'ib_contact_form';
	    $name = sanitize_text_field( $_POST['name'] );
	    $email = sanitize_text_field( $_POST['email'] );
	    $subject = sanitize_text_field( $_POST['subject'] );
	    $message = sanitize_textarea_field( $_POST['message'] );
	    $referral_id = sanitize_text_field( $_POST['referral_id'] );
	    
        $checkstatus = $wpdb->get_results($wpdb->prepare( 'SELECT status FROM '. $wpdb->prefix.'ib_referral WHERE reference_id = %s', $referral_id ));
        if ($checkstatus != 'Claimed'){
            $checkreferral = $referral_id;
        }
        else{
            $checkreferral = '';
        }
        
        $checkstatus2 = $wpdb->get_results($wpdb->prepare( 'SELECT referral_id FROM '. $wpdb->prefix.'ib_contact_form WHERE referral_id = %s', $checkreferral ));
        
        if (empty($checkstatus2[0]->referral_id)){
            $my_referral_id = $referral_id;
        }
        else{
            $my_referral_id = NULL;
        }
            
        $checkemail = $wpdb->get_var( $wpdb->prepare( 'SELECT email FROM '. $wpdb->prefix.'ib_contact_form WHERE email = %s', $email ) );
        if ( empty($checkemail) || $checkemail != $email ) {
            // Saving Contact Form into Database
            $wpdb->query(
                $wpdb->prepare(
                    'INSERT INTO '. $wpdb->prefix.'ib_contact_form 
                    ( name, email, subject, message, referral_id ) 
                    VALUES ( %s, %s, %s, %s, %s )',
                    $name, $email, $subject, $message, $my_referral_id 
                ) 
            );

            // Sending Mail
    	    $headers = $name . "<" . $email . ">";
            $to = get_option( 'admin_email' );
            $msg = "Hello! Admin"."\n"."A new contact request has submitted with the following information."."\n"."Name: $name"."\n"."E-mail: $email"."\n"."Subject: $subject"."\n"."Message: $message"." \n\n"."This is a Contact Confirmation mail sent via WordPress.";
            if ( wp_mail( $to, $subject, $msg, $headers ) ) {
                print "<p class='success'>Thanks for contacting us, expect a response soon !</p>";
            } else {
                print "<p class='error'>An unexpected error occurred</p>";
            }
            
            // Updating Referral Status
            if (isset($_POST['referral_id'])){
                $checkreferral = sanitize_text_field( $_POST['referral_id'] );
                global $wpdb;
        	    $table=$wpdb->prefix.'ib_referral';
    	        $results=$wpdb->get_results(
    	            $wpdb->get_results(
        	            $wpdb->prepare(
        	                'SELECT status FROM '. $wpdb->prefix.'ib_referral 
        	                WHERE reference_id = %s',
        	                $checkreferral 
    	                )
	                )
                );
        	    if($results[0]->status != 'Claimed'){
        	        $wpdb->update( $table, array( 'status' => 'Claimed'), array( 'reference_id' => $checkreferral ) );
        	    } 
            }
        }
        else{
            print "<p class='error'>Email already exist!</p>";
        }

	   wp_die();
	}
}