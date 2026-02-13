<?php

//Connect to DB

$conn = mysqli_connect("localhost", "blog_user", "StrongPass123!", "blog");
if (! $conn){
    echo mysqli_connect_error();
    exit;
}

//Select ALl Users
$query = "SELECT * FROM `users`";

//Search by user name or Email
if (isset($_GET['search'])){
    $search = mysqli_escape_string($conn, $_GET['search']);
    $query .= " WHERE `users` . `name` LIKE '%" . $search."%' OR `users`.`email` LIKE '%".$search."%' "; 
}

$result = mysqli_query($conn, query: $query);

?>

<html>
    <head>
        <title>Admin :: All Users</title>
    </head>

    <body>
        <h1>All :: Users</h1>
        <form method="GET">
            <input type="text" name="search" placeholder="Enter {Name} or {Email} to search.."/>
            <input type="submit" value="search">
        </form>
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

                        <td>
                            <?php if($row['avatar']) { ?>
                                <img src="../../uploads/<?= $row['avatar'] ?>" style="width: 100px; height: 100px;"/>
                            <?php } else { ?>
                                <img src="../../uploads/noimage.png" style="width: 100px; height: 100px;"/>
                            <?php } ?>
                        </td>

                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
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