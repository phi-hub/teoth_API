<?php 
// Include the configuration file 
require_once 'config.php';
 
// Include the database connection file 
include_once("./database/conection.php");

// Include the PayPal API library 
require_once 'PaypalCheckout.class.php'; 
$paypal = new PaypalCheckout; 
 
$response = array('status' => 0, 'msg' => 'Transaction Failed!'); 
if(!empty($_POST['paypal_order_check']) && !empty($_POST['order_id'])){ 
    // Validate and get order details with PayPal API 
    try {  
        $order = $paypal->validate($_POST['order_id']); 
    } catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(!empty($order)){ 
        $order_id = $order['transactionID']; 
        $intent = $order['intent']; 
        $order_status = $order['status']; 
        $order_time = date("Y-m-d H:i:s", strtotime($order['create_time'])); 
 
        if(!empty($order['purchase_units'][0])){ 
            $purchase_unit = $order['purchase_units'][0]; 
 
            $item_number = $purchase_unit['custom_id']; 
            $item_name = $purchase_unit['description']; 
             
            if(!empty($purchase_unit['amount'])){ 
                $currency_code = $purchase_unit['amount']['currency_code']; 
                $amount_value = $purchase_unit['amount']['value']; 
            } 
 
            if(!empty($purchase_unit['payments']['captures'][0])){ 
                $payment_capture = $purchase_unit['payments']['captures'][0]; 
                $transaction_id = $payment_capture['id']; 
                $payment_status = $payment_capture['status']; 
            } 
 
            if(!empty($purchase_unit['payee'])){ 
                $payee = $purchase_unit['payee']; 
                $payee_email_address = $payee['email_address']; 
                $merchant_id = $payee['merchant_id']; 
            } 
        } 
 
        $payment_source = ''; 
        if(!empty($order['payment_source'])){ 
            foreach($order['payment_source'] as $key=>$value){ 
                $payment_source = $key; 
            } 
        } 
 
      
        if(!empty($order_id) && $order_status == 'COMPLETED'){ 

            // Insert transaction data into the database 
            $sqlQ = "INSERT INTO transactions (createAt, amount, userID) VALUES ('$order_time', '$amount_value', '$itemPrice')"; 
            $result = $dbConn->exec($sqlQ); 
                
            if(!empty($payment_id)){ 
                $ref_id_enc = base64_encode($transaction_id); 
                $response = array('status' => 1, 'msg' => 'Transaction completed!', 'ref_id' => $ref_id_enc); 
            } 
        } 
    }else{ 
        $response['msg'] = $api_error; 
    } 
} 
echo json_encode($response); 
?>