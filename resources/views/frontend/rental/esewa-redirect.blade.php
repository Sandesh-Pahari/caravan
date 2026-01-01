<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to eSewa...</title>
</head>
<body>
    {{-- eSewa v2 payment form — auto-submitted on load --}}
    <form id="esewa-form" action="{{ config('services.esewa.url') }}" method="POST">
        <input type="hidden" name="amount"                   value="{{ $amount }}">
        <input type="hidden" name="tax_amount"               value="0">
        <input type="hidden" name="total_amount"             value="{{ $amount }}">
        <input type="hidden" name="transaction_uuid"         value="{{ $transactionUuid }}">
        <input type="hidden" name="product_code"             value="{{ $productCode }}">
        <input type="hidden" name="product_service_charge"   value="0">
        <input type="hidden" name="product_delivery_charge"  value="0">
        <input type="hidden" name="success_url"              value="{{ $successUrl }}">
        <input type="hidden" name="failure_url"              value="{{ $failureUrl }}">
        <input type="hidden" name="signed_field_names"       value="{{ $signedFieldNames }}">
        <input type="hidden" name="signature"                value="{{ $signature }}">
    </form>
    <script>
        document.getElementById('esewa-form').submit();
    </script>
</body>
</html>
