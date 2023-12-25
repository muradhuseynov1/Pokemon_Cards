<?php
session_start();
// Load the JSON file containing the Pokémon cards
$cardsJson = file_get_contents('cards.json');
$pokemonCards = json_decode($cardsJson, true);

$usersJson = file_get_contents('users.json');
$users = json_decode($usersJson, true);

$selectedType = $_GET['type'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pokémon Cards Collection</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> 
</head>
<body>
    <header>
        <h1>Pokémon Cards Collection</h1>
        <h2>Explore a variety of Pokémon cards with detailed information and purchase them</h2>
        <div class="header-buttons">
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['isAdmin']): ?>
                    <a href="add-card.php">Add Card</a>
                <?php else: ?>
                    <span>Vault: $<?= htmlspecialchars($_SESSION['user']['money'] ?? '0') ?> |</span> <!-- Display money for non-admin users -->
                    <span>| Cards: <?= count($_SESSION['user']['cards']) ?></span>
                    <a href="profile.php"><?= htmlspecialchars($_SESSION['user']['username']) ?></a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </header>
    <!-- Dropdown form for filtering by type -->
    <form action="main.php" method="get">
        <select name="type">
            <option value="">All Types</option>
            <option value="normal" <?= $selectedType == 'normal' ? 'selected' : '' ?>>Normal</option>
            <option value="fire" <?= $selectedType == 'fire' ? 'selected' : '' ?>>Fire</option>
            <option value="water" <?= $selectedType == 'water' ? 'selected' : '' ?>>Water</option>
            <option value="electric" <?= $selectedType == 'electric' ? 'selected' : '' ?>>Electric</option>
            <option value="grass" <?= $selectedType == 'grass' ? 'selected' : '' ?>>Grass</option>
            <option value="ice" <?= $selectedType == 'ice' ? 'selected' : '' ?>>Ice</option>
            <option value="fighting" <?= $selectedType == 'fighting' ? 'selected' : '' ?>>Fighting</option>
            <option value="poison" <?= $selectedType == 'poison' ? 'selected' : '' ?>>Poison</option>
            <option value="ground" <?= $selectedType == 'ground' ? 'selected' : '' ?>>Ground</option>
            <option value="flying" <?= $selectedType == 'flying' ? 'selected' : '' ?>>Flying</option>
            <option value="psychic" <?= $selectedType == 'psychic' ? 'selected' : '' ?>>Psychic</option>
            <option value="bug" <?= $selectedType == 'bug' ? 'selected' : '' ?>>Bug</option>
            <option value="rock" <?= $selectedType == 'rock' ? 'selected' : '' ?>>Rock</option>
            <option value="ghost" <?= $selectedType == 'ghost' ? 'selected' : '' ?>>Ghost</option>
            <option value="dragon" <?= $selectedType == 'dragon' ? 'selected' : '' ?>>Dragon</option>
            <option value="dark" <?= $selectedType == 'dark' ? 'selected' : '' ?>>Dark</option>
            <option value="steel" <?= $selectedType == 'steel' ? 'selected' : '' ?>>Steel</option>
            <option value="fairy" <?= $selectedType == 'fairy' ? 'selected' : '' ?>>Fairy</option>
            <option value="stellar" <?= $selectedType == 'stellar' ? 'selected' : '' ?>>Stellar</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <div class="card-container">
        <?php foreach ($pokemonCards as $cardId => $card): ?>
            <?php 
                if ($selectedType && $card['type'] !== $selectedType) {
                    continue; 
                }
            ?>
            <?php
            $bgColor = '';
            switch($card['type']) {
                case 'normal': $bgColor = '#A8A77A'; break;
                case 'fire': $bgColor = '#EE8130'; break;
                case 'water': $bgColor = '#6390F0'; break;
                case 'electric': $bgColor = '#F7D02C'; break;
                case 'grass': $bgColor = '#7AC74C'; break;
                case 'ice': $bgColor = '#96D9D6'; break;
                case 'fighting': $bgColor = '#C22E28'; break;
                case 'poison': $bgColor = '#A33EA1'; break;
                case 'ground': $bgColor = '#E2BF65'; break;
                case 'flying': $bgColor = '#A98FF3'; break;
                case 'psychic': $bgColor = '#F95587'; break;
                case 'bug': $bgColor = '#A6B91A'; break;
                case 'rock': $bgColor = '#B6A136'; break;
                case 'ghost': $bgColor = '#735797'; break;
                case 'dragon': $bgColor = '#6F35FC'; break;
                case 'dark': $bgColor = '#705746'; break;
                case 'steel': $bgColor = '#B7B7CE'; break;
                case 'fairy': $bgColor = '#D685AD'; break;
                case 'stellar': $bgColor = '#7CC7B2'; break; // Stellar type color
            }
            ?>
            <div class="card">
                <div class="pokemon-image" style="background-color: <?= $bgColor; ?>">
                    <img src="<?= htmlspecialchars($card['image']) ?>" alt="<?= htmlspecialchars($card['name']) ?>">
                </div>
                <h2 class="pokemon-name">
                <a href="card-details.php?type=<?= urlencode($card['type']) ?>&name=<?= urlencode($card['name']) ?>&image=<?= urlencode($card['image']) ?>&hp=<?= urlencode($card['hp']) ?>&attack=<?= urlencode($card['attack']) ?>&defense=<?= urlencode($card['defense']) ?>&price=<?= urlencode($card['price']) ?>&description=<?= urlencode($card['description']) ?>">
                    <?= htmlspecialchars($card['name']) ?>
                </a>
                </h2>
                <div class="pokemon-type">
                    <img src="/src/tag.png" alt="Type Tag">
                    <span><?= htmlspecialchars($card['type']) ?></span>
                </div>
                <div class="pokemon-stats">
                    <img src="/src/heart.png" alt="HP">
                    <span><?= htmlspecialchars($card['hp']) ?></span>
                    <img src="/src/swords.png" alt="Attack">
                    <span><?= htmlspecialchars($card['attack']) ?></span>
                    <img src="/src/shield.png" alt="Defense">
                    <span><?= htmlspecialchars($card['defense']) ?></span>
                </div>
                <div class="pokemon-price">
                    <img src="/src/money-sack.png" alt="Price">
                    <span>$<?= htmlspecialchars($card['price']) ?></span>
                </div>
                <?php 
                $alreadyPurchased = false;
                foreach ($users as $user) {
                    if (!$user['isAdmin'] && in_array($cardId, $user['cards'])) {
                        $alreadyPurchased = true;
                        break;
                    }
                }

                if (isset($_SESSION['user']) && !$_SESSION['user']['isAdmin'] && !$alreadyPurchased): ?>
                    <form action="buy-card.php" method="post">
                        <input type="hidden" name="cardId" value="<?= htmlspecialchars($cardId) ?>">
                        <input type="hidden" name="cardPrice" value="<?= htmlspecialchars($card['price']) ?>">
                        <button type="submit" name="buy">Buy</button>
                    </form>
                <?php elseif ($alreadyPurchased): ?>
                    <p>Card already purchased</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
