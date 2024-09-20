<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="admin_css.css">
   
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
   
    
   
    <button ><a href="admin_add_student.php">ADD STUDENT </a></button>
    <button ><a href="admin_add_faculty.php">ADD FACULTY </a></button>
    <button><a href="view_course.php"> Courses Status  </a></button>
    <button><a href="admin_add_project.php">Add Project</a></button>
    <button><a href="admin_project_approv.php"> Project Approval</a></button>
    
    <button><a href="admin_project_uplod.php">Project Uploads </a></button>
    <button><a href="adminlogout.php">Logout</a></button>
    
</body>
</html>