<?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "ecs417";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $commentID = $_GET["commentDelete-select"];
        $sql = "DELETE FROM `comments` WHERE `ID`= " . $commentID;
        $result = $conn->query($sql);

        $conn->close();
    }

    header("Location: viewBlog.php");
?>