
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $user_type = 'student';
    $filename = $_FILES['file']['name'];
    $filepath = 'uploads/' . basename($filename);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
        $sql = "INSERT INTO files (user_type, filename, filepath) VALUES ('$user_type', '$filename', '$filepath')";
        if ($conn->query($sql) === TRUE) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload file.";
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
    <link rel="stylesheet" href="stcourse_css.css">
</head>
<body>
<div class="main">

    <form action="student_project_uplod.php" method="post" enctype="multipart/form-data">
        Select PDF to upload:
        <input type="file" name="file" accept=".pdf">
        <input type="submit" value="Upload PDF">
    </form>
   
    </div>
</body>
</html>