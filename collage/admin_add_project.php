<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['course_name'])) {
    $course_name = $_POST['course_name'];
    $sql = "INSERT INTO courses (course_name) VALUES ('$course_name')";
    if ($conn->query($sql) === TRUE) {
        echo "Project added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_css.css">
</head>
<body>
    <h1>Enter project names for Students</h1>
<div class="main">
<form action="admin_add_project.php" method="post">
        Project Name: <input type="text" name="course_name" required>
        <input type="submit" value="ADD PROJECT">
    </form>
    </div>
</body>
</html>