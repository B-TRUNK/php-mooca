<?php
session_start();

// Authentication Check
if (isset($_SESSION['id'])){
    echo '<p> Welcome '.$_SESSION['email'].' <a href="ooplogout.php">Logout</a> </p>';
} else {
    header("Location: ooplogin.php");
    exit;
}

// 1. Include the User class (which includes MysqlAdapter and database_config)
require_once 'User.php';

// 2. Instantiate the User object
// $config is provided by database_config.php via the User.php requires
$userModel = new User($config);

// 3. Logic for Search vs. List All
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $users = $userModel->searchUsers($_GET['search']);
} else {
    $users = $userModel->getUsers();
}

// Note: In OOP version, $users is now a PHP array (from fetchAll), not a mysqli resource.
?>

<html>
    <head>
        <title>Admin :: All Users (OOP)</title>
    </head>
    <body>
        <h1>All :: Users</h1>
        <form method="GET">
            <input type="text" name="search" placeholder="Enter {Name} or {Email} to search.." 
                   value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"/>
            <input type="submit" value="search">
        </form>
        
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // 4. Loop through the array returned by getUsers() or searchUsers()
                if ($users) {
                    foreach ($users as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <?php if(!empty($row['avatar'])) { ?>
                                    <img src="../../uploads/<?= $row['avatar'] ?>" style="width: 100px; height: 100px;"/>
                                <?php } else { ?>
                                    <img src="../../uploads/noimage.png" style="width: 100px; height: 100px;"/>
                                <?php } ?>
                            </td>
                            <td><?= $row['admin'] ? 'Yes' : 'No' ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                                <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="6">No users found.</td></tr>';
                }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: center"><?= count($users) ?> users</td>
                    <td colspan="3" style="text-align: center"><a href="add.php">Add User</a></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
<?php
// 6. No need for manual mysqli_close; the User class __destruct calls disconnect()
?>