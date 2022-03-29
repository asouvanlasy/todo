<?php
require 'inc/auth.php';
$title = 'Edit Task';
require 'inc/header.php';

try {
    // Check for task_pk URL param. If we have one, query db and populate form. If not, show blank form
    $task_pk = null;
    $task = null;
    $note = null;
    $priority = null;

    if (isset($_GET['task_pk'])) {
        if (is_numeric($_GET['task_pk'])) {
            $task_pk = $_GET['task_pk'];

            require 'inc/db.php';

            // Add userId filter so users can only see their own artists
            $userId = $_SESSION['userId'];
            $sql = "SELECT * FROM task WHERE task_pk = :task_pk AND userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':task_pk', $_GET['task_pk'], PDO::PARAM_INT);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
            $cmd->execute();
            // Use fetch(), not fetchAll() for single row queries
            $task = $cmd->fetch();

            if (empty($task)) {
                $db = null;
                header('location:error.php');
                exit();
            } else {
                $task = $task['task'];
                $note = $task['note'];
                $priority = $task['priority'];

                $db = null;
            }
        }
    }
} catch (Exception $error) {
    header('location:error.php');
}
?>

<main class="container pt-5">
    <h3>Edit Task</h3>
    <p class="alert alert-info">A Task and a Priority level are required.</p>
    <form method="POST" action="task-save.php">
        <!-- Textfield for Task (required field) -->
        <fieldset class="form-group mb-3 mt-3">
            <label for="task" class="control-label col-2">Task:</label>
            <input name="task" id="task" class="form-control" required maxlength="100" value="<?php echo $task; ?>" />
        </fieldset>
        <!-- Textfield for Note -->
        <fieldset class="form-group mb-3 mt-3">
            <label for="note" class="control-label col-2">Note:</label>
            <input name="note" id="note" class="form-control" maxlength="100" value="<?php echo $note; ?>" />
        </fieldset>
        <!-- Dropdown selection for Priority (required field) -->
        <fieldset class="form-group mb-3 mt-3">
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
                        if ($priority['priority'] == $priority) {
                            echo '<option selected value="' . $priority['priority'] . '">' . $priority['task'] . '</option>';
                        } else {
                            echo '<option value="' . $priority['priority'] . '">' . $priority['task'] . '</option>';
                        }
                    }

                    $db = null;
                } catch (Exception $error) {
                    header('location:error.php');
                }
                ?>
            </select>
        </fieldset>
        <!-- Include the task_pk in URL -->
        <input type="hidden" name="task_pk" id="task_pk" value="<?php echo $task_pk; ?>" />
        <fieldset class="mb-3 mt-3">
            <button class="btn btn-primary">Save</button>
        </fieldset>
    </form>
</main>
</body>

</html>