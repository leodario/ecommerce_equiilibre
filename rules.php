<?php
/**
 * Plugin Name: Custom Split Rules - Pagar.me for WooCommerce
 * Plugin URI: 
 * Description: Custom Split Rules - Pagar.me for WooCommerce
 * Author: 
 * Author URI: 
 * Version: 1.0
 */

/**
 * Split rules for Pagar.me.
 *
 * @param  array    $data  Transacion data.
 * @return array
 */

echo json_encode( $_POST); 

 function wc_pagarme_custom_split_rules( $data ) {	
	// Dados do pedido
	
	$idClinica = $data['metadata'][0]['value']; 		
	
	$order_id = $data['metadata']['order_number'];
	$order = new WC_Order( $order_id );
	$items = $order->get_items();	
	$order_total = $order->get_total('pagarme-split');
	$total_left = $order_total;
	
	// Log to a WC logger
	//$log = new WC_Logger();
 	//$log_entry = 'Teste split...' . implode(",", $items);	
	//$log->add( 'woocommerce-pagarme-split', $log_entry );
	
	$split_rules = array();
	
	foreach ( $items as $item ) {

		$product_id = $item['product_id'];		
		
				$recipient_id = $idClinica; 
				$amount = $item['total'] * 0.25;
			
				
			
			$total_left -= $amount;  // Desconta do valor do recebedor principal.
			
			$split_rules[] = array(
				'recipient_id' => $recipient_id, 
				'amount' => $amount * 100,  // valor em centavos
				'liable' => true, 
				'charge_processing_fee' => true
			);
	
		
	}
	
	// Recebedor principal
	// Melhoria necessária: ler uma configuração geral da loja - recebedor principal
	$recipient_id = 're_ckb9uu89b0ewdb26dux205gau'; 
	$amount = $total_left;
	
	$split_rules[] = array(
		'recipient_id' => $recipient_id, 
		'amount' => $amount * 100,  // valor em centavos
		'liable' => true, 
		'charge_processing_fee' => true
	);	
	
	$data['split_rules'] = $split_rules;											 

	return $data;
}

add_action( 'wc_pagarme_checkout_data', 'wc_pagarme_custom_split_rules', 10, 1 );