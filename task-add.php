<?php
require 'inc/auth.php';
$title = 'Add Task';
require 'inc/header.php';
?>

<main class="container pt-5">
    <h3>Add a new task to the list</h3>
    <form method="POST" action="task-save.php">
        <!-- Text forms -->
        <fieldset class="mb-3 mt-3">
            <label for="task" class="form-label">Task:</label>
            <!-- Cannot be empty / max of 100 characters -->
            <input name="task" id="task" required maxlength="100" class="form-control" placeholder="What needs to be done?" />
        </fieldset>
        <fieldset class="mb-3 mt-3">
            <label for="note" class="form-label">Note:</label>
            <!-- Allowed to be empty / max of 100 characters -->
            <input name="note" id="note" maxlength="100" class="form-control" placeholder="Any additional info?" />
        </fieldset>
        <!-- Dropdown for priority -->
        <fieldset class="mb-3 mt-3">
            <label for="priority" class="form-label">Priority:</label>
            <select name="priority" id="priority" class="form-control">
                <?php
                try {
                    require 'inc/db.php';
                    
                    $sql = "SELECT * FROM task_priority";

                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $task_priority = $cmd->fetchAll();

                    foreach ($task_priority as $priority) {
                        echo '<option value="' . $priority['priority'] . '">' . $priority['task'] . '</option>';
                    }

                    $db = null;
                } catch (Exception $error) {
                    header('location:error.php');
                }
                ?>
            </select>
        </fieldset>
        <fieldset class="mb-3 mt-3">
            <button class="btn btn-primary">Save</button>
        </fieldset>
    </form>
</main>
</body>

</html>