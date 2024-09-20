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

// Handle course approval/rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['selection_id']) && isset($_POST['action'])) {
        $selection_id = $_POST['selection_id'];
        $action = $_POST['action'];
        $sql = "UPDATE course_selections SET status='$action' WHERE id='$selection_id'";
        $conn->query($sql);
    }

    // Handle "Clear All" button
    if (isset($_POST['clear_all'])) {
        $sql = "DELETE FROM courses";
        if ($conn->query($sql) === TRUE) {
            echo "All courses deleted successfully.";
        } else {
            echo "Error deleting courses: " . $conn->error;
        }
    }
}

// Fetch pending course selections
$sql = "SELECT cs.id, cs.student_id, c.course_name, cs.status 
        FROM course_selections cs 
        JOIN courses c ON cs.course_id = c.id 
        WHERE cs.status = 'pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approve Project</title>
    <link rel="stylesheet" href="adminappov_css.css">
</head>
<body>
    <div class="main">
    <form action="admin_project_approv.php" method="post">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "Student ID: " . $row['student_id'] . " - Course: " . $row['course_name'] . " - Status: " . $row['status'];
                echo "<input type='hidden' name='selection_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='action' value='approved' class='but'>Approve</button>";
                echo "<button type='submit' name='action' value='rejected' class='rej'>Reject</button><br>";
            }
        } else {
            echo "No pending course selections.";
        }
        ?>
    </form>

    <!-- Clear All Button -->
    <form action="admin_project_approv.php" method="post">
        <button type="submit" name="clear_all" value="true">Clear All Courses</button>
    </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>