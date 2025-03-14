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
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 


$stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $password);


if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>