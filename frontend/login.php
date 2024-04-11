<?php
session_start(); 
include('connect.php');

if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $check_query = mysqli_query($connect, "SELECT * FROM users WHERE email ='$email'");
    $rowCount = mysqli_num_rows($check_query);

    if($rowCount == 1){ 
        $fetch = mysqli_fetch_assoc($check_query); 
        $stored_password = $fetch["password"];  

        // Verify password without password_verify since passwords are not hashed
        if($password == $stored_password){
            // Set session variable
            $_SESSION["email"] = $email;

            echo '<script>alert("Login successful");</script>';
            // Redirect to index.php
            header("Location: index.php");
            exit; 
        } else {
            echo '<script>alert("Email or password is invalid. Please try again.");</script>';
        }
    } else {
        echo '<script>alert("Email or password is invalid. Please try again.");</script>';
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
        <form action="#" method="post" name="login">
            <h3>Welcome Back</h3>
            <div class="inputs">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" />
            </div>
            <div class="inputs">
                <label for="pass">Password</label>
                <input type="password" name="password" id="password" />
            </div>
            <div class="submit">
                <input type="submit" name="login" id="login" value="Submit" />
            </div>
        </form>
    </div>
</body>

</html>