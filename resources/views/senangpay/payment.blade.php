<html>
<head>
<title>senangPay Sample Code</title>
</head>
<body onload="document.order.submit()">
    <form name="order" method="post" action="https://sandbox.senangpay.my/payment/404154564160746">
        <input type="hidden" name="detail" value="{{ $detail }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="order_id" value="{{ $order_id }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="phone" value="{{ $phone }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
    </form>
</body>
</html>