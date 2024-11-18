<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        header('Location: menu.php');
    } else {
        echo "<script>alert('Invalid username or password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required class="form-control">
            <input type="password" name="password" placeholder="Password" required class="form-control mt-2">
            <button type="submit" class="btn btn-primary mt-2">Login</button>
        </form>
    </div>
</body>
</html>
