<?php
    session_start();

    $loginLink = "";
    $logoutLink = "";
    $addPostLink = "";
    $addCommentLink = "";
    $deleteEntryLink = "";

    // determine whether the user is logged in
    if (isset($_SESSION["name"])) {
        $logoutLink = "<a href='logout.php'>Logout</a>";

        // determine whether user is an admin
        if ($_SESSION["isAdmin"] != 0) {
            $addPostLink = "<a href='addEntry.php'> Add Post </a>";
            $deleteEntryLink = "<a href='deleteEntries.php'> Delete Entry </a>";
        }

        $addCommentLink = "<a href='addComment.php'> Add Comment </a>";
    }

    else {
        $loginLink = "<a href='login.html'>Login</a>";
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
            </thead>

            <tbody>
            <?php
                require "sort.php";

                // Month Selector
                $months = array("January","February","March","April","May","June","July","August","September","October","November","December");

                echo "<form action='viewBlogByMonth.php' method='GET'>";
                echo "<label>Sort by: </label>";
                echo "<select id='month-select' name='month-select'>";
                echo "<option value=''> Standard </option>";
                for ($i=0; $i<12; $i++) {
                    echo "<option value='" . $months[$i] . "'>" . $months[$i] . "</option>";
                }
                echo "</select>";
                echo "<button type='submit'>Submit</button>";
                echo "</form>";



                date_default_timezone_set("UTC");
                $entries = array();
                $format = "jS F Y, H:i e "; // date format when displaying blog entries


                $sql = "SELECT * FROM `posts`";
                $result = $conn->query($sql);

                // Determine whether there are any blog entries
                if ($result->num_rows > 0) {

                    // Adding only the entries of the selected month (if one has been selected)
                    if (isset($_SESSION["selected-month"])){
                        $sql1 = "SELECT * FROM `archive`";
                        $result1 = $conn->query($sql1);
                        while ($row1 = $result1 -> fetch_assoc()) {
                            $datetime = strtotime($row1["datetime"]);
                            $month = date("F",$datetime);                           
                            if ($month == $_SESSION["selected-month"]) {
                                $entries[] = $row1;
                            }
                        }
                    }
                    
                    // Adding all the entries
                    else {
                        while ($row = $result -> fetch_assoc()) {
                            $datetime = strtotime($row["datetime"]);
                            $month = date("F",$datetime);
                            $entries[] = $row;
                        }
                    }
    


                    if (sizeof($entries) != 0) {
                        sortEntries($entries); // calling the sorting algorithm to sort the entries from most recent first
                    }


                    // Displaying all the posts
                    foreach ($entries as $row) {
                        $date = strtotime($row["datetime"]);
                        $new_date = date($format, $date);

                        echo "<tr> <td>";
                        echo "<p style='text-align:right; font-size:small;' font-size:'small'>" . $new_date . "</p>";
                        echo "<h3>" . $row["title"] . "</h3>";
                        echo "<p>" . $row["body"] . "</p>";
                        echo "<hr>";
                    }
                }

                else {
                    header("Location: login.html");
                }
                
                $conn->close();
            ?>
            </tbody>

            <tfoot>
                <tr>
                    <td>
                        <?php
                            echo $loginLink;
                            echo $addPostLink;
                            echo $addCommentLink;
                            echo $deleteEntryLink;
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>

    </aside>

    <!--Portfolio Footer-->
    <footer>
        <p>Feel free to contact me: </p>
        <a href="mailto:sulaimanbakalimueden@gmail.com">Email</a>
        <a href="https://www.linkedin.com/in/sulaiman-bakali-mueden-3569b5195/">LinkedIn</a>
    </footer>
    
</body>
</html>