<?php

$conn = new mysqli(
    "db",
    "root",
    "root",
    "todolist"
);

if ($conn->connect_error) {
    die ("Connection Failed" . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST["addtask"])) {
        $task = $_POST["task"];
        $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
        $stmt->bind_param("s", $task);
        $stmt->execute();
        header("Location: index.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET["delete"])) {
        $id = $_GET["delete"];
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: index.php");
    }

    if (isset($_GET["complete"])) {
        $id = $_GET["complete"];
        $stmt = $conn->prepare("UPDATE tasks SET status = 'completed' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: index.php");
    }
}

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Todo List</h1>
    <form action="index.php" method="post">
        <input type="text" name="task" placeholder="Enter new task" class="text">
        <button type="submit" name="addtask"> Add Task</button>
    </form>
    <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
            <li class= <?php echo $row["status"]; ?>
                <strong><?php echo $row["task"]; ?></strong>
                <div class="actions">
                    <a href="index.php?complete=<?php echo $row['id']; ?>">Complete</a>
                    <a href="index.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </div>
            </li>
        <?php endwhile ?>
    </ul>
</div>
</body>
</html>
