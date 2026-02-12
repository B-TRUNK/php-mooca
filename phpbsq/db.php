<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Open The Connection
$conn = mysqli_connect("localhost", "blog_user", "StrongPass123!", "blog");

if(!$conn){
    echo mysqli_connect_error();
    exit;
}

//Do The Operation
$query = "SELECT * FROM `users`";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)){
    echo "ID:" . $row['id'] . "<br />";
    echo "Name:" . $row['name'] . "<br />";
    echo "email:" . $row['email'] . "<br />";
    echo "is_admin?:" . $row['admin'] . "<br />";
    echo str_repeat("-", 50) . "<br />";
}

// Close The Connection
mysqli_free_result($result);
mysqli_close($conn);