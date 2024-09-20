<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course_";

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
        echo "Course added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

