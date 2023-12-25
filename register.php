<?php
session_start();

$errorMessage = '';
$usernameValue = '';
$emailValue = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    $usernameValue = $username; // Preserve username value
    $emailValue = $email; // Preserve email value

    // Validate inputs
    if (!$username || !$email || !$password || $password !== $confirmPassword || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!$username || !$email || !$password) {
            $errorMessage = 'All fields are required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = 'Invalid email format.';
        } elseif ($password !== $confirmPassword) {
            $errorMessage = 'Passwords do not match.';
        }
    } else {
        // Read users.json
        $users = json_decode(file_get_contents('users.json'), true);

        // Check if username or email already exists
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $errorMessage = 'Username already exists.';
                break;
            }
        }

        if (!$errorMessage) {
            // Add new user with $1000
            $users[] = [
                'username' => $username,
                'email' => $email,
                'password' => $password, // Storing the password directly
                'isAdmin' => false,
                'cards' => [],
                'money' => 1000 // Assigning $1000 to the user
            ];

            file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

            // Log in the user
            $_SESSION['user'] = end($users); // Assign the last user (newly added) to session
            header('Location: main.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Pokémon Cards Collection</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="register-container">
        <?php if ($errorMessage): ?>
            <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>

        <form action="register.php" method="post">
            <h2>Register</h2>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($usernameValue) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($emailValue) ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <button type="submit">Register</button>
        </form>
        <a href="main.php" class="cancel-button">Cancel</a>
    </div>
</body>
</html>
