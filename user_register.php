<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div id="register-page"> <!-- Added container for scoping -->
        <main>
            <h2>Register</h2>
            <form action="user_register_process.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" class="btn">Submit</button>
            </form>

            <div>
                <p>Already have an account?</p>
                <a href="user_login.php"><button type="button" class="btn">Login</button></a>
            </div>
        </main>
    </div>
</body>
</html>
