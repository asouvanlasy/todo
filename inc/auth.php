<?php
// Call session_start to read any session var
session_start();

// Check the session for a username var. If exists => authenticated. If not => anonymous
if (empty($_SESSION['username'])) {
    header('location:login.php');
    exit(); // Stop page execution
}