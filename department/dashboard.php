<?php
session_start();
include("../config/db.php");

// security
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'department') {
    header("Location: ../login.php");
    exit();
}

// Look up the department_id for the logged-in department user
$dept_user_id = $_SESSION['user_id'];
$dept_stmt = $conn->prepare("SELECT id FROM departments WHERE user_id=?");
$dept_stmt->bind_param("i", $dept_user_id);
$dept_stmt->execute();
$dept_result = $dept_stmt->get_result();
$dept_row = $dept_result->fetch_assoc();

$department_id = $dept_row ? $dept_row['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM complaints WHERE department_id=?");
$stmt->bind_param("i", $department_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Department Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container">

    <div class="dashboard-header">
        <h2>Department Dashboard</h2>
        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </div>

    <table>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td>
                <a href="update_status.php?id=<?php echo $row['id']; ?>">
                    <button class="assign-btn">Update</button>
                </a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>