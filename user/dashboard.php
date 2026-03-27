<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/db.php");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM complaints WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);
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

        <!-- Welcome -->
        <h2>Welcome, User 👋</h2>

        <!-- Add Complaint Button -->
        <button class="add-btn" onclick="window.location.href='add_complaint.php'">
            Add Complaint
        </button>

        <!-- Table -->
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
                            <td><?php echo $row['title']; ?></td>

                            <td class="<?php echo strtolower($row['status']); ?>">
                                <?php echo $row['status']; ?>
                            </td>

                            <td><?php echo $row['created_at']; ?></td>

                            <td><a href="view_complaint.php?id=<?php echo $row['id']; ?>">
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
