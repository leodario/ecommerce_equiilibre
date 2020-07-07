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


function wc_pagarme_custom_split_rules( $data ) {	
	// Dados do pedido
        
    //$idClinica = 're_ckb9uv43r0f0y2w6fygkamv0c'; 	
    
    

	
	$order_id = $data['metadata']['order_number'];
    $order = new WC_Order( $order_id );
    $cupom = $order->get_coupon_codes();
	$items = $order->get_items();	
	$order_total = $order->get_total('pagarme-split');
	$total_left = $order_total;
    //$idClinica = wp_sprintf('%l.',$cupom );
    $idClinica = implode("",$cupom);

    if($idClinica == ""){
        $idClinica = "re_ckcb0tqg900ixuz6det7q2qsc";
    } else{
        $idClinica;
    }

    echo $idClinica;
	
	$split_rules = array();

	
            $clinica_amount = intval($order_total * 0.10 * 100);
            $total_left = ($order_total * 100) - $clinica_amount;
			$split_rules[] = array(
				'recipient_id' => $idClinica, 
				'amount' =>  $clinica_amount,  // valor em centavos
				'liable' => true, 
				'charge_processing_fee' => true
			);
	
		
	
	
	// Recebedor principal
	// Melhoria necessária: ler uma configuração geral da loja - recebedor principal
	$recipient_id = 're_ckb9uu89b0ewdb26dux205gau'; 
	
	
	$split_rules[] = array(
		'recipient_id' => $recipient_id, 
		'amount' => $total_left,  // valor em centavos
		'liable' => true, 
		'charge_processing_fee' => true
    );	
    

    	// Log to a WC logger
	$log = new WC_Logger();
    $log_entry = 'Teste split...' . implode(",", $split_rules);	
    $log->add( 'woocommerce-pagarme-split', $log_entry );

    if($split_rules == null || $split_rules == 'NaN' || $split_rules == false || $split_rules == 'undefined' || !$split_rules ){
        $split_rules[] = array(
            'recipient_id' => "re_ckcb0tqg900ixuz6det7q2qsc", 
            'amount' => $total_left,  // valor em centavos
            'liable' => true, 
            'charge_processing_fee' => true
        );	
        return $data;
    } else{
        $data['split_rules'] = $split_rules;
	    return $data;
    }
	
	
}

add_action( 'wc_pagarme_transaction_data', 'wc_pagarme_custom_split_rules', 10, 1 );