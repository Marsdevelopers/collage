<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stcourse_css.css">
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

// Start the session
session_start();

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the student table
    $query = "SELECT * FROM student WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['student_username'] = $username;
        echo "Login successful. Welcome, $username!";
    } else {
        echo "Invalid login credentials.";
    }
}

// If logged in, allow course selection
if (isset($_SESSION['student_username'])) {
    $student_username = $_SESSION['student_username'];

    // Get available courses
    $course_query = "SELECT * FROM courses";
    $courses = $conn->query($course_query);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['select_course'])) {
        $course_id = $_POST['course_id'];

        // Insert the selected course for the student
        $insert_query = "INSERT INTO student_courses (student_username, course_id) VALUES ('$student_username', '$course_id')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Course selected successfully!";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
?>
<div class="main">
    <form method="post" action="">
        <label for="course">Select Course:</label>
        <select name="course_id" id="course">
            <?php while ($row = $courses->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['course_name'] ?></option>
            <?php } ?>
        </select>
        <br>
        <button type="submit" name="select_course">Select Course</button>
    </form>
<?php
} else {
?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit" name="login">Login</button>
    </form>
<?php
}

$conn->close();
?>
</div>
</body>
</html>