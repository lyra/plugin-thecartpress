<?php
/*
Plugin Name: VadsPaymentPlugin
Plugin URI: http://www.lyra-network.com
Description: This plugin allows you to install and configure PayZen payment method for the TheCartPress
Version: 1.0d
Author: Lyra Network
Author URI: http://www.lyra-network.com
License: 
*/

#####################################################################################################
#
#					Module pour la plateforme de paiement PayZen
#						Version : 1.0d (révision 32335)
#									########################
#					Développé pour TheCartPress
#						Version : 1.0.7
#						Compatibilité plateforme : V2
#									########################
#					Développé par Lyra Network
#						http://www.lyra-network.com/
#						04/01/2012
#						Contact : support@payzen.eu
#
#####################################################################################################

require_once(WP_PLUGIN_DIR . '/thecartpress/classes/TCP_Plugin.class.php');
require_once('vads_class.php');

if(!load_plugin_textdomain('vpp', false, '/vadspaymentplugin/languages/'))
	load_plugin_textdomain('vpp', false, '/vadspaymentplugin/languages/');


class VadsPaymentPlugin extends TCP_Plugin {

	function getTitle() {
		return 'PayZen';
	}

	function getDescription() {
		return __('Configure payment method ', 'vpp').'PayZen<br>'.__('Author', 'vpp') .': <a href="http://www.lyra-network.com/" target="_blank">Lyra network</a>';
	}

	function showEditFields($data) {
		if (isset($data['vads_available_languages']) && $data['vads_available_languages'] != '') {
			$data['vads_available_languages'] = explode(';', $data['vads_available_languages']);
		} else {
			$data['vads_available_languages'] = array();
		}
		
		require_once('vads_admin_tmpl.php');
	}

	function getCheckoutMethodLabel( $instance, $shippingCountry, $shoppingCart ) {
		return 'PayZen';
	}
	
	function isApplicable($shippingCountry, $shoppingCart, $data) { 
		$amount = $shoppingCart->getTotal();
		// check order amount
		if(empty($amount)) {
			return false;
		}
		
		// if amount min / max
		if(!empty($data['vads_amount_min']) && $amount < $data['vads_amount_min']) {
			return false;
		}
    	if(!empty($data['vads_amount_max']) && $amount > $data['vads_amount_max']) {
			return false;
		}
		
		// if supported currency
		$currency = tcp_get_the_currency_iso();
		if(empty($currency) || VadsApi::findCurrencyByAlphaCode($currency) == null) {
			return false;
		}
		
		return true;
	}

	function showPayForm( $instance, $shippingCountry, $shoppingCart, $order_id ) {
		$data = tcp_get_payment_plugin_data(get_class($this), $instance);
		
		// unset non vads variables
		unset ($data['new_status']);
		unset ($data['active']);
		unset ($data['all_countries']);
		unset ($data['countries']);
		
		// create vads platform object and set admin params
		$vads = new VadsApi("UTF-8");
		$vads->setFromArray($data);		
		
		// get order info
		require_once(WP_PLUGIN_DIR .'/thecartpress/daos/Orders.class.php' );
		$order = Orders::get($order_id);
		
		// process currency
    	$currency = VadsApi::findCurrencyByAlphaCode($order->order_currency_code);
		if(! $currency) {
			_e('Payment method unavailable for this currency.', 'vpp');
			die();
		}
		
		// set order and user data
		$order_params = array(
			'vads_amount' => 100 * number_format($shoppingCart->getTotal(true), 2, '.', ''),
			'vads_currency' => $currency->num,
			'vads_contrib' => 'TheCartPress1.0.7_1.0d',
			'vads_order_id' => $order_id,
		
			'vads_cust_address' => $order->billing_street,
			'vads_cust_country' => $order->billing_country_id,
			'vads_cust_email' => $order->billing_email,
			'vads_cust_id' => $order->customer_id,
			'vads_cust_name' => $order->billing_firstname . ' ' . $order->billing_lastname,
			'vads_cust_phone' => $order->billing_telephone_1 ? $order->billing_telephone_1 : $order->billing_telephone_2,
			'vads_cust_city' => $order->billing_city,
			'vads_cust_zip' => $order->billing_postcode,
		
		    'vads_ship_to_name' => $order->shipping_firstname . ' ' . $order->shipping_lastname,
		    'vads_ship_ship_to_street' => $order->shipping_street,
		    'vads_ship_to_city' => $order->shipping_city,
		    'vads_ship_to_state' => $order->shipping_region,
		    'vads_ship_to_country' => $order->shipping_country_id,
		    'vads_ship_to_zip' => $order->shipping_postcode
		);
		$vads->setFromArray($order_params);
		
		// Store payment method and instance in vads_order_info param
		$vads->set('vads_order_info', get_class($this).'-'.$instance);
		
		require_once('vads_form_tmpl.php');
	}

	// Prepare admin params to save
	function saveEditFields( $data ) {
		$data['vads_platform_url'] = isset( $_REQUEST['vads_platform_url'] ) ? $_REQUEST['vads_platform_url'] : '';
		$data['vads_site_id'] = isset( $_REQUEST['vads_site_id'] ) ? $_REQUEST['vads_site_id'] : '';
		$data['vads_key_test'] = isset( $_REQUEST['vads_key_test'] ) ? $_REQUEST['vads_key_test'] : '';
		$data['vads_key_prod'] = isset( $_REQUEST['vads_key_prod'] ) ? $_REQUEST['vads_key_prod'] : '';
		$data['vads_ctx_mode'] = isset( $_REQUEST['vads_ctx_mode'] ) ? $_REQUEST['vads_ctx_mode'] : '';
		
		$data['vads_language'] = isset( $_REQUEST['vads_language'] ) ? $_REQUEST['vads_language'] : '';
		$data['vads_available_languages'] = isset( $_REQUEST['vads_available_languages'] ) ? implode(';', $_REQUEST['vads_available_languages']) : '';
		$data['vads_shop_name'] = isset( $_REQUEST['vads_shop_name'] ) ? $_REQUEST['vads_shop_name'] : '';
		$data['vads_shop_url'] = isset( $_REQUEST['vads_shop_url'] ) ? $_REQUEST['vads_shop_url'] : '';
		$data['vads_capture_delay'] = isset( $_REQUEST['vads_capture_delay'] ) ? $_REQUEST['vads_capture_delay'] : '';
		$data['vads_validation_mode'] = isset( $_REQUEST['vads_validation_mode'] ) ? $_REQUEST['vads_validation_mode'] : '';
		$data['vads_payment_cards'] = isset( $_REQUEST['vads_payment_cards'] ) ? $_REQUEST['vads_payment_cards'] : '';
		
		$data['vads_amount_min'] = isset( $_REQUEST['vads_amount_min'] ) ? $_REQUEST['vads_amount_min'] : '';
		$data['vads_amount_max'] = isset( $_REQUEST['vads_amount_max'] ) ? $_REQUEST['vads_amount_max'] : '';
		
		$data['vads_redirect_enabled'] = isset( $_REQUEST['vads_redirect_enabled'] ) ? $_REQUEST['vads_redirect_enabled'] : '';
		$data['vads_redirect_success_timeout'] = isset( $_REQUEST['vads_redirect_success_timeout'] ) ? $_REQUEST['vads_redirect_success_timeout'] : '';
		$data['vads_redirect_success_message'] = isset( $_REQUEST['vads_redirect_success_message'] ) ? $_REQUEST['vads_redirect_success_message'] : '';
		$data['vads_redirect_error_timeout'] = isset( $_REQUEST['vads_redirect_error_timeout'] ) ? $_REQUEST['vads_redirect_error_timeout'] : '';
		$data['vads_redirect_error_message'] = isset( $_REQUEST['vads_redirect_error_message'] ) ? $_REQUEST['vads_redirect_error_message'] : '';
		$data['vads_return_mode'] = isset( $_REQUEST['vads_return_mode'] ) ? $_REQUEST['vads_return_mode'] : '';
		$data['vads_return_get_params'] = isset( $_REQUEST['vads_return_get_params'] ) ? $_REQUEST['vads_return_get_params'] : '';
		$data['vads_return_post_params'] = isset( $_REQUEST['vads_return_post_params'] ) ? $_REQUEST['vads_return_post_params'] : '';
		$data['vads_url_return'] = isset( $_REQUEST['vads_url_return'] ) ? $_REQUEST['vads_url_return'] : '';
		
		return $data;
	}
}

// Save default values
add_option('tcp_plugins_data_pay_VadsPaymentPlugin', array(
		array(
			'active'		=> true,
			'all_countries'	=> 'yes',
			'countries'		=> array(),
			'new_status'	=> 'COMPLETED',
		
			'vads_platform_url' => 'https://secure.payzen.eu/vads-payment/',
			'vads_site_id' => '12345678',
			'vads_key_test' => '1234567890123456',
			'vads_key_prod' => '1234567890123456',
			'vads_ctx_mode' => 'TEST',
			
			'vads_language' => 'fr',
			'vads_available_languages' => '',
			'vads_shop_name' => get_option( 'blogname' ),
			'vads_shop_url' => get_option( 'siteurl' ),
			'vads_capture_delay' => '',
			'vads_validation_mode' => '',
			'vads_payment_cards' => '',
			
			'vads_amount_min' => '',
			'vads_amount_max' => '',
			
			'vads_redirect_enabled' => '1',
			'vads_redirect_success_timeout' => '5',
			'vads_redirect_success_message' => __( 'Your payment has been correctly done, you will be redirected shortly.', 'vpp' ),
			'vads_redirect_error_timeout' => '5',
			'vads_redirect_error_message' => __( 'An error has occured, you will be redirected shortly.', 'vpp' ),
			'vads_return_mode' => 'GET',
			'vads_return_get_params' => '',
			'vads_return_post_params' => '',
			'vads_url_return' => plugins_url('vadspaymentplugin/vads_notify.php')
		)
	)
);

// Register PayZen as a payment method
tcp_register_payment_plugin('VadsPaymentPlugin');
?>
