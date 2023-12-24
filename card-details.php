<?php
$type = $_GET['type'] ?? 'Unknown';
$name = $_GET['name'] ?? 'Unknown';
$image = $_GET['image'] ?? 'default.png';
$hp = $_GET['hp'] ?? 'Unknown';
$description = $_GET['description'] ?? 'No description available';
$attack = $_GET['attack'] ?? 'Unknown';
$defense = $_GET['defense'] ?? 'Unknown';
$price = $_GET['price'] ?? 'Unknown';

// Determine background color based on type
$bgColor = '';
switch(strtolower($type)) {
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
    default: $bgColor = '#FFFFFF'; break; // Default background color
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($name) ?> - Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="card-detail" style="background-color: <?= $bgColor; ?>">
        <div class="card-text">
            <h1><?= htmlspecialchars($name) ?></h1>
            <p>HP: <?= htmlspecialchars($hp) ?></p>
            <p>Attack: <?= htmlspecialchars($attack) ?></p>
            <p>Defense: <?= htmlspecialchars($defense) ?></p>
            <p>Price: $<?= htmlspecialchars($price) ?></p>
            <p>Description: <?= htmlspecialchars($description) ?></p>
            <p>Type: <?= htmlspecialchars($type) ?></p>
        </div>
        <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>">
    </div>
</body>
</html>
