<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department') {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Status</title>
    <link rel="stylesheet" href="../assets/css/assign.css">
</head>
<body>

<div class="container">
    <h2>Update Complaint Status</h2>

    <div class="form-box">
        <form action="update_status_process.php" method="POST">

            <input type="hidden" name="complaint_id" value="<?php echo $id; ?>">

            <label>Select Status</label>
            <div class="form-row">
                <select name="status">
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                </select>

                <button type="submit">Update</button>
            </div>
        </form>

        <button class="back-btn" onclick="window.location.href='dashboard.php'">
            Back
        </button>
    </div>
</div>

</body>
</html>