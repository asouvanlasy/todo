<!-- This header is shared across all pages -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="./css/styles.css" rel="stylesheet">
    <script src="./js/scripts.js" type="text/javascript" defer></script>
    <title>To Do | <?php echo $title; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">To Do</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="task-view.php">All Tasks</a>
                    </li>
                    <?php
                    // Start session if it hasn't been started yet
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (!empty($_SESSION['username'])) {
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="task-view-auth.php">My Tasks</a>
                        </li>';
                    }
                    ?>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                    if (empty($_SESSION['username'])) {
                        // These items are visible when anonynmous
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>';
                    } else {
                        // These items are visible when authenticated
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>