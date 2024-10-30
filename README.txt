=== IB Refer Me ===
Contributors: ibartsltd, laddoo
Author URI: https://www.ibsofts.com
Plugin URI: https://products.ibarts.in/wp-plugins/ib-refer-me
Donate link: https://paypal.me/ibartsltd
Tags: referral_id, referral plugin, refer, referral link, claim referral
Requires at least: 3.0.1
Tested up to: 6.1.1
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Get a Referral link by submitting a simple Referral Form.

== Description ==

This plugin gives you two shortcodes to implement in the website. 
> * Referral Form Layout - `[ib_referral_form]` 
> * Simple Custom Form - `[ib_contact_form]` Comes with a hidden Referral ID. 

It tracks all referral entries in the backend.

### How to use

The referral system can be used as follows:
 * **Step 1:** Begin with importing the referral shortcode `[ib_referral_form]` on the desired page.
 * **Step 2:** Create a contact page and use our contact form shortcode `[ib_contact_form]`.
 * **Step 3:** Fill Referral form and submit it.
 * **Step 4:** A popup will appear having the unique referral link. This can be simply opened or copied or shared later.
 * **Step 5:** Clicking the link will open the contact page with our contact form with a hidden referral ID.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `ib-refer-me.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= Is the referral ID unique every time? =

Yes, each time a unique user submits a referral form, a unique referral ID is generated.

= How many times can a referral ID be claimed? =

It can be claimed only once.

= Can I customise the plugin? =

Yes, you can certainly customise the plugin to suit your needs. You only need to submit a request to our email id or contact us.

= Is the plugin free? =

Yes, the plugin is absolutely free.

= Still have a query? =

If you still have any queries you can send the query to [support@ibsofts.com] (mailto:support@ibsofts.com)  email id, and we will be happy to help you.


== Screenshots ==

1. Submitting Referral Form.
2. After Submitting Referral Form Popup screen.
3. Contact Form screen.
4. After the Submission success message screen.

== Changelog ==

= 1.0 =
* Custom Simple Form with referral ID as a hidden input. 
* Change in UI of Form and Popup screen.

= 0.5 =
* Referral form with simple popup screen.

== Upgrade Notice ==

= 1.0 =
This will enhance user compatibility for different devices.

= 0.5 =
This version fixes a security-related bug.  Upgrade immediately.