<?php
session_start();
// Include database connection
include('connect.php');

// Check if the user is not logged in, redirect to login page
if(!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

// Logout logic
if(isset($_GET["logout"])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php"); // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crime detection system</title>
    <link rel="stylesheet" href="styles.css" />
    <meta name="description" content="Crime detection system" />
    <meta name="keywords" content="crime, detection, system" />
    <link rel="icon" href="images/icon.jpeg" />
    <meta name="author" content="oriel kiplangat" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="menubar">
        <div class="logo">ORIELX CRIME DETECTION SYSTEM</div>
        <div class="account">
            <div class="areacode">Nakuru Central</div>
            <div class="login">
                <a href="index.php?logout=true">Log out</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="column one">
                <h3>Dashboard</h3>
                <p>Latest cases of crimes</p>
                <div class="filter">
                    <label for="filterOption">Filter by</label>
                    <select id="filterOption">
                        <?php
                            // Fetch all distinct crime types from the database
                            $crimeTypesQuery = "SELECT DISTINCT type FROM crime_statistics";
                            $crimeTypesResult = mysqli_query($connect, $crimeTypesQuery);
                            
                            // Check if query was successful
                            if ($crimeTypesResult) {
                                // Loop through the results and generate option tags
                                while ($row = mysqli_fetch_assoc($crimeTypesResult)) {
                                    echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
                                }
                            }else{
                                echo "Error fetching crime types.";
                            }
                            ?>
                    </select>

                    <button id="filterButton">Filter</button>
                </div>
                <div class="crime-statistics" id="crimeStatistics">
                    <h4>Crime Description:</h4>

                </div>
                <div class="map">
                    <h3>Location</h3>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15959.210615715665!2d35.9635244!3d-0.16056320000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1710375258801!5m2!1sen!2ske"
                        width="300" height="250" style="border: 2; border-radius: 10px; border-color: green"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="column two">
                <h3>Predictive analytics</h3>
                <h3>Real time footage</h3>
                <div class="real-time-footage">
                    <iframe src="http://10.1.97.56:8080/" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="analytics">
                    <div class="alert">
                        <h4>Recommendation</h4>
                        <p>
                            The system has detected a high probability of a crime in the
                            area code: <span>2356</span> street: <span>5th avenue</span> at
                            <span>10:17 am</span>
                        </p>
                        <p>
                            The system recommends that the police department should increase
                            patrols in the area.
                        </p>
                        <p>Please take necessary precautions.</p>
                    </div>
                    <div class="heatmap">
                        <h3>Heatmap</h3>
                        <img src="images/crime-heatmap.jpeg" alt="heatmap" />
                    </div>
                </div>
            </div>
            <div class="column three">
                <h3>Actionable Insights</h3>
                <div class="face-recognition">
                    <h3>scan Image</h3>
                    <img src="images/face1.jpeg" alt="face recognition" />
                </div>
                <div class="suspect-description">
                    <h4>Suspect Description</h4>
                    <p>Sex: <span>male</span></p>
                    <p>Age Approximation: <span>mid 30s</span></p>
                    <p>Height approximation: <span>2.0 ft</span></p>
                    <p>Build: <span>slim</span></p>
                    <p>Hair: <span>blonde, short and curly</span></p>
                    <p>Facial Features: <span>dark skinned, beard, sideburns</span></p>
                    <p>
                        Clothing and Accessories: <span>white hoodie, grey pants</span>
                    </p>
                    <p>previous incidents: <span>none</span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Function to handle filter button click
        $('#filterButton').click(function() {
            var crimeType = $('#filterOption').val(); // Get the selected crime type

            // AJAX request to fetch crime statistics based on selected crime type
            $.ajax({
                url: 'filter_crime.php',
                type: 'GET',
                data: {
                    crimeType: crimeType
                }, // Pass the selected crime type as parameter
                success: function(response) {
                    $('.crime-statistics').html(
                        response); // Display the crime statistics in the designated div
                },
                error: function() {
                    alert('Error fetching crime statistics.');
                }
            });
        });
    });
    </script>

</body>

</html>