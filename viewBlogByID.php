<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $_SESSION["selected-blog"] = $_GET["blogID-select"];
    }

    header("Location: addComment.php");
?>