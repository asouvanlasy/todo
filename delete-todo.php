<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <title>Task Deleted</title>
    </head>
    <body>
        <header>
            <h1>To Do List</h1>
            <h2>A Personal Project by Andrew Souvanlasy</h2>
        </header>
        <main>
            <h3>Task Deleted</h3>
            <?php
                // Get PK from url param and validate it
                if (isset($_GET['taskID'])) {
                    if (is_numeric($_GET['taskID'])) {
                        require 'db.php';

                        // SQL DELETE
                        $sql = "DELETE FROM todo WHERE taskID = :taskID";
                        $cmd = $db->prepare($sql);
                        $cmd->bindParam(':taskID', $_GET['taskID'], PDO::PARAM_INT);
                        $cmd->execute();

                        $db = null;

                        echo
                            '<div class="alert alert-info">Task has been deleted.
                                <a href="todo.php">Return to To Do list</a>
                            </div>';
                    }
                    else {
                        echo '<div class="alert alert-warning">Task Missing</div>';
                    }
                }
                else {
                    echo '<div class="alert alert-warning">Task Missing</div>';
                }
            ?>
        </main>
    </body>
</html>