<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel = "stylesheet" href = "styles.css">
            <title>todo_list</title>
        </head>
        <body>
            <div class = "main_container">
                <div class = "left_container">
                    <div>
                        <h1>To-Do List</h1>
                        <p>New Task</p>
                    </div>
                </div>
                <div class = "right_container">
                    <div class = "new_task">
                        <h1>New Task</h1>
                        <form action = "add_task.php" method = "POST">
                            <input class = "input_task" name = "task_name" type ="text" placeholder = "Task" required/>
                            <button class = "add_task" type = "submit">Add Task</button>
                        </form>
                    </div>
                    <div class = "task_lists">
                        <h1>Task Lists</h1>
                        <?php
                            $stmt = $conn->query("SELECT * FROM tasks WHERE is_completed = 0");
                            $tasks = $stmt->fetchAll();
                                foreach ($tasks as $task) {
                        ?>
                            <div class = "all_tasks">
                                <p><?= $task['task_name'] ?></p>
                                <div class = "button">
                                    <form action = "complete_task.php" method ="POST">
                                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                        <button class = "complete" type ="submit">Complete</button>
                                    </form>

                                    <form action = "delete_task.php" method = "POST">
                                        <input type="hidden" name="id" value="<?=$task['id'] ?>">
                                        <button class = "delete" type ="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <h1>Completed Tasks</h1>
                        <?php
                            $stmt = $conn->query("SELECT * FROM tasks WHERE
                            is_completed = 1");
                            $tasks = $stmt->fetchAll();
                            foreach ($tasks as $task) {
                        ?>
                        <div class = "completed_tasks">
                            <p><?= $task['task_name'] ?></p>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
    </body>
</html>