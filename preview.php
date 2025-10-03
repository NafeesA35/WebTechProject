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




if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['title'] = $_POST['title'];
  $_SESSION['content'] = $_POST['content'];
} else if(!isset($_SESSION['title'])) {
  header('Location: addEntry.php');
  exit();
}

// Format date for display
$year = date('Y');
$month = date('m');
$day = date('d'); 
$hour = date('H');
$minute = date('i');
$second = date('s');

$string_quantifier =  $year . $month . $day . $hour . $minute . $second;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <base href="http://localhost/WebTechCW/">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="blog-body">
    <header>

        <section id="blog-bar-preview">
                <form method="POST" action="addPost.php">
                    <input type="hidden" name="title" value="<?php echo $_SESSION['title']; ?>">
                    <input type="hidden" name="content" value="<?php echo $_SESSION['content']; ?>">
                    <button type="submit" class="button-main-logout">  Post  </button>
                </form>

                <form method="GET" action="addEntry.php">
                    <button type="submit" class="button-main-logout">Edit</button>
                </form>
        </section>

    </header>

    <?php

    class Post{
        public $entry;
        public $quantifier;
    }


    function shouldSwap($quantifier1, $quantifier2) {
        return $quantifier1 < $quantifier2;
    }

    $Posts = array();
    $querySql = "SELECT * FROM blog";
    $query_return = mysqli_query($connection, $querySql);
    $num_of_rows = mysqli_num_rows($query_return);
        
    if ($num_of_rows > 0) {
        for ($i = 0; $i < $num_of_rows; $i++) {
            $tempost = new Post();
            $row = mysqli_fetch_array($query_return);
            $tempost->entry = $row;
            $tempost->quantifier = $tempost->entry['quantifier'];
            $Posts[$i] = $tempost;
        }
    } else {
        echo "<h1>No blog posts found.</h1>";
    }
    $tempost = new Post();
    $tempost->entry = array('title' => $_SESSION['title'], 'content' => $_SESSION['content']);
    $tempost->quantifier = $string_quantifier;
    $Posts[$num_of_rows] = $tempost;

    function sortPosts(&$Posts) {
        $n = count($Posts);
        if ($n <= 1) return;
        
        for ($i = 0; $i < $n; $i++) {
            $swapped = false;
            
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if (shouldSwap($Posts[$j]->quantifier, $Posts[$j + 1]->quantifier)) {
                    // Swap posts
                    $temp = $Posts[$j];
                    $Posts[$j] = $Posts[$j + 1];
                    $Posts[$j + 1] = $temp;
                        
                    $swapped = true;
                }
            }
                

            if (!$swapped) break;
        }
    }
        

    sortPosts($Posts);

    for ($i = 0; $i < count($Posts); $i++) {

        $qf = $Posts[$i]->quantifier;
        $year = substr( $qf, 0, 4);
        $month = substr($qf, 4, 2);
        $day = substr($qf, 6, 2);
        $hour = substr($qf, 8, 2);
        $minute = substr($qf, 10, 2);

        $timezone = "UTC";

        $date_aside = "$day ".convertMonth($month)." $year". " $hour:$minute"." $timezone";

        echo "<aside class='post-time'>" . $date_aside . "</aside>";
        echo "<h1 class='blog-title'>" . $Posts[$i]->entry['title'] . "</h1>" ;
        echo "<p class='blog-content'>" . $Posts[$i]->entry['content'] . "</p>";
        echo "<hr>";
    }
        
    function convertMonth($month){  
        $monthsArray = array("January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December");
        $monthNumber = (int)$month - 1;
        return $monthsArray[$monthNumber];
    }

    ?>

</body>
</html>