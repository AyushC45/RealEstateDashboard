<?php include 'db_connect.php'; // Include the database connection ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Real Estate Dashboard</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Property Listings</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="visualizations.php">Visualizations</a></li>
            </ul>
        </nav>
    </header>
    <main class="property-listings">
        <?php
        $sql = "SELECT id, title, location, price FROM properties";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='listing'>";
                echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>"; // Enhanced security with htmlspecialchars
                echo "<p>Location: " . htmlspecialchars($row["location"]) . "</p>"; // Enhanced security with htmlspecialchars
                echo "<p>Price: $" . number_format($row["price"], 2) . "</p>";
                echo "<a href='property-details.php?id=" . $row["id"] . "'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "0 results found";
        }
        $conn->close();
        ?>
    </main>
    <footer>
        <p>Real Estate Dashboard © 2024</p>
    </footer>
</body>
</html>
