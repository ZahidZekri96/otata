<html>
<body onload="document.order.submit()">
    <form name="order" method="post" action="{{ route('senangpay.return.add') }}}">
        <input type="hidden" name="order_id" value="<?php echo $_GET['order_id'] ?>">
        <input type="hidden" name="transaction_id" value="<?php echo $_GET['transaction_id'] ?>">
    </form>
</body>
</html>