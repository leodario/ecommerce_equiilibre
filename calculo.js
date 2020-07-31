$embaixadora_amount = intval($order_total * 0.05 * 100);        
$clinica_amount = intval($order_total * 0.10 * 100);                
$total_left = ($order_total * 100) - $clinica_amount - $embaixadora_amount;    


let valorTotal = 1790

let embaixador = parseInt(valorTotal * 0.2623 * 100);
let clinica = parseInt(valorTotal * 0.88 * 100);
let brands = parseInt(valorTotal * 100) - embaixador - clinica;

console.log(brands);

console.log(brands + embaixador + clinica);