<?php
abstract class PaymentMethod {
    /**
     
     * @param float $amount The total amount to process.
     */
    abstract public function processTransaction($amount);
}

// Define the CreditCard payment class
class CreditCard extends PaymentMethod {
    /**
     * Process a credit card payment.
     * @param float $amount The total amount to process.
     */
    public function processTransaction($amount) {
        echo "Processing a credit card payment of $" . number_format($amount, 2) . ".<br>";
        // You can add additional credit card-specific logic here
    }
}

// Define the CashOnDelivery payment class
class CashOnDelivery extends PaymentMethod {
    /**
     * Process a cash-on-delivery payment.
     * @param float $amount The total amount to process.
     */
    public function processTransaction($amount) {
        echo "Processing a cash-on-delivery payment of $" . number_format($amount, 2) . ".<br>";
       
    }
}
?>
