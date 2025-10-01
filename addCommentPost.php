<?php
    session_start();

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "ecs417";

    // creating the connection with the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // in case a connection error occurs
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $blogID = $_SESSION["selected-blog"];
        $comment = $_GET["comment-input"];

        $sql = "INSERT INTO `comments`(`postID`, `comment`) VALUES ('$blogID', '$comment')";

        $result = $conn->query($sql);
    
        header("Location: viewBlog.php");
    }

    $conn->close();
?>