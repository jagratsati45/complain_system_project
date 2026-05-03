<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit();
}

$conn = require __DIR__ . "/../config/db.php";

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM complaints WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <div class="container">
        <div class="dashboard-header">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?> 👋</h2>
            <a href="../auth/logout.php" class="logout-btn">Logout</a>
        </div>
        <button class="add-btn" onclick="window.location.href='add_complaint.php'">
            Add Complaint
        </button>
        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th>Complaint Title</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <tr>
                            <td data-label="Title"><?php echo htmlspecialchars($row['title']); ?></td>

                            <td data-label="Status" class="<?php echo strtolower($row['status']); ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </td>

                            <td data-label="Date"><?php echo htmlspecialchars($row['created_at']); ?></td>

                            <td data-label="Action"><a href="view_complaint.php?id=<?php echo $row['id']; ?>">
                                    <button class="view-btn">View</button>
                                </a></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>