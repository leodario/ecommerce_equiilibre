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
//$idPagarme = 're_ckb9uv43r0f0y2w6fygkamv0c'; 	 

function wc_pagarme_custom_split_rules( $data ) {	
	// Dados do pedido
        
       
 	
	$order_id = $data['metadata']['order_number'];
    $order = new WC_Order( $order_id );
    $cupom = $order->get_coupon_codes();
    $items = $order->get_items();	
    $taxaPag = $order->get_fee();
	$order_total = $order->get_total('pagarme-split');
    $total_left = $order_total;
   
   
    $idPagarme = implode("",$cupom);


    $tamanhoClinica = strlen($idPagarme);

    if($idPagarme == "" || $tamanhoClinica < 21){
        $idPagarme = "re_ckcggvblt1qknx564pj0cw6a7";
    } else{
        $idPagarme;
    }

    echo $idPagarme;

    $embaixadora_amount = intval(0);
	
    $split_rules = array();
    
    if ($idPagarme == 're_ckb9uw9r10f0jes6e03y3n8cr'){
        $idFranqueda = 're_ckb9uv43r0f0y2w6fygkamv0c';
        $embaixadora_amount = intval($order_total * 0.05 * 100);        
        $clinica_amount = intval($order_total * 0.10 * 100);                
        $total_left = ($order_total * 100) - $clinica_amount - $embaixadora_amount;      
        
        $split_rules[] = array(            
            'recipient_id' => $idFranqueda, 
            'amount' =>  $clinica_amount,  // valor em centavos
            'liable' => false, 
            'charge_processing_fee' => false,
            'free_installments' => '4',
            'max_installments' => '10',
            'interest_rate' => '3,8'
        );
        // Embaixadora
        $split_rules[] = array(
            'recipient_id' => $idPagarme, 
            'amount' =>  $embaixadora_amount,  // valor em centavos
            'liable' => false, 
            'charge_processing_fee' => false,
            'free_installments' => '4',
            'max_installments' => '10',
            'interest_rate' => '3,8'
        );
        
    } else {

        $clinica_amount = intval($order_total * 0.10 * 100);
        $total_left = ($order_total * 100) - $clinica_amount;
        $split_rules[] = array(
            'recipient_id' => $idPagarme, 
            'amount' =>  $clinica_amount,  // valor em centavos
            'liable' => false, 
            'charge_processing_fee' => false
        );
    }
	
  	
	// Recebedor principal
	// Melhoria necessária: ler uma configuração geral da loja - recebedor principal
	$recipient_id = 're_ckb9uu89b0ewdb26dux205gau'; 
	/*
    $calculateInstallments = $pagarme->transactions()->calculateInstallments([
        'amount' => $total_left,
        'free_installments' => '4',
        'max_installments' => '10',
        'interest_rate' => '3.8'
      ]);
      */

	$split_rules[] = array(
		'recipient_id' => $recipient_id, 
		'amount' => $total_left,  // valor em centavos
		'liable' => true, 
        'charge_processing_fee' => true,
        'free_installments' => '4',
        'max_installments' => '10',
        'interest_rate' => '3,8'
    );	
    

    	// Log to a WC logger
	$log = new WC_Logger();
    $log_entry = 'Teste split...' . implode(",", $split_rules);	
    $log->add( 'woocommerce-pagarme-split', $log_entry );

    var_dump($split_rules);
    
    $data['split_rules'] = $split_rules;
	return $data;

	
}

add_action( 'wc_pagarme_transaction_data', 'wc_pagarme_custom_split_rules', 10, 1 );