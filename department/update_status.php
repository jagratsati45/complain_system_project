<?php
session_start();
include("../config/db.php");
include("../config/department_helper.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'department') {
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: dashboard.php");
    exit();
}

$department_id = get_department_id_for_user($conn, intval($_SESSION['user_id']), $_SESSION['name']);

if ($department_id <= 0) {
    header("Location: dashboard.php");
    exit();
}

$complaint_stmt = $conn->prepare("SELECT id FROM complaints WHERE id=? AND department_id=? LIMIT 1");
$complaint_stmt->bind_param("ii", $id, $department_id);
$complaint_stmt->execute();
$complaint_result = $complaint_stmt->get_result();

if ($complaint_result->num_rows === 0) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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