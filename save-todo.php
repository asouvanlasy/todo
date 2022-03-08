<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <title>Task Saved</title>
    </head>
    <body>
        <header>
            <h1>To Do List</h1>
            <h2>A Personal Project by Andrew Souvanlasy</h2>
        </header>
        <main>
            <h3>Task Saved</h3>
            <a href="todo.php">Return to To Do List</br></a>
            <?php
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
                else {
                    if (strlen($task) > 100 || strlen($note) > 100) {
                        echo "Reached maximum characters of 100.";
                        $ok = false;
                    }
                }
                // Ensure dropdown selection isn't empty
                if (empty($priorityID)) {
                    echo "A priority level is required.<br/>";
                    $ok = false;
                }
                // Ensure dropdown isn't 0
                else {
                    if (!is_numeric($priorityID) || $priorityID < 1) {
                        echo "Priority must be a number greater than zero.<br>";
                        $ok = false;
                    }
                }

                // If form is valid, run this block
                if ($ok) {
                    require 'db.php';

                    if (empty($taskID)) {
                        $sql = "INSERT INTO todo (task, priorityID, note) VALUES (:task, :priorityID, :note)";
                    }
                    else {
                        $sql = "UPDATE todo SET task = :task, priorityID = :priorityID, note = :note WHERE taskID = :taskID";
                    }
                    
                    // INSERT INTO table
                    $sql = "INSERT INTO todo (priorityID, task, note) VALUES (:priorityID, :task, :note)";

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
            ?>
        </main>
    </body>
</html>