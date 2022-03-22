<?php
$title = 'Register';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h1>User Registration</h1>
    <h6 class="alert alert-secondary" id="message">Passwords must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.</h6>
    <form method="post" action="save-registration.php">
        <fieldset class="mb-3 mt-3">
            <label for="username" class="form-label">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="mb-3 mt-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="mb-3 mt-3">
            <label for="confirm" class="form-label">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="mb-3 mt-3">
            <button class="btn btn-primary" onclick="return comparePasswords()">Register</button>
        </fieldset>
    </form>
</main>

</body>

</html>