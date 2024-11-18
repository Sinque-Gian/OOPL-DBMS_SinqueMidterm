<?php
session_start();
include('db_connection.php');

if (isset($_POST['item_id']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $item_id = $_POST['item_id'];

    $stmt = $conn->prepare("INSERT INTO Cart (user_id, item_id, quantity) VALUES (?, ?, 1)");
    $stmt->bind_param('ii', $user_id, $item_id);
    $stmt->execute();

    header('Location: menu.php');
}
?>
