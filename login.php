<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login page</title>
    <link rel="stylesheet" href="login.css" />

</head>

<body>
    <div id="div">
        <form id="loginForm" class="login-form">
            <h1>Login</h1>
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required /><br />

            <label for="Password">Password</label><br />
            <input
                type="password"
                name="password"
                placeholder="Password"
                required /><br />

            <button type="submit">Login</button>
            <p class="register-link">
                Don't have an account?<a href="register.php">Register</a>
            </p>
        </form>
    </div>
    <div id="alert-container" class="right-side-pop"></div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("auth/login_process.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    console.log("Server:", data);

                    if (data === "admin") {
                        showToast("Admin login successful");
                        setTimeout(() => {
                            window.location.href = "admin/dashboard.php";
                        }, 1000);
                    } else if (data === "user") {
                        showToast("Login successful");
                        setTimeout(() => {
                            window.location.href = "user/dashboard.php";
                        }, 1000);
                    } else if (data === "department") {
                        showToast("Department login successful");
                        setTimeout(() => {
                            window.location.href = "department/dashboard.php";
                        }, 1000);
                    } else if (data === "invalid") {
                        showToast("Invalid email or password");
                    } else {
                        showToast("Error: " + data);
                    }
                })
                .catch(err => {
                    console.error(err);
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