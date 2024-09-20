<!DOCTYPE html>
<html>

<head>
      <title>Student Login </title>
      <link rel="stylesheet" href="index.css">
</head>

<body>
<?php
require_once "studentconfig.php";
?>



      <div class="main">
            <h1>Student Login</h1>
            <h3>Enter your login credentials</h3>
            <form action="student_validate.php" method="POST">
                  <label for="first">
                        Username:
                  </label>
                  <input type="text" 
                         id="username" 
                         name="username" 
                         placeholder="Enter your Username" required>

                  <label for="password">
                        Password:
                  </label>
                  <input type="password"
                         id="password" 
                         name="password"
                         placeholder="Enter your Password" required>

                  <div class="wrap">
                        <button type="submit"
                                onclick="solve()">
                              Submit
                        </button>
                  </div>
            </form>
            <p>
                  <a href="#"
                     style="text-decoration: none;">
                      
                  </a>
            </p>
      </div>
</body>

</html>