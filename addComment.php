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

                $sql = "SELECT * FROM `posts`";
                $result = $conn->query($sql);
                $entries = array();

                if ($result->num_rows > 0) {
                    echo "<form action='viewBlogByID.php' method='GET'>";
                    echo "<label>Choose blog to comment on: </label>";
                    echo "<select id='blogID-select' name='blogID-select'>";
                    echo "<option value=''> Select a blog </option>";

                    while ($row = $result -> fetch_assoc()) {
                        $entries[] = $row;
                    }

                    sortEntries($entries);

                    foreach ($entries as $row) {
                        echo "<option value='" . $row["ID"] . "'>" . $row["title"] . "</option>"; 
                    }

                    echo "</select>";
                    echo "<button type='submit' id='select-blog-submit'>Submit</button>";
                    echo "</form>";


                    if (isset($_SESSION["selected-blog"])) {
                        foreach ($entries as $row) {
                            if ($row["ID"] == $_SESSION["selected-blog"]) {
                                date_default_timezone_set("UTC");
                                $format = "jS F Y, H:i e "; // date format when displaying blog entries

                                $date = strtotime($row["datetime"]);
                                $new_date = date($format, $date);
        
                                echo "<tr> <td>";
                                echo "<p style='text-align:right; font-size:small;' font-size:'small'>" . $new_date . "</p>";
                                echo "<h3>" . $row["title"] . "</h3>";
                                echo "<p>" . $row["body"] . "</p>";
                                echo "<hr>";
                            }
                        }


                        // Retrieving Comments
                        $selectedBlogID = $_SESSION["selected-blog"];
                        $sql = "SELECT * FROM `comments` WHERE `postID` = $selectedBlogID";
                        $result = $conn->query($sql);
                        $comments = array();
                        if ($result->num_rows > 0) {
                            while ($row = $result -> fetch_assoc()) {
                                $dbID = $row["ID"];
                                echo "<tr> <td>" . $row["comment"] . "</td>";
                            }
                        }

                        
                        // Comment Form
                        echo "<tr> <td>";
                        echo "<form method='GET' action='addCommentPost.php'>";
                        echo "<label>Comment</label>";
                        echo "<textarea id='comment-input' name='comment-input'></textarea>";
                        echo "<br>";
                                
                        echo "<button type='submit' id='post-comment'>Post</button>";
                        echo "<button type='reset' id='clear-comment'>Clear</button>";
                        echo "</form>";
                        echo "</td> </tr>";   
                    }
                }
                else {
                    header("Location: login.html");
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
<script src="js/post-comment.js"></script>
</html>