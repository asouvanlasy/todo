<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <title>To Do List</title>
    </head>
    <body>
        <header>
            <h1>To Do List</h1>
            <h2>A Personal Project by Andrew Souvanlasy</h2>
        </header>
        <main>
            <h3>Add a new task to the list</h3>
            <form method="POST" action="save-todo.php">
                <!-- Text forms -->
                <fieldset class="mb-3 mt-3">
                    <label for="task" class="form-label">Task:</label>
                    <!-- Cannot be empty / max of 100 characters -->
                    <input name="task" id="task" required maxlength="100" class="form-control" placeholder="What needs to be done?"/>
                </fieldset>
                <fieldset class="mb-3 mt-3">
                    <label for="note" class="form-label">Note:</label>
                    <!-- Allowed to be empty / max of 100 characters -->
                    <input name="note" id="note" maxlength="100" class="form-control" placeholder="Any additional info?"/>
                </fieldset>
                <!-- Dropdown for priority -->
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
                                echo '<option value="' . $priority['priorityID'] . '">' . $priority['task'] . '</option>';
                            }
                            
                            $db = null;
                        ?>
                    </select>
                </fieldset>
                <button class="btn btn-primary">Save</button>
            </form>
        </main>
    </body>
</html>