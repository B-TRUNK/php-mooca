<?php

//Connect to DB

$conn = mysqli_connect("localhost", "blog_user", "StrongPass123!", "blog");
if (! $conn){
    echo mysqli_connect_error();
    exit;
}

//Select ALl Users
$query = "SELECT * FROM `users`";
$result = mysqli_query($conn, $query);
?>

<html>
    <head>
        <title>Admin :: List Users</title>
    </head>

    <body>
        <h1>List Users</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
                //Loop On the Row Set
                while($row = mysqli_fetch_assoc($result)){
                    ?>

                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['admin'] ? 'Yes' : 'No' ?></td>
                        <td><a href="edit.php?id=<?$row['id'] ?>">Edit</a> | <a href="delete.php?id"=<?= $row['id']?>Delete</a></a></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center"><?= mysqli_num_rows($result) ?>users</td>
                        <td colspan="3" style="text-align: center"><a href="add.php">Add User</a></td>
                    </tr>
                </tfoot>
        </table>
    </body>

</html>

<?php
//Close the Connection
mysqli_free_result($result);
mysqli_close($conn);