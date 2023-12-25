<?php
session_start();

if (!isset($_SESSION['user']) || !$_SESSION['user']['isAdmin']) {
    header('Location: main.php');
    exit();
}

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and validate input
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $hp = trim($_POST['hp']);
    $attack = trim($_POST['attack']);
    $defense = trim($_POST['defense']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);

    if (!$name || !$type || !is_numeric($hp) || !is_numeric($attack) || !is_numeric($defense) || !is_numeric($price) || !$description || !$image) {
        $errorMessage = 'Please fill in all fields correctly.';
    } else {
        // Update cards.json
        $cards = json_decode(file_get_contents('cards.json'), true);
        $newCardId = 'card' . count($cards);
        $cards[$newCardId] = [
            'name' => $name,
            'type' => $type,
            'hp' => (int)$hp,
            'attack' => (int)$attack,
            'defense' => (int)$defense,
            'price' => (int)$price,
            'description' => $description,
            'image' => $image
        ];
        file_put_contents('cards.json', json_encode($cards, JSON_PRETTY_PRINT));

        // Update users.json
        $users = json_decode(file_get_contents('users.json'), true);
        foreach ($users as &$user) {
            if ($user['username'] === $_SESSION['user']['username']) {
                $user['cards'][] = $newCardId;
                break;
            }
        }
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

        // Redirect or display success message
        header('Location: main.php'); // Redirect to main page or display a success message
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Card - Pokémon Cards Collection</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="add-card-container">
        <?php if ($errorMessage): ?>
            <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>
        <?php if ($successMessage): ?>
            <p class="success-message"><?= htmlspecialchars($successMessage) ?></p>
        <?php endif; ?>

        <form action="add-card.php" method="post">
            <h2>Add New Card</h2>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" required>

            <label for="hp">HP:</label>
            <input type="number" id="hp" name="hp" required>

            <label for="attack">Attack:</label>
            <input type="number" id="attack" name="attack" required>

            <label for="defense">Defense:</label>
            <input type="number" id="defense" name="defense" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image">Image URL:</label>
            <input type="url" id="image" name="image" required>

            <button type="submit">Add Card</button>
            <a href="main.php" class="cancel-button">Cancel</a>
        </form>
    </div>
</body>
</html>
