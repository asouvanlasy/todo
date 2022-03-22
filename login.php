<?php
$title = 'Login';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h1>Login</h1>
    <?php
    if (empty($_GET['invalid'])) {
        echo '<h6 class="alert alert-secondary">Please enter your credentials.</h6>';
    } else {
        echo '<h6 class="alert alert-info">Invalid login.</h6>';
    }
    ?>
    <form method="post" action="validate.php">
        <fieldset class="mb-3 mt-3">
            <label for="username" class="form-label">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="mb-3 mt-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>
        <fieldset class="mb-3 mt-3">
            <button class="btn btn-primary">Login</button>
        </fieldset>
    </form>
</main>

</body>

</html>