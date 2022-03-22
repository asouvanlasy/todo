<?php
$title = 'Edit Task';
require 'inc/header.php';

try {
    // Check for taskID URL param. If we have one, query db and populate form. If not, show blank form
    $taskID = null;
    $task = null;
    $note = null;
    $priorityID = null;

    if (isset($_GET['taskID'])) {
        if (is_numeric($_GET['taskID'])) {
            $taskID = $_GET['taskID'];

            require 'inc/db.php';

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
} catch (Exception $error) {
    header('location:error.php');
}
?>

<main class="container pt-5">
    <h3>Edit Task</h3>
    <p class="alert alert-info">A Task and a Priority level are required.</p>
    <form method="POST" action="save-todo.php">
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
            <label for="priorityID" class="form-label">Priority:</label>
            <select name="priorityID" id="priorityID" class="form-control">
                <?php
                try {
                    require 'inc/db.php';
                    $sql = "SELECT * FROM todo_priority";

                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $todo_priority = $cmd->fetchAll();

                    foreach ($todo_priority as $priority) {
                        if ($priority['priorityID'] == $priorityID) {
                            echo '<option selected value="' . $priority['priorityID'] . '">' . $priority['task'] . '</option>';
                        } else {
                            echo '<option value="' . $priority['priorityID'] . '">' . $priority['task'] . '</option>';
                        }
                    }

                    $db = null;
                } catch (Exception $error) {
                    header('location:error.php');
                }
                ?>
            </select>
        </fieldset>
        <!-- Include the taskID in URL -->
        <input type="hidden" name="taskID" id="taskID" value="<?php echo $taskID; ?>" />
        <fieldset class="mb-3 mt-3">
            <button class="btn btn-primary">Save</button>
        </fieldset>
    </form>
</main>
</body>

</html>