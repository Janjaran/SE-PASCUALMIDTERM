<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 

$user = getUserById($pdo, $user_id); 

if (isset($_POST['insertMemberBtn'])) {
    $memberName = $_POST['member_name']; 
    $email = $_POST['email']; 
    $phoneNumber = $_POST['phone_number']; 

    if (insertMember($pdo, $memberName, $email, $phoneNumber, $user_id)) {
        header("Location: index.php");
        exit(); 
    } 
}

if (isset($_POST['logoutBtn'])) {
    session_destroy(); 
    header("Location: login.php"); 
    exit(); 
}

$members = getAllMembers($pdo); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to Gaming Esports Hub - Player Registration Form!</h1>

    <h2>Your Information</h2>
    <p>Name: <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
    <p>Address: <?php echo htmlspecialchars($user['address']); ?></p>
    <p>Age: <?php echo htmlspecialchars($user['age']); ?></p>

    <br>
    <h2>Register player here!</h2>
    <form action="" method="POST">
        <p>
            <label for="member_name">Player Name:</label>
            <input type="text" name="member_name" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </p>
        <p>
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" required>
        </p>
        <input type="submit" name="insertMemberBtn" value="Add Member">
    </form>

    <h2>All Members</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Player Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>   
        <?php foreach ($members as $member) { ?>
            <tr>
                <td><?php echo htmlspecialchars($member['member_id']); ?></td>
                <td><?php echo htmlspecialchars($member['member_name']); ?></td>
                <td><?php echo htmlspecialchars($member['email']); ?></td>
                <td><?php echo htmlspecialchars($member['phone_number']); ?></td>
                <td>
                    <a href="viewgames.php?member_id=<?php echo $member['member_id']; ?>">View Games</a>
                    <a href="editmember.php?member_id=<?php echo $member['member_id']; ?>">Edit</a>
                    <a href="deletemember.php?member_id=<?php echo $member['member_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form action="" method="POST" style="display:inline;">
        <input type="submit" name="logoutBtn" value="Logout">
    </form>
</body>
</html>