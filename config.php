<?php 
 
// Product Details 
$itemNumber = "DP12345"; 
$itemName = "Demo Product"; 
$itemPrice = 1;  
$currency = "USD"; 
 
/* PayPal REST API configuration 
 * You can generate API credentials from the PayPal developer panel. 
 * See your keys here: https://developer.paypal.com/dashboard/ 
 */ 
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'AXf8AAaom_2G5TEO8cDdwZ405uQYMWQ6Dcy_BBQEeATmCL1Ag_rKDODs0Z-OwHtZJCBhlC3IJRqz3vR2'); 
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'EJH1KHpxW5RJMQJw5Xbz88imjU71bVoH8UE2w9Cf31CXAtORLPhXDc8a_pqPc82XeGj5tb1qBIlEw_5e'); 
define('PAYPAL_PROD_CLIENT_ID', ''); 
define('PAYPAL_PROD_CLIENT_SECRET', ''); 
  
// Database configuration  
define('DB_HOST', '127.0.0.1:1234');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'teoth'); 
 
?>