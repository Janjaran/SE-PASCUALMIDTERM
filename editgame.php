<?php
require_once 'core/models.php';
require_once 'core/dbConfig.php';

$game_id = $_GET['game_id'];
$game = getGameByID($pdo, $game_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="viewgames.php?member_id=<?php echo $game['member_id']; ?>">View The Games</a>
    <h1>Edit the Game!</h1>
    
    <form action="core/handleForms.php?game_id=<?php echo $game_id; ?>&member_id=<?php echo $game['member_id']; ?>" method="POST">

        <p>
            <label for="gameName">Game Name:</label>
            <input type="text" name="gameName" value="<?php echo $game['game_name']; ?>">
        </p>
        <input type="submit" name="editGameBtn" value="Update Game">
    </form>
</body>
</html>