<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    // Perform the SQL insert operation
    $query = "INSERT INTO users (name, email, age) VALUES ('$username', '$email', '$age')";
    $result = mysqli_query($conn, $query);

    // Check if the insert operation was successful
    if ($result) {
        // Get the auto-generated ID
        $insertId = mysqli_insert_id($conn);
        header("Location: user.php?id=" . $insertId);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $conn->close();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Server Actions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Space Mono', monospace;
        }
    </style>
</head>

<body class="m-[1rem]">
    <div class="flex flex-col gap-[1] items-center">
        <h3 class="border-b p-[1rem] text-center">Create User</h3>
        <form title="Create User" action="" method="POST" class="flex flex-col gap-[0.5rem]">
            <input type="text" name="name" placeholder="Name" class="border border-slate-400 p-[0.5rem] rounded-md" />
            <input type="email" name="email" placeholder="Email"
                class="border border-slate-400 p-[0.5rem] rounded-md" />
            <input type="number" name="age" placeholder="Age" class="border border-slate-400 p-[0.5rem] rounded-md" />
            <input type="submit" value="Submit" name="SubmitButton"
                class="bg-blue-600 hover:scale-105 transition-all cursor-pointer text-white p-[0.5rem] rounded" />
        </form>
    </div>
</body>

</html>