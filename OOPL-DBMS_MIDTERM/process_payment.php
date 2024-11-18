<?php
session_start();
include('db_connection.php');
include('PaymentMethod.php'); // Ensure you have the PaymentMethod classes defined

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $total_price = $_POST['total_price'];
    $payment_method = $_POST['payment_method'];
    $delivery_option = $_POST['delivery_option'];

    // Polymorphic behavior
    if ($payment_method === 'CreditCard') {
        $payment = new CreditCard();
    } elseif ($payment_method === 'CashOnDelivery') {
        $payment = new CashOnDelivery();
    }

    $payment->processTransaction($total_price);

    // Insert order record into database
    $stmt = $conn->prepare("INSERT INTO Orders (user_id, total_price, payment_method, delivery_option) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('idss', $user_id, $total_price, $payment_method, $delivery_option);
    $stmt->execute();

    // Clear cart after order
    $conn->query("DELETE FROM Cart WHERE user_id = $user_id");

    echo "<script>alert('Order placed successfully!'); window.location.href='menu.php';</script>";
}
?>
