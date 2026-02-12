<?php

    //print_r($_POST);
    // var_dump($_POST['name']);
    // echo '<br />';
    // var_dump($_POST['email']);

    if ( isset($_POST['name']) && !empty($_POST['name']) )
            var_dump($_POST['name']);
        else
            echo "Name Cannot be Empty!";

    if(isset($_POST) && !empty($_POST))
        {
            foreach ($_POST as $key => $value)
                {
                    echo "<br />";
                    echo $key . '->' . $value;
                }
        }
    


    /*
    $x = 22.3;
    echo (gettype($x));
    echo '<br />';
    echo settype($x, "string"); // is_array is_bool object float numeric ...
    echo '<br />';
    echo isset($x);
    echo '<br />';
    unset($x);
    echo '<br />';
    //echo $x;  error, because variable is unset now
    */
