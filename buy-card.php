<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] || !isset($_POST['buy'])) {
    error_log('Redirecting to main.php - User not set or is admin, or buy not set in POST.');
    header('Location: main.php');
    exit();
}

$cardId = $_POST['cardId'];
$cardPrice = $_POST['cardPrice'];
$userId = $_SESSION['user']['username'];

$users = json_decode(file_get_contents('users.json'), true);

foreach ($users as $user) {
    if (!$user['isAdmin'] && in_array($cardId, $user['cards'])) {
        $_SESSION['error_message'] = "Card already purchased.";
        error_log("Card $cardId already purchased by a non-admin user, redirecting to main.php.");
        header('Location: main.php');
        exit();
    }
}

foreach ($users as &$user) {
    if ($user['username'] === $userId && !$user['isAdmin']) {
        if (count($user['cards']) >= 5) {
            $_SESSION['error_message'] = "You cannot have more than 5 cards.";
            header('Location: main.php');
            exit();
        }
        if ($user['money'] >= $cardPrice) {
            if (!in_array($cardId, $user['cards'])) {
                $user['money'] -= $cardPrice;
                $user['cards'][] = $cardId;
                error_log("Card $cardId purchased by user $userId. Remaining money: {$user['money']}");
            } else {
                error_log("Card $cardId already in user $userId's possession.");
            }
        } else {
            error_log("User $userId does not have enough money to buy card $cardId.");
        }
        break;
    }
}

foreach ($users as &$adminUser) {
    if ($adminUser['isAdmin']) {
        if (($key = array_search($cardId, $adminUser['cards'])) !== false) {
            unset($adminUser['cards'][$key]);
            error_log("Card $cardId removed from admin's list.");
        }
        break;
    }
}

if (file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT))) {
    error_log("Users data updated successfully.");
} else {
    error_log("Failed to update users.json");
}

$_SESSION['user'] = $user;
header('Location: main.php');
exit();