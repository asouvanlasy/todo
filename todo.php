<?php
$title = 'Tasks';
require 'inc/header.php';
?>

<main class="container pt-5">
    <!-- Display table and apply Bootstrap styling -->
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Task</th>
                <th>Priority</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try
            {
                // Connect to server
                require 'inc/db.php';

                // Read the table
                $sql = "SELECT * FROM todo";
                $sql = "SELECT todo.*, todo_priority.task as 'priorityID' FROM todo INNER JOIN todo_priority ON todo.priorityID = todo_priority.priorityID;";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $todo = $cmd->fetchAll();

                // Loop through table and display
                foreach ($todo as $todo)
                {
                    echo
                    '<tr>
                    <td>
                        <a href="edit-todo.php?taskID=' . $todo['taskID'] . '">' . $todo['task'] . '</a>
                    </td>
                    <td>' . $todo['priorityID'] . '</td>
                    <td>' . $todo['note'] . '</td>
                    <td>
                        <a href="delete-todo.php?taskID=' . $todo['taskID'] . '" class="btn btn-danger"
                            onclick="return confirmDelete()">
                            Delete
                        </a>
                    </td>
                </tr>';
                }
                $db = null;
            }
            catch (Exception $error)
            {
                // Redirect to error page
                header('location:error.php');
            }

            ?>
        </tbody>
    </table>
    <!-- Add button -->
    <form action="add-todo.php">
        <button class="btn btn-primary">Add Task</button>
    </form>
</main>
</body>

</html>