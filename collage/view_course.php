<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_css.css">
</head>
<body>
    



<?php
// Connect to the database
$servername = "localhost";
$username = "root";  // Replace with your DB username
$password = "";  // Replace with your DB password
$dbname = "student_";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the courses selected by students
$query = "SELECT student_courses.student_username, courses.course_name 
          FROM student_courses
          JOIN courses ON student_courses.course_id = courses.id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Student Username</th><th>Selected Course</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['student_username'] . "</td><td>" . $row['course_name'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No courses selected yet.";
}

$conn->close();
?>


</body>
</html>