<html>
<head>
<title>senangPay Sample Code</title>
</head>
<body onload="document.order.submit()">
<?php

?>
    <form name="order" method="post" action="https://api.senangpay.my/recurring/payment/706163516489647">
        <input type="hidden" name="recurring_id" value="{{ $recurring_id }}">
        <input type="hidden" name="order_id" value="{{ $order_id }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="phone" value="{{ $phone }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
    </form>
</body>
</html>