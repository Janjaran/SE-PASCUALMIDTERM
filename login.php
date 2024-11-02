<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = loginUser ($pdo, $username, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: index.php");
        exit(); 
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="POST">
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </p>
        <input type="submit" name="loginBtn" value="Login">
    </form>
    
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>

