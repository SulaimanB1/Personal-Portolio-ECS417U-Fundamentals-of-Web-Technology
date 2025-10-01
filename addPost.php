<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "ecs417";

    // creating the connection with the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // in case an error occurs
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // setting the timezone
    date_default_timezone_set("UTC");

    // storing the date format for the 'datetime' sql datatype
    $dbFormat = "Y-m-d H:i:s";

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $title = $_GET["title-input"];
        $body = $_GET["blog-input"];
    }

    // retrieving the current date and time in the appropriate format
    $currentdatetime = date($dbFormat);
    
    $sql = "INSERT INTO `posts`(`datetime`, `title`, `body`) VALUES ('$currentdatetime','$title','$body')";
    $result = $conn->query($sql);

    $sql2 = "INSERT INTO `archive`(`datetime`, `title`, `body`) VALUES ('$currentdatetime','$title','$body')";
    $result2 = $conn->query($sql2);

    $sql3 = "SELECT * FROM `posts`";
    $result3 = $conn->query($sql3);
    $entries = array();

    $MAX_POST_DISPLAY = 3; // maximum number of posts store in posts table and to display on standard blog
    
    require "sort.php";
    while ($row = $result3 -> fetch_assoc()) {
        $entries[] = $row;
        sortEntries($entries);
    }

    while (sizeof($entries) > 3) {
        $lastPostKey = array_key_last($entries);
        $lastPost = $entries[$lastPostKey];

        // Retrieving the data of the post
        $ID = $lastPost["ID"];
        $datetime = $lastPost["datetime"];
        $title = $lastPost["title"];
        $body = $lastPost["body"];

        // Deleting the post from the 'posts' table
        $sql4 = "DELETE FROM `posts` WHERE `ID`= $ID";
        $result4 = $conn->query($sql4);
    
        $sql5 = "SELECT * FROM `posts`";
        $result5 = $conn->query($sql3);
        $entries = array();
        
        while ($row = $result5 -> fetch_assoc()) {
            $entries[] = $row;
            sortEntries($entries);
        }
    }

    header("Location: viewBlog.php");

    $conn->close();
?>