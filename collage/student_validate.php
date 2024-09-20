<?php
session_start();
require_once "studentconfig.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    $sql = "SELECT id FROM student WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($link, $sql);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['username'] = $username;
        header("location: student_welcom.php");
    } else{
        echo "Invalid username or password.";
    }
}
?>