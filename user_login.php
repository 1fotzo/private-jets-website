<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Fetch user details
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Set a cookie if "Remember Me" is checked
            if (isset($_POST['remember_me'])) {
                setcookie('user_id', $user['id'], time() + (86400 * 30), "/");
                setcookie('username', $user['username'], time() + (86400 * 30), "/");
            }

            // Redirect to the page specified by the redirect parameter, or default to 'index.php'
            $redirect_url = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';

            header('Location: ' . $redirect_url); // Redirect to the specified URL
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="login-page"> <!-- Added container for scoping -->
        <h2>User Login</h2>
        <form method="POST" action="user_login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label>
                <input type="checkbox" name="remember_me"> Remember Me
            </label>
            
            <button type="submit">Login</button>
        </form>

        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <div>
            <!-- Home Button -->
            <a href="index.php"><button type="button">Home</button></a>
            <!-- Create Account Button -->
            <a href="user_register.php"><button type="button">Create Account</button></a>
        </div>
    </div>
</body>
</html>


