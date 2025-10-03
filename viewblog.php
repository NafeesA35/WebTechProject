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
        <section id="blog-bar">
        <?php
            if (isset($_SESSION['email'])) {
                echo "<p> Welcome  ".$_SESSION['email']. "  You are viewing the blog </p>";
            } else {
                echo "<p> Welcome guest. You are viewing the blog </p>";
            }

        ?>
            <section id="logout-button">
                <form method="POST" action="logout.php">
                <button type="submit" class="button-main-logout">  Logout  </button>
                </form>
            </section>

            <section id="logout-button">
                <?php 
                if (isset($_SESSION['email'])) {
                    echo '<form method="POST" action="addEntry.php">';
                } else {
                    echo '<form method="POST" action="login.php">';
                }
                ?>
                <button type="submit" class="button-main-logout">  Post  </button>
                </form>
            </section>

        </section>

        <section id="dropDown">
            <form method="GET" action="viewBlog.php">
                <label for="month">Sort by Month: </label>
                <select name="month" id="month">
                    <option value="all"></option>
                    <option value="all">All Months</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <button type="submit" class="button-itself">Filter</button>
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


    if(isset($_GET['month']) && $_GET['month'] !== "all"){
        $selectedMonth = $_GET['month'];
        $dummyArray = array();
        foreach($Posts as $post){
            if(substr($post->quantifier, 4, 2) === $selectedMonth){
                $dummyArray[] = $post;
                }
            }
            $Posts = $dummyArray;
    }


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
        

        $date_aside = "$day ".convertMonth($month)." $year". " $hour:$minute". " $timezone";

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

    mysqli_close($connection);


    ?>

</body>
</html>