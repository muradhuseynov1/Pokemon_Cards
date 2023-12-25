<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin']) {
    header('Location: main.php');
    exit();
}

// Assuming user data is stored in session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="profile-container">
        <h1>User Profile</h1>
        <p>Username: <?= htmlspecialchars($user['username']) ?></p>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <p>Money: $<?= htmlspecialchars($user['money']) ?></p>

        <h2>Your Cards:</h2>
        <!-- List the user's cards -->
    </div>
</body>
</html>
