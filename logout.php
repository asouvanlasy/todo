<?php
// Call session in order to destroy it
session_start();

// Remove current session
session_destroy();

// Redirect to login
header('location:login.php');