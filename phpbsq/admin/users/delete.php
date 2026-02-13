<?php
//Connect to DB
$conn = mysqli_connect("localhost", "blog_user", "StrongPass123!", "blog");
if(! $conn){
    echo mysqli_connect_error();
    exit;
}

//Select the user
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$query = "DELETE FROM `users` WHERE `users`.`id`=" . $id . " LIMIT 1";

if(mysqli_query($conn, $query)){
    header("Location: list.php");
    exit;
} else {
    //echo $query;
    echo mysqli_error($conn);
}

//Close the connection
mysqli_close($conn);
?>