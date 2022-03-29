<?php
require 'inc/auth.php';
$title = 'Delete Task';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h3>Task Deleted</h3>
    <?php
    try {
        // Get PK from url param and validate it
        if (isset($_GET['taskID'])) {
            if (is_numeric($_GET['taskID'])) {
                require 'inc/db.php';

                // Delete task
                $sql = "DELETE FROM todo WHERE taskID = :taskID AND userId = :userId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':taskID', $_GET['taskID'], PDO::PARAM_INT);
                $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
                $cmd->execute();

                $db = null;

                echo'
                <div class="alert alert-info">Task has been deleted.
                    <a href="todo.php">Return to To Do list</a>
                </div>';
            } else {
                echo '<div class="alert alert-warning">Task Missing</div>';
            }
        } else {
            echo '<div class="alert alert-warning">Task Missing</div>';
        }
    } catch (Exception $error) {
        header('location:error.php');
    }
    ?>
</main>
</body>

</html>