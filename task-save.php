<?php
require 'inc/auth.php';
$title = 'Save Task';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h1 class="alert alert-success">Task Saved</h1>
    <a href="task-view.php">Return to To Do List</a>
    <?php
    try {
        // Declare local variables
        $priority = $_POST['priority'];
        $task_pk = $_POST['task_pk'];
        $task = trim($_POST['task']);
        $note = trim($_POST['note']);

        // Flag for form validation
        $ok = true;

        // Ensure string isn't empty
        if (empty($task)) {
            echo "A task is required.<br/>";
            $ok = false;
        }
        // Ensure string isn't too long
        if (strlen($task) > 100 || strlen($note) > 100) {
            echo "Reached maximum characters of 100.";
            $ok = false;
        }
        // Ensure dropdown selection isn't empty
        if (empty($priority)) {
            echo "A priority level is required.<br/>";
            $ok = false;
        }
        // Ensure dropdown isn't 0
        if (!is_numeric($priority) || $priority < 1) {
            echo "Priority must be a number greater than zero.<br>";
            $ok = false;
        }

        // If form is valid, run this block
        if ($ok) {
            require 'inc/db.php';

            // Set user var from session var
            $userId = $_SESSION['userId'];

            if (empty($task_pk)) {
                $sql = "INSERT INTO task (task, priority, note, userId) VALUES (:task, :priority, :note :userId)";
            } else {
                $sql = "UPDATE task SET task = :task, priority = :priority, note = :note, userId = :userId WHERE task_pk = :task_pk";
            }

            // Link the forms to the corresponding table column
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':task', $task, PDO::PARAM_STR, 100);
            $cmd->bindParam(':priority', $priority, PDO::PARAM_INT);
            $cmd->bindParam(':note', $note, PDO::PARAM_STR, 100);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);

            if (!empty($task_pk)) {
                $cmd->bindParam(':task_pk', $task_pk, PDO::PARAM_INT);
            }

            $cmd->execute();

            $db = null;
        }
    } catch (Exception $error) {
        header('location:error.php');
    }
    ?>
</main>
</body>

</html>