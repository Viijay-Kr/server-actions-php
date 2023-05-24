<?php
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];

// Sanitize and validate the data (optional but recommended)

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "server_actions";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert the data into the database
$sql = "INSERT INTO users (name, email, age) VALUES ('$name', '$email', '$age')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
