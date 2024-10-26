<?php  

function registerUser ($pdo, $first_name, $last_name, $address, $age, $username, $password) {
    $stmt = $pdo->prepare("INSERT INTO Users (first_name, last_name, address, age, username, password) 
    VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$first_name, $last_name, $address, $age, $username, $password]);
}

function loginUser ($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "No user found with that username.";
        return false; 
    }

    if (password_verify($password, $user['password'])) {
        return $user; 
    } else {
        echo "Password does not match."; 
        return false; 
    }
}

function getUserById($pdo, $user_id) { 
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

function insertMember($pdo, $member_name, $email, $phone_number, $added_by) {
    $sql = "INSERT INTO Members (member_name, email, phone_number, added_by) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$member_name, $email, $phone_number, $added_by]);

    return $executeQuery;
}

function updateMember($pdo, $member_name, $email, $phone_number, $member_id, $added_by) {
    $sql = "UPDATE Members
            SET member_name = ?, email = ?, phone_number = ?, last_updated = CURRENT_TIMESTAMP, added_by = ?
            WHERE member_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$member_name, $email, $phone_number, $added_by, $member_id]);

    return $executeQuery; 
}

function deleteMember($pdo, $member_id) {
    $deleteGames = "DELETE FROM Games WHERE member_id = ?";
    $deleteStmt = $pdo->prepare($deleteGames);
    $executeDeleteQuery = $deleteStmt->execute([$member_id]);

    if ($executeDeleteQuery) {
        $sql = "DELETE FROM Members WHERE member_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$member_id]);

        return $executeQuery;
    }
    return false;
}

function getAllMembers($pdo) {
    $sql = "SELECT * FROM Members";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
    return [];
}

function getMemberByID($pdo, $member_id) {
    $sql = "SELECT * FROM Members WHERE member_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$member_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
    return null;
}

function getGamesByMember($pdo, $member_id) {
    $sql = "SELECT g.*, 
                   u1.first_name AS added_by_firstname, 
                   u1.last_name AS added_by_lastname, 
                   u2.first_name AS updated_by_firstname, 
                   u2.last_name AS updated_by_lastname 
            FROM Games g 
            LEFT JOIN Users u1 ON g.created_by = u1.user_id 
            LEFT JOIN Users u2 ON g.updated_by = u2.user_id 
            WHERE g.member_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$member_id]);
    return $stmt->fetchAll(); 
}

function insertGame($pdo, $game_name, $member_id, $added_by) {
    $sql = "INSERT INTO Games (game_name, member_id, created_by, updated_by) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$game_name, $member_id, $added_by, $added_by]); 
}

function updateGame($pdo, $game_name, $game_id, $updated_by) {
    $stmt = $pdo->prepare("UPDATE Games SET game_name = ?, updated_by = ?, last_updated = CURRENT_TIMESTAMP WHERE game_id = ?");
    return $stmt->execute([$game_name, $updated_by, $game_id]); 
}

function getGameByID($pdo, $game_id) {
    $sql = "SELECT g.*, u1.username AS created_by_username, u2.username AS updated_by_username 
            FROM Games g 
            LEFT JOIN Users u1 ON g.created_by = u1.user_id 
            LEFT JOIN Users u2 ON g.updated_by = u2.user_id 
            WHERE g.game_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$game_id]);
    return $stmt->fetch(); 
}

function deleteGame($pdo, $game_id) {
    $stmt = $pdo->prepare("DELETE FROM Games WHERE game_id = ?");
    return $stmt->execute([$game_id]);
}