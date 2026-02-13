<?php
$error_fields = array();

// 1. Connect to DB
$conn = mysqli_connect("localhost", "blog_user", "StrongPass123!", "blog");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}

// 2. Fetch the current user data from the DB to pre-fill the form
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM `users` WHERE `id` = " . (int)$id . " LIMIT 1";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "User not found.";
    exit;
}

// 3. Handle Form Submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Validation
    if(!(isset($_POST['name']) && !empty($_POST['name']))){
        $error_fields[] = "name";
    }
    if(!(isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
        $error_fields[] = "email";
    }

    // If no errors, update the database
    if(!$error_fields){
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $name = mysqli_escape_string($conn, $_POST['name']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        
        // Only hash password if a new one is provided; otherwise keep the old one
        $password = (!empty($_POST['password'])) ? sha1($_POST['password']) : $row['password'];
        $admin = (isset($_POST['admin'])) ? 1 : 0;

        $query = "UPDATE `users` SET 
                  `name` = '".$name."', 
                  `email` = '".$email."', 
                  `password` = '".$password."', 
                  `admin` = ".$admin." 
                  WHERE `id` = ".$id;

        if(mysqli_query($conn, $query)){
            header("Location: list.php");
            exit;
        } else {
            echo mysqli_error($conn);
        }
    }
}

// Close the result set, but we keep the row data in the $row variable for the HTML below
mysqli_free_result($result);
mysqli_close($conn);
?>

<html>
<head>
    <title>Admin :: Edit User</title>
</head>
<body>
    <form method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" 
               value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : htmlspecialchars($row['name']) ?>" />
        <?php if(in_array("name", $error_fields)) echo "<span style='color:red'>* Please enter your name</span>"; ?>
        <br />

        <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($row['id']) ?>" />

        <label for="email">Email</label>
        <input type="email" name="email" id="email" 
               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($row['email']) ?>"/>
        <?php if(in_array("email", $error_fields)) echo "<span style='color:red'>* Please enter a valid email</span>"; ?>
        <br />

        <label for="password">Password</label>
        <input type="password" name="password" id="password"/>
        <br />

        <?php 
            $isAdmin = $_SERVER['REQUEST_METHOD'] == 'POST' ? isset($_POST['admin']) : $row['admin'];
        ?>
        <input type="checkbox" name="admin" <?= $isAdmin ? 'checked' : '' ?> /> Admin
        <br />

        <input type="submit" name="submit" value="Edit User" />
    </form>
</body>
</html>