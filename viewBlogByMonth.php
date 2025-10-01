<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($_GET["month-select"] != "") {
            $_SESSION["selected-month"] = $_GET["month-select"];
        }
        else {
            unset($_SESSION["selected-month"]);
        }
    }

    header("Location: viewBlog.php");
?>