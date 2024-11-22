<?php
include 'db_connection.php';

// Handle Delete for Patients
if (isset($_POST['delete_patient'])) {
    $patientID = $_POST['patientID'];
    $sql = "DELETE FROM patient WHERE patientID = $patientID";
    if ($conn->query($sql)) {
        echo "<script>alert('Patient deleted successfully!'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting patient.');</script>";
    }
}

// Handle Delete for Appointments
if (isset($_POST['delete_appointment'])) {
    $appointmentID = $_POST['appointmentID'];
    $sql = "DELETE FROM appointments WHERE appointmentID = $appointmentID";
    if ($conn->query($sql)) {
        echo "<script>alert('Appointment deleted successfully!'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting appointment.');</script>";
    }
}

// Fetch data from the tables
$patients_result = $conn->query("SELECT * FROM patient");   
$appointments_result = $conn->query("SELECT * FROM appointments");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">

    <header class="d-flex justify-content-between align-items-center p-30 bg-primary border border-dark border-start-30 rounded-end">
            <img src="img/logo.png" alt="logo" class="logo"> 
            <h1 class="title outlined-text">Sucat Health Center <br>Appointment</h1>
            <img src="img/logo2.png" alt="logo2" class="logo2"> 
        </header>

        <header class="d-flex justify-content-between align-items-center bg-warning p-3 border border-dark">
            <h1 class="text-light outlined-text ">Admin Dashboard</h1>
            <a href="doctorLogin.html" class="btn btn-danger border border-dark text-light ">Log Out</a>
        </header>

        <!-- Patients Table -->
        <main class="mt-4">
            <section id="patients-table" class="bg-primary border border-dark">
                <h2 class=" text text-center  text-warning outlined-text">Patients Table</h2>
                <div class="table-responsive " style="max-width: 1000px; margin: 0 auto;">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>Birthdate</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php if ($patients_result->num_rows > 0): ?>
        <?php while ($row = $patients_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['patientID']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['password']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
                <td><?php echo htmlspecialchars($row['birthdate']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                <td>
                    <!-- Delete Form -->
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="patientID" value="<?php echo htmlspecialchars($row['patientID']); ?>">
                        <button type="submit" name="delete_patient" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <!-- Update Form -->
                    <form method="GET" action="edit_patient.php" style="display:inline-block;">
                        <input type="hidden" name="patientID" value="<?php echo htmlspecialchars($row['patientID']); ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="9" class="text-center">No patients found</td>
        </tr>
    <?php endif; ?>
</tbody>

                    </table>
                </div>
            </section>
        </main>


        <!-- Appointments Table -->
        <main class="mt-4">
            <section id="appointments-table" class="bg-primary border border-dark">
                <h2 class=" text text-center  text-warning outlined-text">Appointments Table</h2>
                <div class="table-responsive " style="max-width: 1000px; margin: 0 auto;">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Appointment ID</th>
                                <th>Name</th>                               
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php if ($appointments_result->num_rows > 0): ?>
        <?php while ($row = $appointments_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['appointmentID']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><?php echo htmlspecialchars($row['time']); ?></td>
                <td><?php echo htmlspecialchars($row['appointmentType']); ?></td>
                <td><?php echo htmlspecialchars($row['reason']); ?></td>
                
                    <!-- Delete Form -->
                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="appointmentID" value="<?php echo htmlspecialchars($row['appointmentID']); ?>">
                        <button type="submit" name="delete_appointment" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <!-- Update Form -->
                    <form method="GET" action="edit_appointment.php" style="display:inline-block;">
                        <input type="hidden" name="appointmentID" value="<?php echo htmlspecialchars($row['appointmentID']); ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="9" class="text-center">No Appointments found</td>
        </tr>
    <?php endif; ?>
</tbody>

                    </table>
                </div>
            </section>
        </main>

        <footer class="text-center mt-4">
            <p>&copy; 2024 Sucat Health Center. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
