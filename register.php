<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (isset($_POST['registerBtn'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    if (registerUser($pdo, $first_name, $last_name, $address, $age, $username, $password)) {
        header("Location: login.php");
        exit(); 
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="POST">
        <p>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required>
        </p>
        <p>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required>
        </p>
        <p>
            <label for="address">Address:</label>
            <input type="text" name="address" required>
        </p>
        <p>
            <label for="age">Age:</label>
            <input type="number" name="age" required>
        </p>
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </p>
        <input type="submit" name="registerBtn" value="Register">
    </form>
</body>
</html>
