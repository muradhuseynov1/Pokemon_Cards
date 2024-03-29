<?php
$type = $_GET['type'] ?? '';
$name = $_GET['name'] ?? '';
$image = $_GET['image'] ?? '';
$hp = $_GET['hp'] ?? '';
$description = $_GET['description'] ?? '';
$attack = $_GET['attack'] ?? '';
$defense = $_GET['defense'] ?? '';
$price = $_GET['price'] ?? '';

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
    case 'stellar': $bgColor = '#7CC7B2'; break; 
    default: $bgColor = '#FFFFFF'; break; 
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
    <form action="main.php" method="get" novalidate>
            <button type="submit" class="cancel-button">Cancel</button>
    </form>
</body>
</html>