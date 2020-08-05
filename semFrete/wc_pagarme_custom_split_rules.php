<?php

/**
 * Plugin Name: Custom Split Rules - Pagar.me for WooCommerce
 * Plugin URI: 
 * Description: Custom Split Rules - Pagar.me for WooCommerce
 * Author: Leodário * 
 * Version: 1.0
 */

/**
 * Split rules for Pagar.me. 
 * @param  array    $data  Transacion data.
 * @return array
 */


function wc_pagarme_custom_split_rules($data)
{
    // Dados do pedido
    //$idPagarme = 're_ckb9uv43r0f0y2w6fygkamv0c'; 	    

    $order_id = $data['metadata']['order_number'];
    $order = new WC_Order($order_id);
    $cupom = $order->get_coupon_codes(); // pego o cupom de desconto  
    $items = $order->get_items();
    $order_total = $order->get_total('pagarme-split'); // pego o total da venda
    $order_subtotal = $order->get_subtotal('pagarme-split'); // pego o subtoral da venda
    $order_desconto = $order->get_discount_total(); // pego o valor do desconto
    
    $idPagarme = implode("", $cupom); // transformo em string
    $tamanhoClinica = strlen($idPagarme); // conto a quantidade de caracteres
    
    // verifica se existe desconto
    if($order_desconto > 0){
        // se existe transformo em inteiro 
        $order_desconto_10 = intval($order_desconto * 100); 
    } else {
        // caso contrário recebe zero
        $order_desconto_10 = intval(0);
    }

    // transformo em centavos o subtotal 
    $order_subtotal_10 = intval($order_subtotal * 100); 
    // pego o valor de vendo já descontando o valor do cupom de desconto     
    $order_diferenca = $order_subtotal_10 - $order_desconto_10; 
        

    // re_ckcggvblt1qknx564pj0cw6a7 (teste)
    if ($idPagarme == "" || $tamanhoClinica < 21) {
        $idPagarme = "re_ckcggvblt1qknx564pj0cw6a7";
    } else {
        $idPagarme;
    }

    echo $idPagarme;

    $embaixadora_amount = intval(0);

    $split_rules = array();

    // quando for embaixadora da marca, buscar melhoria neste código
    if ($idPagarme == 're_ckb9uw9r10f0jes6e03y3n8cr') {
        $idFranqueda = 're_ckb9uv43r0f0y2w6fygkamv0c';
        $embaixadora_amount = intval($order_total * 0.05 * 100);
        $clinica_amount = intval($order_total * 0.10 * 100);
        $total_left = ($order_total * 100) - $clinica_amount - $embaixadora_amount;

        $split_rules[] = array(
            'recipient_id' => $idFranqueda,
            'amount' =>  $clinica_amount,  // valor em centavos
            'liable' => false,
            'charge_processing_fee' => false
        );
        // Embaixadora
        $split_rules[] = array(
            'recipient_id' => $idPagarme,
            'amount' =>  $embaixadora_amount,  // valor em centavos
            'liable' => false,
            'charge_processing_fee' => false
        );
    } else {
        // split com dois autores
        $clinica_amount = intval($order_diferenca * 0.15);
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
    $recipient_id = 're_ckb9psk961f97wm63vzhpfqob';  	
    // re_ckb9uu89b0ewdb26dux205gau (teste)

    $split_rules[] = array(
        'recipient_id' => $recipient_id,
        'amount' => $total_left,  // valor em centavos
        'liable' => true,
        'charge_processing_fee' => true
    );


    // Log to a WC logger
    $log = new WC_Logger();
    $log_entry = 'Teste split...' . implode(",", $split_rules);
    $log->add('woocommerce-pagarme-split', $log_entry);


    $data['split_rules'] = $split_rules;
    return $data;
}

add_action('wc_pagarme_transaction_data', 'wc_pagarme_custom_split_rules', 10, 1);
