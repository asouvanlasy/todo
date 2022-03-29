<?php
require 'inc/auth.php';
$title = 'My Tasks';
require 'inc/header.php';
?>

<main class="container pt-5">
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
            try {
                // Connect to server
                require 'inc/db.php';

                // Read the table and filter by authenticated user
                $sql = "SELECT task.*, task_priority.task as 'priority_pk' FROM task
                        INNER JOIN task_priority ON task.priority = task_priority.priority
                        WHERE userId = :userId";
                $cmd = $db->prepare($sql);
                $cmd->bindValue('userId', $_SESSION['userId'], PDO::PARAM_INT);
                $cmd->execute();
                $task = $cmd->fetchAll();

                // Loop through table and display
                foreach ($task as $task) {
                    echo '
                    <tr>
                        <td>
                            <a href="task-edit.php?task_pk=' . $task['task_pk'] . '">' . $task['task_pk'] . '</a>
                        </td>
                        <td>' . $task['priority'] . '</td>
                        <td>' . $task['note'] . '</td>
                        <td>
                            <a href="task-delete.php?taskID=' . $task['task_pk'] . '" class="btn btn-danger"
                                onclick="return confirmDelete()">
                                Delete
                            </a>
                        </td>
                    </tr>';
                }
                $db = null;
            } catch (Exception $error) {
                // Redirect to error page
                header('location:error.php');
            }
            ?>
        </tbody>
    </table>
    <!-- If user is authenticated, show add task button -->
    <?php
    if (!empty($_SESSION['username'])) {
        echo '
        <form action="task-add.php">
            <button class="btn btn-primary">Add Task</button>
        </form>';
    }
    ?>
</main>
</body>

</html>