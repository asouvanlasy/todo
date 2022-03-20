<?php
$title = 'Home';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h1 class="alert alert-primary">Welcome to To Do List</h1>
    <p>A personal project culminating from the knowledge I learned in my COMP-1006 PHP class.</p>
    <p>I decided to make a to do list because it’s something I use in everyday life.</p>
    <a href="https://github.com/asouvanlasy/todo-list" class="text-info">View the source on Github.</a>
</main>

<div class="container pt-3">
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
            <h3>Edit and Delete Anytime</h3>
            <p>Click on a task to edit, and click the big delete button to remove it.</p>
        </div>
    </div>
</div>

<div class="container pt-3">
    <h2 class="alert alert-secondary">How This Was Built</h2>
    <div class="row">
        <div class="col-lg-6">
            <h3>Backend</h3>
            <p>Two tables are on the AWS server. One stores each task, and the other holds the three priority levels to be selected.</p>
        </div>
        <div class="col-lg-6">
            <h3>Code Structure</h3>
            <p>Each "action" such as saving and deleting has it's own PHP file. The header and server connection is shared across all webpages using the 'require' function.</p>
        </div>
    </div>
</div>

<div class="container pt-3">
    <h2 class="alert alert-info">What's New (Mar 3, 2022)</h2>
    <div class="row">
        <div class="col-lg">
            <h3>This Home Page</h3>
            <p>A new home page which serves as light documentation.</p>
        </div>
        <div class="col-lg">
            <h3>Navbar</h3>
            <p>A responsive way to navigate the site. On smaller breakpoints, a collapsible navbar appears instead.</p>
        </div>
        <div class="col-lg">
            <h3>Error Handling</h3>
            <p>All PHP code is nested in try-catch blocks. If any error is encountered, it'll redirect the user to an appropriate error page.</p>
        </div>
    </div>
</div>

<div class="container pt-3">
    <h2 class="alert alert-info">Future Plans</h2>
    <div class="row">
        <div class="col-lg-6">
            <h3>Registration and Login</h3>
            <p>Add user accounts to have personalized tasks.</p>
        </div>
        <div class="col-lg-6">
            <h3>Unique CSS Styling</h3>
            <p>Override default Bootstrap color theme to have something more unique.</p>
        </div>
    </div>
</div>

</body>

</html>