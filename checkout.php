<?php

    // $endpoint_secret = 'whsec_...';

    // $payload = @file_get_contents('php://input');

    //$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    
    //$event = null;

    

    require __DIR__ . "/vendor/autoload.php";

    include_once("./database/conection.php");
    $result = $dbConn->query("SELECT userID, username, email, available, balance FROM users");
    $row = $result->fetch(PDO::FETCH_ASSOC);

    $stripe_secret_key = "sk_test_51Ol191CY72Of0n7KQ39TjIOicyLddu4oN8IcgqhKzQV2TvJKK3ttiVNGhEPkJ8kxj36Jbz5POVWiKsZL77oDgtNg00PDmV6AYb";

    \Stripe\Stripe::setApiKey($stripe_secret_key);

    $tensp = $_POST['ten'];
    $giasp = $_POST['gia'];
    $oldbalance = $row['balance'];
    $balance = $oldbalance + $giasp;
    $userID = 1;

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/success.php",
        "cancel_url" => "http://localhost/index.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "vnd",
                    "unit_amount" => $giasp,
                    "product_data" => [
                        "name" => $tensp
                    ]
                ]
            ]
        ]
    ]);

    //$stripe = new \Stripe\StripeClient('sk_test_51Ol191CY72Of0n7KQ39TjIOicyLddu4oN8IcgqhKzQV2TvJKK3ttiVNGhEPkJ8kxj36Jbz5POVWiKsZL77oDgtNg00PDmV6AYb');
    // $event = \Stripe\Webhook::constructEvent(
    //     $payload, $sig_header, $endpoint_secret
    // );

     $statut = \Stripe\PaymentIntent::STATUS_SUCCEEDED;
    if ($statut) {

        $query = "INSERT INTO transactions SET amount = '$giasp', userID = '$userID'";
        $stmt = $dbConn->prepare($query);
        $stmt->execute();

        $wery = "UPDATE users SET balance = '$balance' WHERE userID = '$userID' ";
        $stmt = $dbConn->prepare($wery);
        $stmt->execute();

        http_response_code(200);
        exit();
    }
    
    http_response_code(303);
    header("Location: " . $checkout_session->url);