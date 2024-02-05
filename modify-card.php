<?php
session_start();

if (!isset($_SESSION['user']) || !$_SESSION['user']['isAdmin']) {
    header('Location: main.php');
    exit();
}

$cardId = $_GET['cardId'] ?? null;
$cardsJson = file_get_contents('cards.json');
$cards = json_decode($cardsJson, true);
$cardToModify = $cards[$cardId] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $type = $_POST['type'] ?? '';
    $hp = $_POST['hp'] ?? '0';
    $attack = $_POST['attack'] ?? '0';
    $defense = $_POST['defense'] ?? '0';
    $price = $_POST['price'] ?? '0';
    $description = $_POST['description'] ?? '';
    $image = $_POST['image'] ?? '';

    if ($name && $type) {
        $cards[$cardId] = [
            'name' => $name,
            'type' => $type,
            'hp' => $hp,
            'attack' => $attack,
            'defense' => $defense,
            'price' => $price,
            'description' => $description,
            'image' => $image
        ];

        if (file_put_contents('cards.json', json_encode($cards))) {
            $successMessage = "Card updated successfully!";
            header('Location: main.php');
            exit();
        } else {
            $errorMessage = "Error updating card.";
        }
    } else {
        $errorMessage = "Please fill in all required fields.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modify Card</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="modify-card-container">
        <?php if (!empty($errorMessage)): ?>
            <p class="error"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <p class="success"><?= htmlspecialchars($successMessage) ?></p>
        <?php endif; ?>

        <form action="modify-card.php?cardId=<?= htmlspecialchars($cardId) ?>" method="post" novalidate>
            <h1>Modify Card</h1>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($cardToModify['name'] ?? '') ?>">

            <label for="type">Type:</label>
            <input type="text" id="type" name="type" value="<?= htmlspecialchars($cardToModify['type'] ?? '') ?>">

            <label for="hp">HP:</label>
            <input type="number" id="hp" name="hp" value="<?= htmlspecialchars($cardToModify['hp'] ?? '') ?>">

            <label for="attack">Attack:</label>
            <input type="number" id="attack" name="attack" value="<?= htmlspecialchars($cardToModify['attack'] ?? '') ?>">

            <label for="defense">Defense:</label>
            <input type="number" id="defense" name="defense" value="<?= htmlspecialchars($cardToModify['defense'] ?? '') ?>">

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($cardToModify['price'] ?? '') ?>">

            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= htmlspecialchars($cardToModify['description'] ?? '') ?></textarea>

            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image" value="<?= htmlspecialchars($cardToModify['image'] ?? '') ?>">

            <div class="button-container">
                <button type="submit">Update Card</button>
                <a href="main.php" class="cancel-button">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>