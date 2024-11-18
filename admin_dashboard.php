<?php
// Include the database connection and session management
include 'db_connect.php';
session_start();

// Check if the user is an admin, otherwise redirect to login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Fetch all jets from the database
$query = "SELECT * FROM jets";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Jets</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="admin_dashboard.css"> <!-- New Admin Dashboard Specific Styles -->
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="admin_logout.php">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="admin-dashboard">
        <section id="jet-list">
            <h2>Manage Jets</h2>
            <p><a href="create_jet.php" class="btn">Add New Jet</a></p>
            
            <!-- Display all jets -->
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Manufacturer</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Range</th>
                            <th>Speed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['model_name']; ?></td>
                                <td><?php echo $row['manufacturer']; ?></td>
                                <td>$<?php echo number_format($row['price']); ?></td>
                                <td><?php echo $row['capacity']; ?></td>
                                <td><?php echo $row['range_km']; ?> km</td>
                                <td><?php echo $row['speed_kmh']; ?> km/h</td>
                                <td>
                                    <a href="edit_jet.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                                    <a href="delete_jet.php?id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this jet?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No jets found.</p>
            <?php endif; ?>
        </section>
    </main>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

