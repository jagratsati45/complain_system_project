<?php
session_start();
include("../config/db.php");

// security
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];

// get departments
$dept = mysqli_query($conn, "SELECT * FROM departments");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Assign Complaint</title>
    <link rel="stylesheet" href="../assets/css/assign.css">
</head>
<body>
<div class="container">

    <h2>Assign Department</h2>

    <div class="form-box">

        <label>Select Department</label>

        <form action="assign_department.php" method="POST">

            <input type="hidden" name="complaint_id" value="<?php echo $id; ?>">

            <div class="form-row">

                <select name="department_id">
                    <?php while ($d = mysqli_fetch_assoc($dept)) { ?>
                        <option value="<?php echo $d['id']; ?>">
                            <?php echo $d['name']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit">Assign</button>

            </div>

        </form>

        <button class="back-btn" onclick="window.location.href='dashboard.php'">
            Back
        </button>

    </div>

</div>

</body>
</html>