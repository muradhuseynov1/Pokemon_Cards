<?php
session_start();

// Clear the session
session_unset();
session_destroy();

// Redirect to the main page
header('Location: main.php');
exit();
?>
