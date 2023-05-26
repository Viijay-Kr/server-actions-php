<?php
$userId = $_GET['id'];
function getConnection()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "server_actions";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

$conn = getConnection();
$query = "SELECT * FROM users WHERE id='$userId'";
$result = mysqli_query($conn, $query);

// Check if the insert operation was successful
if ($result->num_rows > 0) {
    // Get the auto-generated ID
    $user = $result->fetch_assoc();

} else {
    echo "Error: " . mysqli_error($conn);
}

$conn->close();

if (isset($_POST["deleteUser"])) {
    $id = $_POST["id"];
    $conn = getConnection();
    $sql = "DELETE FROM users WHERE id = $id";


    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully. Going back to home";
        header("Location: /");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
}

if (isset($_POST["deleteAge"])) {
    $id = $_POST["id"];
    $conn = getConnection();
    $sql = "UPDATE users SET AGE = null WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: /user.php?id=$id");
    } else {
        echo "Error deleting record: " . $conn->error;
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

<body>
    <h2 class="text-center font-bold text-3xl">Server Actions in PHP</h2>
    <div className="flex flex-col mx-[3rem]">
        <h2>Name:
            <?php echo $user['name'] ?>
        </h2>
        <h2>Email:
            <?php echo $user['email'] ?>
        </h2>
        <h2>Age:
            <?php echo $user['age'] ?>
        </h2>
    </div>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $userId ?>" />
        <button name="deleteUser" type="submit"
            class=" bg-red-600 rounded-md p-[0.5rem] mt-[1rem] text-slate-50 w-1/4 hover:bg-red-400 cursor-pointer">
            Delete User
        </button>
    </form>

    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $userId ?>" />
        <button name="deleteAge" type="submit"
            class=" bg-red-600 rounded-md p-[0.5rem] mt-[1rem] text-slate-50 w-1/4 hover:bg-red-400 cursor-pointer">
            Delete Age
        </button>
    </form>

</body>

</html>