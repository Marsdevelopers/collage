
<!DOCTYPE html>
<html>
<head>
    <title>Download PDF</title>
    <link rel="stylesheet" href="adminappov_css.css">
    
</head>
<body>
   <div class="main">
    <h1>FILES FORM STUDENTS</h1>

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

$sql = "SELECT id, filename, filepath FROM files WHERE user_type='student'";
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

</div>
</body>
</html>