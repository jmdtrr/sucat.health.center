<?php
// Database configuration
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "sucat_appointment"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $doctorID = $_POST['doctorID'];
    $name = $_POST['name'];

    
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE doctorID = ? AND name = ?");
    $stmt->bind_param("is", $doctorID, $name);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows > 0) {
        
        echo "<script>window.location.href='dashboard.php';</script>";
    } else {
       
        echo "<script>alert('Invalid Doctor ID or Full Name. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
