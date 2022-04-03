<?php
$title = 'Home';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h1 class="alert alert-primary">Welcome to To Do</h1>
    <p>A project culminating from the knowledge I learned in my COMP-1006 PHP class.</p>
    <p>I decided to make a to do list because it’s something I use in everyday life.</p>
    <a href="https://github.com/asouvanlasy/todo" class="text-info">View the source on Github.</a>
</main>

<div class="container pt-5">
    <h2 class="alert alert-secondary">Features</h2>
    <div class="row">
        <div class="col-lg">
            <h3>Simple Usage</h3>
            <p>Set only a task name, a priority, and optionally a note.</p>
        </div>
        <div class="col-lg">
            <h3>Easy Viewing</h3>
            <p>Tasks are filtered from highest-to-lowest priority.</p>
        </div>
        <div class="col-lg">
            <h3>Secure Management</h3>
            <p>When registered, only you can add or modify your own tasks.</p>
        </div>
    </div>
</div>

<div class="container pt-5">
    <h2 class="alert alert-secondary">How This Was Built</h2>
    <div class="row">
        <div class="col-lg">
            <h3>Backend</h3>
            <p>Three tables are on the AWS server. The first stores each task, the second is referred to for the three priority levels, and the third holds user accounts.</p>
        </div>
        <div class="col-lg">
            <h3>Code Structure</h3>
            <p>Each "action" such as saving and deleting has it's own PHP file. The header and server connection is shared across all webpages using the 'require' function.</p>
        </div>
        <div class="col-lg">
            <h3>CSS with Bootstrap</h3>
            <p>Bootstrap styles delivered via CDN.</p>
        </div>
    </div>
</div>

<div class="container pt-5">
    <h2 class="alert alert-info">What's New (Mar 31, 2022)</h2>
    <div class="row">
        <div class="col-lg">
            <h3>Visual Changes</h3>
            <p>A new home page and responsive shared header.</p>
        </div>
        <div class="col-lg">
            <h3>User Login</h3>
            <p>Securely created accounts and manage your tasks. Passwords are hashed, so even we don't know your password.</p>
        </div>
        <div class="col-lg">
            <h3>Error Handling</h3>
            <p>All PHP code is nested in try-catch blocks. If any error is encountered, it'll redirect the user to an appropriate error page.</p>
        </div>
    </div>
</div>

</body>

</html>