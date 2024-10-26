<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Game</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $game = getGameByID($pdo, $_GET['game_id']);  ?>
	<h1>Are you sure you want to delete this game?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Game ID: <?php echo $game['game_id']; ?></h2>
		<h2>Game Name: <?php echo $game['game_name']; ?></h2>
		<h2>Member ID: <?php echo $game['member_id']; ?></h2> 
		<div class="deleteBtn" style="float: right; margin-right: 10px;">
		<form action="core/handleForms.php?member_id=<?php echo $game['member_id']; ?>" method="POST">
    <input type="hidden" name="game_id" value="<?php echo $game['game_id']; ?>">
    <input type="submit" name="deleteGameBtn" value="Delete">
</form>		
		</div>	
	</div>
</body>
</html>