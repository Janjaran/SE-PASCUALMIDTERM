<?php 

session_start();
require_once 'dbConfig.php'; 
require_once 'models.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 

if (isset($_POST['insertMemberBtn'])) {
    $member_name = $_POST['member_name']; 
    $favorite_game = $_POST['favorite_game']; 
    $game_type = $_POST['game_type'];

    // Insert member with the user ID who added
    $query = insertMember($pdo, $member_name, $favorite_game, $game_type, $user_id);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editMemberBtn'])) {
    $member_id = $_GET['member_id']; 
    $member_name = $_POST['memberName']; 
    $email = $_POST['email'];
    $phone_number = $_POST['phoneNumber']; 

    // Update member with the user ID who is editing
    $query = updateMember($pdo, $member_name, $email, $phone_number, $member_id, $user_id);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Update failed";
    }
}

if (isset($_POST['deleteMemberBtn'])) {
    $member_id = $_GET['member_id']; 
    $query = deleteMember($pdo, $member_id);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Deletion failed";
    }
}

if (isset($_POST['insertGameBtn'])) {
    $game_name = $_POST['game_name'];
    $member_id = $_GET['member_id'];

    // Insert game with the user ID who added it
    $query = insertGame($pdo, $game_name, $member_id, $user_id);

    if ($query) {
        header("Location: ../viewgames.php?member_id=" . $member_id);
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editGameBtn'])) {
    $game_id = $_GET['game_id'];
    $member_id = $_GET['member_id']; 

    // Update game with the user ID who is editing
    $query = updateGame($pdo, $_POST['gameName'], $game_id, $user_id);

    if ($query) {
        header("Location: ../viewgames.php?member_id=" . $member_id);
    } else {
        echo "Update failed";
    }
}

if (isset($_POST['deleteGameBtn'])) {
    $game_id = $_POST['game_id'];
    $member_id = $_GET['member_id']; 

    if (deleteGame($pdo, $game_id)) {
        header("Location: ../viewgames.php?member_id=" . $member_id); 
    } else {
        echo "Deletion failed";
    }
}

?>