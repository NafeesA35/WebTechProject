<?php
session_start();

    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DATABASE_NAME = "credentials";

    $connection = mysqli_connect(SERVER, 
                                USER, 
                                PASSWORD, 
                                DATABASE_NAME);


    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $querySql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";

    $query_return = mysqli_query($connection, $querySql);
    $num_of_rows = mysqli_num_rows($query_return);

    if ($num_of_rows > 0) {
        session_unset();  /* A new session must be started */
        session_destroy();
        session_start();
        $_SESSION['email'] = $email;
        header("Location: addEntry.php");
    } else {
    
        $_SESSION['attempted'] = true;
        header("Location: login.php");

        exit();
    }

?>
