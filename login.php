<?php
session_start();
include 'connect.php'; // Ensure this file has a valid database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username_or_email = $_POST["username"]; 
    $password = $_POST["password"];

    if ($username_or_email == "" || $password == "") {
        die("Username or password cannot be empty!");
    }

    // Direct query (Avoiding functions like trim)p
    $query = "SELECT id, password FROM users WHERE email = '$username_or_email' OR username = '$username_or_email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];

            if ($password === $hashed_password) { // Direct password check (if passwords are stored as plain text)
                $_SESSION["user_id"] = $row['id'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script>alert('Invalid password! Try again.'); window.location.href='index.html';</script>";
            }
        } else {
            echo "<script>alert('User not found!'); window.location.href='index.html';</script>";
        }
    } else {
        echo "Error in SQL query: " . mysqli_error($conn);
    }
}
?>
