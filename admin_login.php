<?php
// Start the session
session_start();

// Include the database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the input
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Password entered by the admin

    // Query to fetch the admin by username
    $query = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch the admin record
        $admin = $result->fetch_assoc();

        // Verify the password using password_verify()
        if (password_verify($password, $admin['password'])) {
            // Successful login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id']; // Store the admin's ID in the session
            header('Location: admin_dashboard.php'); // Redirect to admin dashboard
            exit();
        } else {
            // Incorrect password
            $error = "Invalid username or password.";
        }
    } else {
        // No admin found with the given username
        $error = "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="admin_login.css"> <!-- New Admin Specific Styles -->
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Admin Login</h1>
    </header>

    <!-- Main Content -->
    <main class="admin-login">
        <form action="admin_login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" class="btn">Login</button>
        </form>
    </main>

</body>
</html>

