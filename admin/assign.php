<?php
session_start();
$conn = require __DIR__ . "/../config/db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: dashboard.php");
    exit();
}

$complaint_stmt = $conn->prepare("SELECT id FROM complaints WHERE id=? LIMIT 1");
$complaint_stmt->bind_param("i", $id);
$complaint_stmt->execute();
$complaint_result = $complaint_stmt->get_result();

if ($complaint_result->num_rows === 0) {
    header("Location: dashboard.php");
    exit();
}

$dept = mysqli_query($conn, "SELECT * FROM departments");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <?php echo htmlspecialchars($d['name']); ?>
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