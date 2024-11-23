<?php
include 'db_connect.php';

// Check if the jet ID is provided
if (isset($_GET['id'])) {
    $jet_id = (int)$_GET['id'];

    // Fetch the current details of the jet
    $query = "SELECT * FROM jets WHERE id = $jet_id";
    $result = $conn->query($query);
    $jet = $result->fetch_assoc();
}

// Update the jet's information if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated form data
    $model_name = $conn->real_escape_string($_POST['model_name']);
    $manufacturer = $conn->real_escape_string($_POST['manufacturer']);
    $price = (float)$_POST['price'];
    $capacity = (int)$_POST['capacity'];
    $range_km = (int)$_POST['range_km'];
    $speed_kmh = (int)$_POST['speed_kmh'];
    $availability_status = $conn->real_escape_string($_POST['availability_status']);
    $description = $conn->real_escape_string($_POST['description']);
    $image = $conn->real_escape_string($_POST['image']);

    // SQL query to update the jet details
    $query = "UPDATE jets SET model_name = '$model_name', manufacturer = '$manufacturer', price = $price, capacity = $capacity, 
              range_km = $range_km, speed_kmh = $speed_kmh, availability_status = '$availability_status', description = '$description', 
              image = '$image' WHERE id = $jet_id";

    if ($conn->query($query)) {
        echo "<p>Jet updated successfully!</p>";
    } else {
        echo "<p>Error updating jet: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jet</title>
    <link rel="stylesheet" href="edit_jet.css">
</head>
<body class="edit-jet-page">
    <h1>Edit Jet Details</h1>
    <form action="edit_jet.php?id=<?php echo $jet['id']; ?>" method="POST">
        <label for="model_name">Model Name:</label>
        <input type="text" name="model_name" value="<?php echo $jet['model_name']; ?>" required>

        <label for="manufacturer">Manufacturer:</label>
        <input type="text" name="manufacturer" value="<?php echo $jet['manufacturer']; ?>" required>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $jet['price']; ?>" required>

        <label for="capacity">Seating Capacity:</label>
        <input type="number" name="capacity" value="<?php echo $jet['capacity']; ?>" required>

        <label for="range_km">Range (km):</label>
        <input type="number" name="range_km" value="<?php echo $jet['range_km']; ?>" required>

        <label for="speed_kmh">Speed (km/h):</label>
        <input type="number" name="speed_kmh" value="<?php echo $jet['speed_kmh']; ?>" required>

        <label for="availability_status">Availability Status:</label>
        <input type="text" name="availability_status" value="<?php echo $jet['availability_status']; ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $jet['description']; ?></textarea>

        <label for="image">Image Filename:</label>
        <input type="text" name="image" value="<?php echo $jet['image']; ?>" required>

        <button type="submit">Update Jet</button>
    </form>
</body>
</html>
