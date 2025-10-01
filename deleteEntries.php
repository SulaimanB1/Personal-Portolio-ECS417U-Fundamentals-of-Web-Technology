<?php
    session_start();

    $user;
    $logoutLink;

    // determine whether the user is logged in
    if (isset($_SESSION["name"])) {
        $user = $_SESSION["name"];
        $logoutLink = "<a href='logout.php'>Logout</a>";
    }
    
    else {
        $logoutLink = "";
    }

    // connecting to database and performing SQL Query
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "ecs417";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sulaiman's Portfolio</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>

    <!--Naviagation Bar-->

    <span class="nav-bar">

        <!--Portfolio Header-->
        <header>
            <h1>Sulaiman Bakali-Mueden</h1>
        </header>

        
        <!--Portfolio Navigation-->
        <nav>
            <a href="index.php#about-me">About Me</a>
            <a href="index.php#experience">Experience</a>
            <a href="index.php#skills">Skills</a>
            <a href="index.php#education">Education</a>
            <a href="index.php#projects">Projects</a>
            <a href="viewBlog.php">Blog</a>
            <?php echo $logoutLink; ?>
        </nav>
        
    </span>

    <!--Portfolio Aside-->
    <aside class="blog" id="blog">
        <table>
            <thead>
                <h2>Blog</h2>
                <p>
                    Welcome to the blog <?php echo $user; ?> 
                </p>
            </thead>

            <tbody>
            <?php
                require "sort.php";

                // Delete Post
                $sql = "SELECT * FROM `posts`";
                $result = $conn->query($sql);
                $entries = array();

                if ($result->num_rows > 0) {
                    echo "<form action='deletePost.php' method='GET'>";
                    echo "<label>Choose blog to delete: </label>";
                    echo "<select id='blogDelete-select' name='blogDelete-select'>";
                    echo "<option value=''> Select a blog </option>";

                    while ($row = $result -> fetch_assoc()) {
                        $entries[] = $row;
                    }

                    sortEntries($entries);

                    foreach ($entries as $row) {
                        echo "<option value='" . $row["ID"] . "'>" . $row["title"] . "</option>"; 
                    }

                    echo "</select>";
                    echo "<button type='submit' id='select-blog-delete'>Submit</button>";
                    echo "</form>";
                }

                else {
                    header("login.html");
                }


                // Delete Comments
                $sql = "SELECT * FROM `comments`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<form action='deleteComment.php' method='GET'>";
                    echo "<label>Choose comment to delete: </label>";
                    echo "<select id='commentDelete-select' name='commentDelete-select'>";
                    echo "<option value=''> Select a comment </option>";

                    while ($row = $result -> fetch_assoc()) {
                        echo "<option value='" . $row["ID"] . "'>" . $row["comment"] . $rowBlog . "</option>";
                    }

                    echo "</select>";
                    echo "<button type='submit' id='select-comment-delete'>Submit</button>";
                    echo "</form>";
                }
            ?>
        </tbody>
        </table>

    </aside>

    <!--Portfolio Footer-->
    <footer>
        <p>Feel free to contact me: </p>
        <a href="mailto:sulaimanbakalimueden@gmail.com">Email</a>
        <a href="https://www.linkedin.com/in/sulaiman-bakali-mueden-3569b5195/">LinkedIn</a>
    </footer>
    
</body>
<script src="js/post-comment-delete.js"></script>
</html>