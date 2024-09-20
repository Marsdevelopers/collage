<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location: student.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Download PDF</title>
    <link rel="stylesheet" href="student_wel.css">
</head>
<body>
    <div class="main">
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<h3>FILES FORM FACULTY</h3>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, filename, filepath FROM files WHERE user_type='faculty'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<a href='" . $row['filepath'] . "' download>" . $row['filename'] . "</a><br>";
    }
} else {
    echo "No files found.";
}

$conn->close();
?>


<div class="btn-group">
<button><a href="student_course.php">course selection</a></button> 
<button><a href="student_project.php">project selection</a></button>
<button><a href="student_project_uplod.php">project upload</a></button>
<button><a href="student_logout.php">Logout</a></button>
</div>
</div>
</body>
</html>


