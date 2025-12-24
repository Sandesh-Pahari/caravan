<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to eSewa...</title>
</head>
<body>
    <form id="esewa-form" action="{{ config('services.esewa.url') }}" method="POST">
        <input type="hidden" name="tAmt" value="{{ $amount }}">
        <input type="hidden" name="amt"  value="{{ $amount }}">
        <input type="hidden" name="txAmt" value="0">
        <input type="hidden" name="psc"  value="0">
        <input type="hidden" name="pdc"  value="0">
        <input type="hidden" name="scd"  value="{{ config('services.esewa.merchant_code') }}">
        <input type="hidden" name="pid"  value="{{ $productId }}">
        <input type="hidden" name="su"   value="{{ $successUrl }}">
        <input type="hidden" name="fu"   value="{{ $failureUrl }}">
    </form>
    <script>
        document.getElementById('esewa-form').submit();
    </script>
</body>
</html>
