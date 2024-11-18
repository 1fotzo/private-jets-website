<?php
// Include the database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs and sanitize them
    $model_name = $conn->real_escape_string($_POST['model_name']);
    $manufacturer = $conn->real_escape_string($_POST['manufacturer']);
    $price = (float)$_POST['price'];
    $capacity = (int)$_POST['capacity'];
    $range_km = (int)$_POST['range_km'];
    $speed_kmh = (int)$_POST['speed_kmh'];
    $availability_status = $conn->real_escape_string($_POST['availability_status']);
    $description = $conn->real_escape_string($_POST['description']);
    $image = $conn->real_escape_string($_POST['image']); // Image file path

    // SQL query to insert the new jet into the database
    $query = "INSERT INTO jets (model_name, manufacturer, price, capacity, range_km, speed_kmh, availability_status, description, image) 
              VALUES ('$model_name', '$manufacturer', $price, $capacity, $range_km, $speed_kmh, '$availability_status', '$description', '$image')";

    if ($conn->query($query)) {
        echo "<p>Jet added successfully!</p>";
    } else {
        echo "<p>Error adding jet: " . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Jet</title>
    <link rel="stylesheet" href="create_jet.css">
</head>
<body>

<body class="add-jet-page">
    <h1>Add a New Jet</h1>

    <form action="create_jet.php" method="POST">
        <label for="model_name">Model Name:</label>
        <input type="text" name="model_name" required>

        <label for="manufacturer">Manufacturer:</label>
        <input type="text" name="manufacturer" required>

        <label for="price">Price:</label>
        <input type="number" name="price" required>

        <label for="capacity">Seating Capacity:</label>
        <input type="number" name="capacity" required>

        <label for="range_km">Range (km):</label>
        <input type="number" name="range_km" required>

        <label for="speed_kmh">Speed (km/h):</label>
        <input type="number" name="speed_kmh" required>

        <label for="availability_status">Availability Status:</label>
        <input type="text" name="availability_status" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="image">Image Filename:</label>
        <input type="text" name="image" required>

        <button type="submit">Add Jet</button>
    </form>
</body>


</body>
</html>
