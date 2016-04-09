<?php
/*
Plugin Name: Authorize.net AIM - WooCommerce Gateway
Plugin URI: 
Description: Extends WooCommerce by Adding the Authorize.net AIM Gateway.
Version: 1.0.0
Author: Shiv Prakash Tiwari
Author URI: 
*/

// Include our Gateway Class and register Payment Gateway with WooCommerce
add_action( 'plugins_loaded', 'spt_authorizenet_aim_init', 0 );
function spt_authorizenet_aim_init() {
	// If the parent WC_Payment_Gateway class doesn't exist
	// it means WooCommerce is not installed on the site
	// so do nothing
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
	
	// If we made it this far, then include our Gateway Class
	include_once( 'woocommerce-authorizenet-aim.php' );

	// Now that we have successfully included our class,
	// Lets add it too WooCommerce
	add_filter( 'woocommerce_payment_gateways', 'spt_add_authorizenet_aim_gateway' );
	function spt_add_authorizenet_aim_gateway( $methods ) {
		$methods[] = 'SPT_AuthorizeNet_AIM';
		return $methods;
	}
}

// Add custom action links
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'spt_authorizenet_aim_action_links' );
function spt_authorizenet_aim_action_links( $links ) {
	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout' ) . '">' . __( 'Settings', 'spt-authorizenet-aim' ) . '</a>',
	);

	// Merge our new link with the default ones
	return array_merge( $plugin_links, $links );	
}
?>