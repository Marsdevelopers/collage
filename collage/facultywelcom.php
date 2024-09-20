<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location: faculty.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
    <link rel="stylesheet" href="faculty_css.css">
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

    <form action="faculty_upload.php" method="post" enctype="multipart/form-data">
        Select PDF to upload:
        <input type="file" name="file" accept=".pdf">
        <input type="submit" value="Upload PDF">
    </form>
   
    <button><a href="facultylogout.php">Logout</a></button>
</body>
</html>


