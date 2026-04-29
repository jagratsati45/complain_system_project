<?php
session_start();
include("../config/db.php");
include("../config/department_helper.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'department') {
    header("Location: ../login.php");
    exit();
}

$department_id = get_department_id_for_user($conn, intval($_SESSION['user_id']), $_SESSION['name']);

if ($department_id <= 0) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM complaints WHERE department_id=?");
$stmt->bind_param("i", $department_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td data-label="Title"><?php echo htmlspecialchars($row['title']); ?></td>
            <td data-label="Status"><?php echo htmlspecialchars($row['status']); ?></td>
            <td data-label="Action">
                <a href="update_status.php?id=<?php echo $row['id']; ?>">
                    <button class="assign-btn">Update</button>
                </a>
            </td>
        </tr>

        <?php } ?>

        </tbody>
    </table>

</div>

</body>
</html>