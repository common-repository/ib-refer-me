<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.ibsofts.com
 * @since      1.0.0
 *
 * @package    Ib_Refer_Me
 * @subpackage Ib_Refer_Me/admin/partials
 */
 global $wpdb;
 $result = $wpdb->get_results($wpdb->prepare( 'SELECT * FROM '. $wpdb->prefix.'ib_referral' ));
 if($result==0){
     echo"No Results Found.";
 }
 
 $copy_ref_code = 'withJquery();';
 $copy_cf_code = 'withJqueryCF();';
?>
<div class="ib_referral_header">
    <h2>Referral System</h2>
</div>
<div class="ib-ref-container">
	<ul class="ib-ref-tabs">
		<li class="ref-tab-link current" data-tab="tab-1">Entries</li>
		<li class="ref-tab-link" data-tab="tab-2">Instructions</li>
	</ul>
	<div id="tab-1" class="ref-tab-content current">
        <div style="overflow-x:auto;" class="ib_reference_table">
          <table class="table">
            <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Reference Id</th>
                  <th scope="col">Time</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($result as $list) { ?>
                <tr>
                  <th scope="row"><?php echo esc_attr($list->id); ?></th>
                  <td><?php echo esc_attr($list->name); ?></td>
                  <td><?php echo esc_attr($list->email); ?></td>
                  <td><?php echo esc_attr($list->reference_id); ?></td>
                  <td><?php echo esc_attr($list->date); ?></td>
                  <?php if($list->status=="Claimed") { $class="ib_claimed"; } else { $class="ib_pending"; } ?>
                  <td class="<?php echo esc_attr( $class ); ?>"><?php echo esc_attr($list->status); ?></td>
                </tr>
                <?php } ?>
              </tbody>
          </table>
        </div>
	</div>
	<div id="tab-2" class="ref-tab-content">
	    <p class="ib_about_content">You will get a shortcode named as 
	        <a href="#" class="copy-text" onclick="<?php echo esc_js( $copy_ref_code ); ?>" >[ib_referral_form]</a>
	            to  generate a unique referral id everytime you fill the form.</br>
                To import Contact Form use this Shortcode <a href="#" class="copy-text-cf" onclick="<?php echo esc_js( $copy_cf_code ); ?>" >[ib_contact_form]
            </a>
        </p>
        <h5 class="ib-inst-heading">
            Instructions to use referral system:
        </h5>
        <ul class="ref-instruction-ul">
            <li class="ref-instruction-li">Firstly import referral shortcode [ib_referral_form] on desired page.</li>
            <li class="ref-instruction-li">Then create a contact page and use our contact Form shortcode [ib_contact_form] .</li>
            <li class="ref-instruction-li">Now we can fill Referral form and submit it.</li>
            <li class="ref-instruction-li">Then a popup will appear having unique referral link.</li>
            <li class="ref-instruction-li">You can simply open that link or copy or share to use it later.</li>
            <li class="ref-instruction-li">By clicking that link it will open contact page with our contact form with hidden referral ID.</li>
        </ul>
	</div>
</div>
<script>

</script>