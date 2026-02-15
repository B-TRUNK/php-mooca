<?php
// Start session for user storage
session_start();

// Include the User class (which includes MysqlAdapter and database_config.php)
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instantiate the User object with the global $config from database_config.php
    $userModel = new User($config);

    // Use the login method we added to the class
    $user = $userModel->login($_POST['email'], $_POST['password']);

    if ($user) {
        // Set session variables
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        
        // Redirect to admin area
        header("Location: ooplist.php");
        exit;
    } else {
        $error = 'Invalid email or password';
    }
}
?>

<html>
<head>
    <title>Login (OOP)</title>
</head>
<body>
    <?php if(isset($error)) echo "<p style='color:red'>" . $error . "</p>"; ?>
    
    <form method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" 
               value="<?= (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '' ?>" />
        <br />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
        <br />

        <input type="submit" name="submit" value="Login" />
    </form>
</body>
</html>