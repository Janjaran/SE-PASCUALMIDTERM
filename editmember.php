<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">View All Members</a>
    <h1>Edit Member!</h1>
    <?php $member = getMemberByID($pdo, $_GET['member_id']); ?>
    <form action="core/handleForms.php?member_id=<?php echo $_GET['member_id']; ?>" method="POST">
        <p>
            <label for="memberName">Member Name:</label> 
            <input type="text" name="memberName" value="<?php echo $member['member_name']; ?>">
        </p>
        <p>
            <label for="email">Email:</label> 
            <input type="email" name="email" value="<?php echo $member['email']; ?>">
        </p>
        <p>
            <label for="phoneNumber">Phone Number:</label> 
            <input type="text" name="phoneNumber" value="<?php echo $member['phone_number']; ?>">
        </p>
        <input type="submit" name="editMemberBtn" value="Update Member">
    </form>
</body>
</html>