<?php
// Include database connection
include('connect.php');

// Initialize variable to store HTML content
$html = '';

// Check if the crime type is provided
if(isset($_GET["crimeType"])) {
    // Sanitize the input to prevent SQL injection
    $crimeType = mysqli_real_escape_string($connect, $_GET["crimeType"]);

    // Construct the SQL query based on the selected crime type
    $sql = "SELECT * FROM crime_statistics WHERE type = '$crimeType'";
    
    // Execute the query
    $result = mysqli_query($connect, $sql);

    // Check if there are any rows returned
    if(mysqli_num_rows($result) > 0) {
        // Loop through the results and build HTML content
        while($row = mysqli_fetch_assoc($result)) {
            $html .= "<h4>Crime Description:</h4>";
            $html .= "<p>Type of Crime: " . $row['type'] . "</p>";
            $html .= "<p>Time of Day: " . $row['time_of_day'] . "</p>";
            $html .= "<p>Location: " . $row['location'] . "</p>";
            $html .= "<p>Number of Perpetrators: " . $row['perpetrators'] . "</p>";
            $html .= "<p>Weapons: " . $row['weapons'] . "</p>";
            $html .= "<p>Vehicles: " . $row['vehicles'] . "</p>";
            $html .= "<p>Property Damage: " . $row['property_damage'] . "</p>";
            $html .= "<p>Direction of Travel: " . $row['direction_of_travel'] . "</p>";
        }
    } else {
        // If no rows are returned, display a message indicating no data found
        $html .= "No crime statistics found for the selected crime type.";
    }
} else {
    // If the crime type is not provided, display an error message
    $html .= "Error: Crime type not provided.";
}

// Return the HTML content as the response
echo $html;
?>