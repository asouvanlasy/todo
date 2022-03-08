<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <title>Edit Club</title>
    </head>
    <?php
        // Check for taskID URL param. If we have one, query db and populate form. If not, show blank form
        $taskID = null;
        $task = null;
        $note = null;
        $priorityID = null;

        if (isset($_GET['taskID'])) {
            if (is_numeric($_GET['taskID'])) {
                $taskID = $_GET['taskID'];

                require 'db.php';
                
                $sql = "SELECT * FROM todo WHERE taskID = :taskID";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':taskID', $_GET['taskID'], PDO::PARAM_INT);
                $cmd->execute();

                // Use fetch(), not fetchAll() for single row queries
                $todo = $cmd->fetch();
                $task = $todo['task'];
                $note = $todo['note'];
                $priorityID = $todo['priorityID'];
                
                $db = null;
            }
        }
    ?>
    <body>
        <header>
            <h1>To Do List</h1>
            <h2>A Personal Project by Andrew Souvanlasy</h2>
        </header>
        <main>
            <h3>Edit Task</h3>
            <p class="alert alert-info">A Task and a Priority level are required.</p>
            <form method="POST" action="save-todo.php">
                <!-- Textfield for Task (required field) -->
                <fieldset class="form-group m-1">
                    <label for="task" class="control-label col-2">Task:</label>
                    <input name="task" id="task" required maxlength="100" value="<?php echo $task; ?>"/>
                </fieldset>
                <!-- Textfield for Note -->
                <fieldset class="form-group m-1">
                    <label for="note" class="control-label col-2">Note:</label>
                    <input name="note" id="note" maxlength="100" value="<?php echo $note; ?>"/>
                </fieldset>
                <!-- Dropdown selection for Priority (required field) -->
                <fieldset class="mb-3 mt-3">
                    <label for="priorityID" class="form-label">Priority:</label>
                    <select name="priorityID" id="priorityID">
                        <?php
                            require 'db.php';
                            $sql = "SELECT * FROM todo_priority";

                            $cmd = $db->prepare($sql);
                            $cmd->execute();
                            $todo_priority = $cmd->fetchAll();

                            foreach ($todo_priority as $priority) {
                                if ($priority['priorityID'] == $priorityID) {
                                    echo '<option selected value="' . $priority['priorityID'] . '">' . $priority['task'] . '</option>';
                                }
                                else {
                                    echo '<option value="' . $priority['priorityID'] . '">' . $priority['task'] . '</option>';
                                }
                            }
                            
                            $db = null;
                        ?>
                    </select>
                </fieldset>
                <!-- Include the taskID in URL -->
                <input type="hidden" name="taskID" id="taskID" value="<?php echo $taskID; ?>"/>
                <button class="btn btn-primary offset-2 mt-2">Save</button>
            </form> 
        </main>
    </body>
</html>