<?php
global $wpdb;
$table = $wpdb->prefix.'ib_referral';
$checkreferral2 = isset($_GET['referral_id']) ? sanitize_text_field( $_GET['referral_id'] ) : '';

$checkstatus = $wpdb->get_var( $wpdb->prepare( 'SELECT status FROM '. $wpdb->prefix.'ib_referral WHERE reference_id = %s', $checkreferral2 ) );

if ($checkstatus != 'Claimed'){
    $checkreferral = isset($_GET['referral_id']) ? sanitize_text_field( $_GET['referral_id'] ) : '';
}
else{
    $checkreferral = NULL;
}

 ?>
<style>
     .ib-ref-form fieldset input, .ib-ref-form fieldset textarea {
        padding: 12px;
        margin-bottom: 0;
     }
     .ib-ref-form label {
         display: block;
         margin-bottom: 3px;
     }
    .ib-ref-form .error {
    	background-color: #dc3545;
        border: #dc3545 1px solid;
    	padding: 5px 10px;
    	color: #FFFFFF;
    	border-radius: 4px;
    	margin-bottom: 10px;
    }
    .ib-ref-form .success {
    	background-color: #15c39a;
        border: #11a683 1px solid;
    	padding: 5px 10px;
    	color: #FFFFFF;
    	border-radius: 4px;
    	margin-bottom: 10px;
    }
    .ib-ref-form .info {
    	font-size: 14px;
        color: #f42e2e;
        letter-spacing: 2px;
        padding-left: 5px;
        margin-bottom: 10px;
    }
</style>

<form action="#" id="ib-ref-form" class="ib-ref-form">
    <div id="mail-status"></div>
    <fieldset>
       <label for="name">Full Name:<span class="ib-req">*</span></label>
       <input type="text" id="name" name="name" placeholder="Full Name" pattern="[a-zA-Z0-9 ]+" value="">
       <span id="name-info" class="info"></span>

       <label for="email">Email Address:<span class="ib-req">*</span></label>
       <input type="email" id="email" name="email" placeholder="Enter your email">
       <span id="email-info" class="info"></span>

        <label for="subject"> Subject: <span class="ib-req">*</span></label>
        <input type="text" name="subject" id="subject" placeholder="Enter your subject" class="" pattern="[a-zA-Z ]+" value=""/>
        <span id="subject-info" class="info"></span>

        <label for="message"> Message: <span class="ib-req">*</span></label>
        <textarea rows="4" name="message" id="message" placeholder="Type your message" class=""></textarea>
        <span id="message-info" class="info"></span>

        <input type="hidden" id="referral_id" name="referral_id" value="<?php echo esc_html( $checkreferral ); ?>">
    </fieldset>
    <button type="submit" name="submit" id="submit" class="form-btn">Submit</button>
</form>