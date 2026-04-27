<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Department Login</title>
    <link rel="stylesheet" href="../login.css" />
</head>

<body>
    <div id="div">
        <form id="departmentLoginForm" class="login-form">
            <h1>Department Login</h1>
            <input type="hidden" name="login_type" value="department">

            <label>Email</label>
            <input type="email" name="email" placeholder="Department Email" required /><br />

            <label for="Password">Password</label><br />
            <input type="password" name="password" placeholder="Password" required /><br />

            <button type="submit">Login</button>

            <p class="register-link">
                Admin or User? <a href="../login.php">Go to Main Login</a>
            </p>
        </form>
    </div>

    <div id="alert-container" class="right-side-pop"></div>

    <script>
        document.getElementById("departmentLoginForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("../auth/login_process.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    if (data === "department") {
                        showToast("Department login successful");
                        setTimeout(() => {
                            window.location.href = "dashboard.php";
                        }, 1000);
                    } else if (data === "invalid_department") {
                        showToast("Only department accounts are allowed here");
                    } else if (data === "department_not_linked") {
                        showToast("Department account not linked. Contact admin.");
                    } else if (data === "invalid") {
                        showToast("Invalid email or password");
                    } else if (data === "empty") {
                        showToast("Please fill in all fields");
                    } else if (data === "invalid_email") {
                        showToast("Invalid email format");
                    } else {
                        showToast("Error: " + data);
                    }
                })
                .catch(() => {
                    showToast("Something went wrong");
                });
        });

        function showToast(message) {
            let toast = document.getElementById("alert-container");
            toast.innerText = message;
            toast.classList.add("show");

            setTimeout(() => {
                toast.classList.remove("show");
            }, 3000);
        }
    </script>
</body>

</html>