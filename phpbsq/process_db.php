<?php

//Validation
$error_fields = array();

if (! (isset($_POST['name']) && !empty($_POST['name']))){
    $error_fields[] = "name";
}

if (! (isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) )){
    $error_fields[] = "email";
}

if (! (isset($_POST['password']) && strlen($_POST['password']) > 5 )){
    $error_fields[] = "password";
}

//Connect to DB
$conn = mysqli_connect("localhost", "blog_user", "StrongPass123!", "blog");

if ($error_fields){
    header("Location: form.php?error_fields=" . implode(",", $error_fields));
    exit;
}

// Escape any special character to avoid sql injection
$name = mysqli_escape_string($conn, $_POST['name']);
$email = mysqli_escape_string($conn, $_POST['email']);
$password = mysqli_escape_string($conn, $_POST['password']);

// Insert the Data
$query = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('".$name."', '".$email."', '".$password."')";

if (mysqli_query($conn, $query)){
    echo "Thank you, Data Saved Successfully!";
}
else {
    echo $query;
    echo mysqli_error($conn);
}

//Close the Connection
mysqli_close($conn);
