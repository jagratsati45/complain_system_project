<?php
session_start();
$conn = require __DIR__ . "/../config/db.php";
include("../config/department_helper.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$flash_message = $_SESSION['admin_flash_message'] ?? "";
$flash_type = $_SESSION['admin_flash_type'] ?? "";
unset($_SESSION['admin_flash_message'], $_SESSION['admin_flash_type']);

$query = "SELECT complaints.*, users.name AS user_name, departments.name AS dept_name
FROM complaints 
JOIN users ON complaints.user_id = users.id
LEFT JOIN departments ON complaints.department_id = departments.id";

$result = mysqli_query($conn, $query);

$dept_list_query = "SELECT departments.id, departments.name, users.email 
FROM departments
LEFT JOIN users ON users.role='department' AND users.name = departments.name
ORDER BY departments.id DESC";

if (departments_has_user_id($conn)) {
    $dept_list_query = "SELECT departments.id, departments.name, users.email 
    FROM departments
    JOIN users ON departments.user_id = users.id
    ORDER BY departments.id DESC";
}
$dept_list_result = mysqli_query($conn, $dept_list_query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <div class="container">

        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
            <a href="../auth/logout.php" class="logout-btn">Logout</a>
        </div>

        <?php if ($flash_message !== "") { ?>
            <div class="flash-message <?php echo $flash_type === 'success' ? 'flash-success' : 'flash-error'; ?>">
                <?php echo htmlspecialchars($flash_message); ?>
            </div>
        <?php } ?>

        <div class="section-card">
            <div class="section-head">
                <h3>Department Accounts</h3>
                <a href="create_department.php" class="primary-link-btn">Create Department Account</a>
            </div>

            <table class="table-spaced">
                <thead>
                    <tr>
                        <th>Department Name</th>
                        <th>Department Email</th>
                    </tr>
                </thead>
                <tbody>

                <?php if ($dept_list_result && mysqli_num_rows($dept_list_result) > 0) { ?>
                    <?php while ($dept_row = mysqli_fetch_assoc($dept_list_result)) { ?>
                        <tr>
                            <td data-label="Department"><?php echo htmlspecialchars($dept_row['name']); ?></td>
                            <td data-label="Email"><?php echo !empty($dept_row['email']) ? htmlspecialchars($dept_row['email']) : "Not Linked"; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="2">No department accounts found.</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td data-label="User"><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td data-label="Title"><?php echo htmlspecialchars($row['title']); ?></td>
                    <td data-label="Status"><?php echo htmlspecialchars($row['status']); ?></td>

                    <td data-label="Department">
                        <?php
                        echo $row['dept_name'] ? htmlspecialchars($row['dept_name']) : "Not Assigned";
                        ?>
                    </td>

                    <td data-label="Action">
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

            </tbody>
        </table>

    </div>

</body>

</html>