<?php
// Capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// Connect
require 'inc/db.php';

// Check for username not found, redirect to login with error message
$sql = "SELECT * FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam('username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch(); // This $user object is a boolean

// If username found, hash and compare passwords
if (!$user) {
    $db = null;
    header('location:login.php?invalid=true');
} else {
    // If username found, hash and compare the password entered with the hashed password in the db query result
    if (!password_verify($password, $user['password'])) {
        // If passwords don't match, redirect to login with error message
        $db = null;
        header('location:login.php?invalid=true');
    } else {
        // Login is valid: access session object, store indentity in session var, redirect to task-view page
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $user['userId'];
        header('location:task-view.php');
    }
}
