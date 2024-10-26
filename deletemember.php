<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Member</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this member?</h1>
	<?php $member = getMemberByID($pdo, $_GET['member_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Member ID: <?php echo $member['member_id']; ?></h2>
		<h2>Member Name: <?php echo $member['member_name']; ?></h2>
		<h2>Email: <?php echo $member['email']; ?></h2>
		<h2>Phone Number: <?php echo $member['phone_number']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?member_id=<?php echo $_GET['member_id']; ?>" method="POST">
				<input type="submit" name="deleteMemberBtn" value="Delete">
			</form>			
		</div>	
	</div>
</body>
</html>