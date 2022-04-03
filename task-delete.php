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
        if (isset($_GET['task_pk'])) {
            if (is_numeric($_GET['task_pk'])) {
                require 'inc/db.php';

                $userId = $_SESSION['userId'];
                
                // Delete task
                $sql = "DELETE FROM task WHERE task_pk = :task_pk AND userId = :userId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':task_pk', $_GET['task_pk'], PDO::PARAM_INT);
                $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
                $cmd->execute();

                $db = null;

                echo'
                <div class="alert alert-info">Task has been deleted.
                    <a href="task-view-auth.php">Return to To Do list</a>
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