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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['courses'])) {
    $student_id= 1; //  student ID
    foreach ($_POST['courses'] as $course_id) {
        $sql = "INSERT INTO course_selections (student_id, course_id) VALUES ('$student_id', '$course_id')";
        $conn->query($sql);
    }
    echo "Project selected successfully.";
}

$sql = "SELECT id, course_name FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select project</title>
    <link rel="stylesheet" href="stcourse_css.css">
</head>
<body>
    <div class="main">
    <form action="student_project.php" method="post">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<input type='checkbox' name='courses[]' value='" . $row['id'] . "'>" . $row['course_name'] . "<br>";
            }
        } else {
            echo "No courses available.";
        }
        ?>
        <input type="submit" value="Submit">
    </form>
    </div>
</body>
</html>



<?php
$conn->close();
?>






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


$student_id = 1; //  student ID
$sql = "SELECT c.course_name, cs.status 
        FROM course_selections cs 
        JOIN courses c ON cs.course_id = c.id 
        WHERE cs.student_id = '$student_id' AND cs.status !='pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Project Status</title>
</head>
<body>
    <h2>Project Selection Status</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "Course: " . $row['course_name'] . " - Status: " . $row['status'] . "<br>";
        }
    } else {
        echo "No course selections found.";
    }
    ?>
</body>
</html>

<?php
$conn->close();
?>