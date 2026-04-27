<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$flash_message = $_SESSION['admin_flash_message'] ?? "";
$flash_type = $_SESSION['admin_flash_type'] ?? "";
unset($_SESSION['admin_flash_message'], $_SESSION['admin_flash_type']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Department</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <div class="container form-container">
        <div class="dashboard-header">
            <h2>Create Department Account</h2>
            <a href="../auth/logout.php" class="logout-btn">Logout</a>
        </div>

        <?php if ($flash_message !== "") { ?>
            <div class="flash-message <?php echo $flash_type === 'success' ? 'flash-success' : 'flash-error'; ?>">
                <?php echo htmlspecialchars($flash_message); ?>
            </div>
        <?php } ?>

        <div class="section-card">
            <form action="create_department_process.php" method="POST">
                <div class="form-grid">
                    <input type="text" name="department_name" placeholder="Department Name" required>
                    <input type="email" name="department_email" placeholder="Department Email" required>
                    <input type="password" name="department_password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="assign-btn top-gap">Create Department</button>
            </form>
        </div>

        <a href="dashboard.php" class="secondary-link-btn">Back to Dashboard</a>
    </div>
</body>

</html>