<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$query = "SELECT complaints.*, users.name AS user_name, departments.name AS dept_name
FROM complaints 
JOIN users ON complaints.user_id = users.id
LEFT JOIN departments ON complaints.department_id = departments.id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <div class="container">

        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
            <a href="../auth/logout.php" class="logout-btn">Logout</a>
        </div>

        <table>
            <tr>
                <th>User</th>
                <th>Title</th>
                <th>Status</th>
                <th>Department</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>

                    <td>
                        <?php
                        echo $row['dept_name'] ? htmlspecialchars($row['dept_name']) : "Not Assigned";
                        ?>
                    </td>

                    <td>
                        <?php
                        if ($row['status'] == 'Resolved') {
                            echo "<span style='color:green; font-weight:bold;'>✔ Completed</span>";
                        } else {
                        ?>
                            <a href="assign.php?id=<?php echo $row['id']; ?>">
                                <button class="assign-btn">Assign</button>
                            </a>
                        <?php } ?>
                    </td>
                </tr>

            <?php } ?>

        </table>

    </div>

</body>

</html>