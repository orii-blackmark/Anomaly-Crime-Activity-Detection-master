<?php
session_start(); 
include('connect.php');

if(isset($_POST["register"])){
    $fname = mysqli_real_escape_string($connect, $_POST["fname"]);
    $email = mysqli_real_escape_string($connect, $_POST["email"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);

    // Check if any field is empty
    if(empty($fname) || empty($email) || empty($password)){
        echo '<script>alert("Please fill in all fields.");</script>';
    } else {
        // Check if the email already exists in the database
        $check_query = mysqli_query($connect, "SELECT * FROM users WHERE email ='$email'");
        $rowCount = mysqli_num_rows($check_query);

        if($rowCount > 0){ 
            echo '<script>alert("Email already exists. Please choose a different email.");</script>';
        } else {
            // Insert user details into the database
            $insert_query = "INSERT INTO users (fname, email, password) VALUES ('$fname', '$email', '$password')";
            if(mysqli_query($connect, $insert_query)){
                echo '<script>alert("Registration successful");</script>';
                // Redirect to login page or any other page as needed
                header("Location: admin.php");
                exit;
            } else {
                echo '<script>alert("Error: Could not execute $insert_query. ' . mysqli_error($connect) . '");</script>';
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crime Detection System</title>
    <link rel="stylesheet" href="login.css" />
</head>

<body>
    <div class="container">
        <form action="#" method="post" name="register">
            <h3>Register User</h3>
            <div class="inputs">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" />
            </div>
            <div class="inputs">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" />
            </div>
            <div class="inputs">
                <label for="pass">Password</label>
                <input type="password" name="password" id="password" />
            </div>
            <div class="submit">
                <input type="submit" name="register" id="register" value="Submit" />
            </div>

        </form>
    </div>
</body>

</html>