<html>
<head>
<title>senangPay Sample Code</title>
</head>
<body onload="document.order.submit()">
<?php
$hash_str = "236-823Otata_Diamond_Membership100.00145233";

$hash=hash_hmac('sha256', $hash_str, '236-823');
//echo $hash;
?>
    <form name="order" method="post" action="https://sandbox.senangpay.my/payment/404154564160746">
        <input type="hidden" name="detail" value="Otata_Diamond_Membership">
        <input type="hidden" name="amount" value="100.00">
        <input type="hidden" name="order_id" value="145233">
        <input type="hidden" name="name" value="Zahid Bin Zekri">
        <input type="hidden" name="email" value="zahidzekri@gmail.com">
        <input type="hidden" name="phone" value="01123218497">
        <input type="hidden" name="hash" value="<?php echo $hash ?>">
    </form>
</body>
</html>