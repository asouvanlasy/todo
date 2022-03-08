<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
        <script src="./js/scripts.js" type="text/javascript" defer></script>
        <title>To Do List</title>
    </head>
    <body>
        <header>
            <h1>To Do List</h1>
            <h2>A Personal Project by Andrew Souvanlasy</h2>
        </header>
        <main>
            <!-- Display table and apply Bootstrap styling -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Priority</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Connect to server
                        require 'db.php';

                        // Read the table
                        $sql = "SELECT * FROM todo";
                        $sql = "SELECT todo.*, todo_priority.task as 'priorityID' FROM todo INNER JOIN todo_priority ON todo.priorityID = todo_priority.priorityID;";
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $todo = $cmd->fetchAll();

                        // Loop through table and display
                        foreach ($todo as $todo) {
                            echo
                                '<tr>
                                    <td>
                                        <a href="edit-todo.php?taskID='. $todo['taskID'] . '">' . $todo['task'] . '</a>
                                    </td>
                                    <td>' . $todo['priorityID'] . '</td>
                                    <td>' . $todo['note'] . '</td>
                                    <td>
                                        <a href="delete-todo.php?taskID='. $todo['taskID'] . '" class="btn btn-danger"
                                            onclick="return confirmDelete()">
                                            Delete
                                        </a>
                                    </td>
                                </tr>';
                        }
                        $db = null;
                    ?>
                </tbody>
            </table>
            <!-- Add button -->
            <form action="add-todo.php">
                <button class="btn btn-primary">Add a Task</button>
            </form>
        </main>
    </body>
</html>