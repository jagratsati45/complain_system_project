<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Complaint</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>

<div class="container">
    <form  action="add_complaint_process.php" method="POST" class="complaint-form">
        <h2>Add Complaint</h2>

        <label>Problem Title</label>
        <input type="text"  name="title" placeholder="Enter your related problem here" required>

        <label>Description</label>
        <textarea rows="5"  name="description" placeholder="Enter your problem in detail" required></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>