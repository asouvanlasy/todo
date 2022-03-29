<?php
require 'inc/auth.php';
$title = 'Save Task';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h1 class="alert alert-success">Task Saved</h1>
    <a href="todo.php">Return to To Do List</a>
    <?php
    try {
        // Declare local variables
        $priorityID = $_POST['priorityID'];
        $taskID = $_POST['taskID'];
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
        if (empty($priorityID)) {
            echo "A priority level is required.<br/>";
            $ok = false;
        }
        // Ensure dropdown isn't 0
        if (!is_numeric($priorityID) || $priorityID < 1) {
            echo "Priority must be a number greater than zero.<br>";
            $ok = false;
        }

        // If form is valid, run this block
        if ($ok) {
            require 'inc/db.php';

            if (empty($taskID)) {
                $sql = "INSERT INTO todo (task, priorityID, note) VALUES (:task, :priorityID, :note)";
            } else {
                $sql = "UPDATE todo SET task = :task, priorityID = :priorityID, note = :note WHERE taskID = :taskID";
            }

            $cmd = $db->prepare($sql);

            // Link the forms to the corresponding table column
            $cmd->bindParam(':task', $task, PDO::PARAM_STR, 100);
            $cmd->bindParam(':priorityID', $priorityID, PDO::PARAM_INT);
            $cmd->bindParam(':note', $note, PDO::PARAM_STR, 100);

            if (!empty($taskID)) {
                $cmd->bindParam(':taskID', $taskID, PDO::PARAM_INT);
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