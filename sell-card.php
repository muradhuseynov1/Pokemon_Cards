<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] || !isset($_POST['sell'])) {
    header('Location: main.php');
    exit();
}

$cardId = $_POST['cardId'];
$cardPrice = $_POST['cardPrice'];
$userId = $_SESSION['user']['username'];

$users = json_decode(file_get_contents('users.json'), true);

// Process the sale for non-admin users
foreach ($users as &$user) {
    if ($user['username'] === $userId) {
        // Remove the card from the user's list and update their money
        if (($key = array_search($cardId, $user['cards'])) !== false) {
            unset($user['cards'][$key]);
            $user['money'] += $cardPrice * 0.9; // User receives 90% of the card's price
        }
        break;
    }
}

// Add the card back to the admin's list
foreach ($users as &$adminUser) {
    if ($adminUser['isAdmin']) {
        $adminUser['cards'][] = $cardId;
        break;
    }
}

// Save the updated users data
file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

$_SESSION['user'] = $user;
header('Location: profile.php');
exit();
?>
