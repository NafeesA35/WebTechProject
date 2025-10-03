<?php
    session_start();
    date_default_timezone_set('UTC');
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DATABASE_NAME = "credentials";

    $connection = mysqli_connect(SERVER, 
                                USER, 
                                PASSWORD, 
                                DATABASE_NAME);

    $year = date('Y');
    $month = date('m');
    $day = date('d'); 
    $hour = date('H');
    $minute = date('i');
    $second = date('s');

    $string_quantifier =  $year . $month . $day . $hour . $minute . $second;
    $quantifier = $string_quantifier;

    $querySql = "INSERT INTO blog (title, content, quantifier) VALUES ('" . $_POST['title'] . "', '" . $_POST['content'] . "', '" . $quantifier . "')";
    mysqli_query($connection, $querySql);

    unset($_SESSION['title']);
    unset($_SESSION['content']);
    header("Location: viewBlog.php");
    exit();


?>