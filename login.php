<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "ecs417";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }

    $sql = "SELECT * FROM `users`";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

                
            // login was successful and user is an admin
            if($row["email"] == $_POST["email-input"] && $row["password"] == $_POST["password-input"] && $row["isAdmin"] != 0){
                header("Location: addEntry.php");
            
                session_start();
                $_SESSION["name"] = $row["name"];
                $_SESSION["email"] = $_POST["email-input"];
                $_SESSION["isAdmin"] = $row["isAdmin"];

                exit;
            }

            //login was successful and user is not an admin
            if($row["email"] == $_POST["email-input"] && $row["password"] == $_POST["password-input"] && $row["isAdmin"] == 0){
                header("Location: viewBlog.php");

                session_start();
                $_SESSION["name"] = $row["name"];
                $_SESSION["email"] = $_POST["email-input"];
                $_SESSION["isAdmin"] = $row["isAdmin"];

                exit;
            }

            // login was unsuccessful
            else {
                header("Location: login.html");
            }
        }
    }

    $conn->close();
?>