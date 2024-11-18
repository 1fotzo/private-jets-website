<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php'); // Redirect to login if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional CSS file -->
</head>
<body>
    <div id="dashboard">
        <header>
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="user_logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        
        <main>
            <section id="welcome">
                <p>This is your user dashboard, where you can manage your account and access features.</p>
            </section>

            <section id="features">
                <h2>Dashboard Features</h2>
                <ul>
                    <li><a href="settings.php">Account Settings</a></li>
                </ul>
            </section>
        </main>
        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Luxury Private Jets. All rights reserved.</p>
        </footer>
    </div>

</body>
</html>

