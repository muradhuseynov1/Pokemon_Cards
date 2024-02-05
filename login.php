<?php
session_start();

$errorMessage = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('users.json'), true);
    $loginSuccessful = false;

    foreach ($users as $user) {
        if ($user['username'] === $username && $password === $user['password']) {
        // if ($user['username'] === $username && password_verify($password, $user['password'])), passwords are not hashed for simplicity
            $_SESSION['user'] = $user;
            header('Location: main.php');
            exit();
        }
    }

    $errorMessage = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Pokémon Cards Collection</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="login-container">
        <form action="login.php" method="post" novalidate>
            <h2>Login</h2>
            <?php if ($errorMessage): ?>
                <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
            <?php endif; ?>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
        <a href="main.php" class="cancel-button">Cancel</a>
    </div>
</body>
</html>