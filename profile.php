<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin']) {
    header('Location: main.php');
    exit();
}

$user = $_SESSION['user'];
$cardsJson = file_get_contents('cards.json');
$pokemonCards = json_decode($cardsJson, true);
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

        <h2>Your Cards: (click on the name on the cards to see full details)</h2>
        <div class="user-cards">
            <?php foreach ($user['cards'] as $cardId): ?>
                <?php if (isset($pokemonCards[$cardId])): ?>
                    <div class="card">
                        <a href="card-details.php?type=<?= urlencode($pokemonCards[$cardId]['type']) ?>&name=<?= urlencode($pokemonCards[$cardId]['name']) ?>&image=<?= urlencode($pokemonCards[$cardId]['image']) ?>&hp=<?= urlencode($pokemonCards[$cardId]['hp']) ?>&attack=<?= urlencode($pokemonCards[$cardId]['attack']) ?>&defense=<?= urlencode($pokemonCards[$cardId]['defense']) ?>&price=<?= urlencode($pokemonCards[$cardId]['price']) ?>&description=<?= urlencode($pokemonCards[$cardId]['description']) ?>">
                            <h3><?= htmlspecialchars($pokemonCards[$cardId]['name']) ?></h3>
                            <p>Type: <?= htmlspecialchars($pokemonCards[$cardId]['type']) ?></p>
                            <p>HP: <?= htmlspecialchars($pokemonCards[$cardId]['hp']) ?></p>
                        </a>
                        <form action="sell-card.php" method="post" novalidate>
                            <input type="hidden" name="cardId" value="<?= htmlspecialchars($cardId) ?>">
                            <input type="hidden" name="cardPrice" value="<?= htmlspecialchars($pokemonCards[$cardId]['price']) ?>">
                            <button type="submit" name="sell">Sell</button>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <form action="main.php" method="get" novalidate>
            <button type="submit" class="cancel-button">Cancel</button>
        </form>
    </div>
</body>
</html>