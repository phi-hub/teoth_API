<?php
    require_once 'config.php';

    

    include_once("./database/conection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="tailwincss-color.css">
    <link rel="stylesheet" href="style.css">
    <title>Payment Page</title>
    
</head>
<body>
    
    <!-- start: Payment -->
    <section class="payment-section">
        <div class="container">
            <div class="payment-wrapper">
                <div class="payment-left">
                    <div class="payment-header">
                        <div class="payment-header-icon"><i class="ri-flashlight-fill"></i></div>
                        <div class="payment-header-title">Order Summary</div>
                        <p class="payment-header-description">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                    <div class="payment-content">
                        <div class="payment-body">
                            <div class="payment-plan">
                                <div class="payment-plan-type">Pro</div>
                                <div class="payment-plan-info">
                                    <div class="payment-plan-info-name">Professional Plan</div>
                                    <div class="payment-plan-info-price">$49 per month</div>
                                </div>
                                <a href="#" class="payment-plan-change">Change</a>
                            </div>
                            <div class="payment-summary">
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">Additional fee</div>
                                    <div class="payment-summary-price">$10</div>
                                </div>
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">Discount 20%</div>
                                    <div class="payment-summary-price">-$10</div>
                                </div>
                                <div class="payment-summary-divider"></div>
                                <div class="payment-summary-item payment-summary-total">
                                    <div class="payment-summary-name">Total</div>
                                    <div class="payment-summary-price">-$10</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <form action="" class="payment-form">
                        <h1 class="payment-title">Payment Details</h1>
                        <div class="payment-method">
                            <!-- <input type="radio" name="payment-method" id="method-1" >
                            <label for="method-1" class="payment-method-item">
                                <img src="images/visa.png" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-2">
                            <label for="method-2" class="payment-method-item">
                                <img src="images/mastercard.png" alt="">
                            </label> -->
                            <input type="radio" name="payment-method" id="method-3" checked>
                            <label for="method-3" class="payment-method-item">
                                <img src="uploads/paypal.png" alt="">
                            </label>
                            <!-- <input type="radio" name="payment-method" id="method-4">
                            <label for="method-4" class="payment-method-item">
                                <img src="images/stripe.png" alt="">
                            </label> -->
                        </div>
                        <div class="payment-form-group">
                            <input type="email" placeholder=" " class="payment-form-control" id="email">
                            <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                        </div>
                        <div class="payment-form-group">
                            <input type="text" placeholder=" " class="payment-form-control" id="card-number">
                            <label for="card-number" class="payment-form-label payment-form-label-required">Card Number</label>
                        </div>
                        <div class="payment-form-group-flex">
                            <div class="payment-form-group">
                                <input type="date" placeholder=" " class="payment-form-control" id="expiry-date">
                                <label for="expiry-date" class="payment-form-label payment-form-label-required">Expiry Date</label>
                            </div>
                            <div class="payment-form-group">
                                <input type="text" placeholder=" " class="payment-form-control" id="cvv">
                                <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                            </div>
                        </div>
                        <!--    <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pay</button> -->
                        <script src="https://www.paypal.com/sdk/js?client-id=AXf8AAaom_2G5TEO8cDdwZ405uQYMWQ6Dcy_BBQEeATmCL1Ag_rKDODs0Z-OwHtZJCBhlC3IJRqz3vR2&currency=USD"></script>
                        <div id="paymentResponse" class="hidden"></div>
                        <div id="paypal-button-container"></div>
                        <script>
                            paypal.Buttons({
                                // Sets up the transaction when a payment button is clicked
                                createOrder: (data, actions) => {
                                    return actions.order.create({
                                        "purchase_units": [{
                                            "custom_id": "<?php echo $itemNumber; ?>",
                                            "description": "<?php echo $itemName; ?>",
                                            "amount": {
                                                "currency_code": "<?php echo $currency; ?>",
                                                "value": <?php echo $itemPrice; ?>,
                                                "breakdown": {
                                                    "item_total": {
                                                        "currency_code": "<?php echo $currency; ?>",
                                                        "value": <?php echo $itemPrice; ?>
                                                    }
                                                }
                                            },
                                            "items": [
                                                {
                                                    "name": "<?php echo $itemName; ?>",
                                                    "description": "<?php echo $itemName; ?>",
                                                    "unit_amount": {
                                                        "currency_code": "<?php echo $currency; ?>",
                                                        "value": <?php echo $itemPrice; ?>
                                                    },
                                                    "quantity": "1",
                                                    "category": "DIGITAL_GOODS"
                                                },
                                            ]
                                        }]
                                    });
                                },
                                // Finalize the transaction after payer approval
                                onApprove: (data, actions) => {
                                    return actions.order.capture().then(function(orderData) {
                                        setProcessing(true);

                                        var postData = {paypal_order_check: 1, order_id: orderData.id};
                                        fetch('paypal_checkout_validate.php', {
                                            method: 'POST',
                                            headers: {'Accept': 'application/json'},
                                            body: encodeFormData(postData)
                                        })
                                        .then((response) => response.json())
                                        .then((result) => {
                                            if(result.status == 1){
                                                window.location.href = "payment-status.php?checkout_ref_id="+result.ref_id;
                                            }else{
                                                const messageContainer = document.querySelector("#paymentResponse");
                                                messageContainer.classList.remove("hidden");
                                                messageContainer.textContent = result.msg;
                                                
                                                setTimeout(function () {
                                                    messageContainer.classList.add("hidden");
                                                    messageText.textContent = "";
                                                }, 5000);
                                            }
                                            setProcessing(false);
                                        })
                                        .catch(error => console.log(error));
                                    });
                                }
                            }).render('#paypal-button-container');

                            const encodeFormData = (data) => {
                            var form_data = new FormData();

                            for ( var key in data ) {
                                form_data.append(key, data[key]);
                            }
                            return form_data;   
                            }

                            // Show a loader on payment form processing
                            const setProcessing = (isProcessing) => {
                                if (isProcessing) {
                                    document.querySelector(".overlay").classList.remove("hidden");
                                } else {
                                    document.querySelector(".overlay").classList.add("hidden");
                                }
                            }    
                            </script>

                    </form>
                    <form method="post" action="checkout.php">
                        <p>T-shirt</p>
                        <p><strong>US$10.00</strong></p>
                        <button>Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Payment -->
</body>
</html>
<!-- Replace the "test" client-id value with your client-id -->

