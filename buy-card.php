<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] || !isset($_POST['buy'])) {
    header('Location: main.php');
    exit();
}

$cardId = $_POST['cardId'];
$cardPrice = $_POST['cardPrice'];
$userId = $_SESSION['user']['username'];

// Load users and cards data
$users = json_decode(file_get_contents('users.json'), true);
$cards = json_decode(file_get_contents('cards.json'), true);

// Find user and check if they have enough money
foreach ($users as &$user) {
    if ($user['username'] === $userId) {
        if ($user['money'] >= $cardPrice) {
            $user['money'] -= $cardPrice;
            $user['cards'][] = $cardId;
        } else {
            // Handle case where user doesn't have enough money
            $_SESSION['error_message'] = "Not enough money to buy this card.";
            header('Location: main.php');
            exit();
        }
        break;
    }
}

// Save updated users data
file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

// Redirect to main page
header('Location: main.php');
exit();
?>
