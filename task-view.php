<?php
$title = 'Tasks';
require 'inc/header.php';
?>

<main class="container pt-5">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Task</th>
                <th>Priority</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                // Connect to server
                require 'inc/db.php';

                // Read the table
                $sql = "SELECT task.*, task_priority.task as 'priority' FROM task
                        INNER JOIN task_priority ON task.priority = task_priority.priority";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $task = $cmd->fetchAll();

                // Loop through table and display
                foreach ($task as $task) {
                    echo '
                    <tr>
                        <td>' . $task['task'] . '</td>
                        <td>' . $task['priority'] . '</td>
                        <td>' . $task['note'] . '</td>
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
</main>
</body>

</html>