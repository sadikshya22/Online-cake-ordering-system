<?php
require('stripe-php-master/init.php');

$publishableKey = "pk_test_51NQkugC8xqRNwIOSyijLeKMlRxOoykevWdB6LMJqWXu8z7N6hKgJR6MiVcVEWK4IglBfmH7Lq9mjnMnkxl4VfxOp00K6fTOjSV";

$secretKey = "sk_test_51NQkugC8xqRNwIOSbyWbU1NFU4U12ICl8X3U7G3YeCeyTxOD2UWnxAWBM0ba8Ue9ac9j3wSSZiYWGvgKRJn1o22e00gGbfJIqV";

\Stripe\Stripe::setApiKey($secretKey);
?>
