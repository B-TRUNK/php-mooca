<?php
// We will use it for storing the signed in user data
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Connect to DB
    $conn = mysqli_connect("localhost", "blog_user", "StrongPass123!", "blog");
    if(!$conn){
        echo mysqli_connect_error();
        exit;
    }

    //Escape any special characters to avoid SQL Injection
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = sha1($_POST['password']);

    /* Note: sha1 is susceptible to collisions. 
       Recommended: password_hash() and password_verify() with a CHAR(60) column.
    */

    //Select user from database
    $query = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".$password."' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($row = mysqli_fetch_assoc($result)){
        // Set session variables
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        
        // Redirect to admin area
        header("Location: list.php");
        exit;
    } else {
        $error = 'Invalid email or password';
    }

    //Close the connection
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if(isset($error)) echo "<p style='color:red'>" . $error . "</p>"; ?>
    
    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" 
               value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" />
        <br />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
        <br />

        <input type="submit" name="submit" value="Login" />
    </form>
</body>
</html>