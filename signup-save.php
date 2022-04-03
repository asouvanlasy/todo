<?php
$title = 'Saving Your User';
require 'inc/header.php';

// Capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// Validate inputs
if (empty($username)) {
    echo '<p class="alert alert-info">Username is required.</p>';
    $ok = false;
}

// Validate inputs
if (empty($password)) {
    echo '<p class="alert alert-info">Password is required.</p>';
    $ok = false;
}

// Validate inputs
if ($password != $confirm) {
    echo '<p class="alert alert-info">Passwords do not match.</p>';
    $ok = false;
}

if ($ok) {
    // Connect
    require 'inc/db.php';

    // Check for existing username
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam('username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch(); // This $user object is a boolean

    // If username exists, show error then stop
    if ($user) {
        echo '<p class="alert alert-info">Username already exists.</p>';
        $db = null;
    } else {
        // If username not found, has the password, then save the new user
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam('username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam('password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();

        // Disconnect
        $db = null;

        echo '<p class="alert alert-secondary">Registration successful.</p>';

        // Redirect to login page
        header('location:login.php');
    }
}
?>

</body>

</html>