<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$member_id = $_GET['member_id'] ?? null;
$user_id = $_SESSION['user_id']; 

if (isset($_POST['insertGameBtn'])) {
    $gameName = $_POST['game_name']; 
    $memberID = $_POST['member_id'];

    if (insertGame($pdo, $gameName, $memberID, $user_id)) {
        header("Location: viewgames.php?member_id=" . $memberID); 
        exit(); 
    } 
}

$games = getGamesByMember($pdo, $member_id); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Games</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Games for Member ID: <?php echo htmlspecialchars($member_id); ?></h1>

    <form action="" method="POST">
        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member_id); ?>">
        <p>
            <label for="game_name">Game Name:</label>
            <input type="text" name="game_name" required>
        </p>
        <input type="submit" name="insertGameBtn" value="Add Game">
    </form>

    <h2>All Games</h2>
<table>
    <tr>
        <th>Game ID</th>
        <th>Game Name</th>
        <th>Added By</th>
        <th>Updated By</th>
        <th>Last Updated</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($games as $game) { ?>
        <tr>
            <td><?php echo htmlspecialchars($game['game_id']); ?></td>
            <td><?php echo htmlspecialchars($game['game_name']); ?></td>
            <td><?php echo htmlspecialchars($game['added_by_firstname'] . ' ' . $game['added_by_lastname']); ?></td>
            <td><?php echo htmlspecialchars($game['updated_by_firstname'] . ' ' . $game['updated_by_lastname']); ?></td>
            <td><?php echo htmlspecialchars($game['last_updated']); ?></td>
            <td>
                <a href="editgame.php?game_id=<?php echo htmlspecialchars($game['game_id']); ?>&member_id=<?php echo htmlspecialchars($member_id); ?>">Edit</a>
                <a href="deletegame.php?game_id=<?php echo htmlspecialchars($game['game_id']); ?>&member_id=<?php echo htmlspecialchars($member_id); ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>