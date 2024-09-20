
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $user_type = 'faculty';
    $filename = $_FILES['file']['name'];
    $filepath = 'upload/' . basename($filename);

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