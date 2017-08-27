<?php
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

$wordpress_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/';

require_once($wordpress_path . '/wp-load.php' );
require_once($wordpress_path . 'wp-content/plugins/thecartpress/classes/TCP_Plugin.class.php');

require_once('vads_class.php');

$payment_method = explode('-', $_REQUEST['vads_order_info']); // method_name#instance
$admin_data = tcp_get_payment_plugin_data($payment_method[0], $payment_method[1]);

$vads = new VadsApi();
$resp = $vads->getResponse($_REQUEST, $admin_data['vads_ctx_mode'], $admin_data['vads_key_test'], $admin_data['vads_key_prod']);

$from_server = $resp->get('hash') != null;

if(!$resp->isAuthentified()){
	if ($from_server) {
		die($resp->getOutputForGateway('auth_fail'));
	}
	
	wp_redirect(home_url());
}

$order_id = $resp->get('order_id');

$order = Orders::get($order_id);
// Order not found
if(!$order) {
	if ($from_server) {
		die($resp->getOutputForGateway('order_not_found'));
	}
	
	wp_redirect(get_permalink(get_option('tcp_checkout_page_id')));
}

require_once($wordpress_path . 'wp-content/plugins/thecartpress/daos/Orders.class.php' );
require_once($wordpress_path . 'wp-content/plugins/thecartpress/shortcodes/Checkout.class.php');

// prepare response message
$msg = $resp->message;
		
if(!empty($resp->extraMessage)) {
	$msg .= '. '.$resp->extraMessage;
}
if(!empty($resp->authMessage)) {
	$msg .= '. '.$resp->authMessage;
}	
if(!empty($resp->warrantyMessage)) {
   	$msg .= '. '.$resp->warrantyMessage;
}

if($order->status == Orders::$ORDER_PENDING) { // Order not processed yet
	if($resp->isAcceptedPayment()) {
		if (Orders::isDownloadable($order_id)) {
			Orders::editStatus($order_id, Orders::$ORDER_COMPLETED, $msg);
		} else {
			Orders::editStatus($order_id, $admin_data['new_status'], $msg);
		}
		
		Checkout::sendMails($order_id);
		
		if ($from_server) {
			die ($resp->getOutputForGateway('payment_ok'));
		} 
		
		wp_redirect(add_query_arg('tcp_checkout', 'ok', get_permalink(get_option('tcp_checkout_page_id'))));
	} else {
		Orders::editStatus($order_id, Orders::$ORDER_CANCELLED, $msg);
		
		if ($from_server) {
			die($resp->getOutputForGateway('payment_ko'));
		}
		
		wp_redirect(get_permalink(get_option('tcp_checkout_page_id')));
	}
} else {
	if($resp->isAcceptedPayment()) {
		if ($from_server) {
			die ($resp->getOutputForGateway('payment_ok_already_done'));
		} 
		
		wp_redirect(add_query_arg('tcp_checkout', 'ok', get_permalink(get_option('tcp_checkout_page_id'))));
	} else {
		if ($from_server) {
			die($resp->getOutputForGateway('payment_ko_on_order_ok'));
		}
		
		wp_redirect(get_permalink(get_option('tcp_checkout_page_id')));
	}
}
?>
