<?php
include 'db_connect.php'; // Include the database connection

$property_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Property ID not specified.');

$sql = "SELECT * FROM properties WHERE id = $property_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>" . $row["title"]. "</h1>";
    echo "<p>Location: " . $row["location"]. "</p>";
    echo "<p>Price: $" . number_format($row["price"], 2). "</p>";
    echo "<p>Description: " . $row["description"]. "</p>";
    if ($row["image_url"] != '') {
        echo "<img src='" . $row["image_url"] . "' alt='" . $row["title"] . "' style='max-width: 500px;'>";
    }
} else {
    echo "No details found for this property.";
}

$conn->close();
?>
