<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT MenuItems.name, MenuItems.price, Cart.quantity 
                        FROM Cart JOIN MenuItems ON Cart.item_id = MenuItems.item_id 
                        WHERE Cart.user_id = $user_id");

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Checkout</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>₱<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                    </tr>
                    <?php $total_price += $row['price'] * $row['quantity']; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h4>Total: ₱<?php echo number_format($total_price, 2); ?></h4>
        <form action="process_payment.php" method="POST">
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" class="form-control">
                <option value="CreditCard">Credit Card</option>
                <option value="CashOnDelivery">Cash on Delivery</option>
            </select>
            <label for="delivery_option" class="mt-2">Delivery Option:</label>
            <select name="delivery_option" class="form-control">
                <option value="Food Panda">Food Panda</option>
                <option value="Epcst Delivery">Epcst Rider</option>
            </select>
            <button type="submit" class="btn btn-success mt-2">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
