<?php
$servername = "localhost";
$username = "your_username"; 
$password = "your_password"; 
$dbname = "mohid_auth";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];


$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashed_password);
$stmt->fetch();

if ($stmt->num_rows > 0) {
   
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that email.";
}

$stmt->close();
$conn->close();
?>