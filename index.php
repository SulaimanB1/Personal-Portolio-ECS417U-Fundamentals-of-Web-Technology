<?php
    session_start();

    $logoutLink;

    // determine whether the user is logged in
    if (isset($_SESSION["name"])) {
        $logoutLink = "<a href='logout.php'>Logout</a>";
    }

    else {
        $logoutLink = "";
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
    <link rel="stylesheet" href="css/stylesheet.css">
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
            <a href="#about-me">About Me</a>
            <a href="#experience">Experience</a>
            <a href="#skills">Skills</a>
            <a href="#education">Education</a>
            <a href="#projects">Projects</a>
            <a href="viewBlog.php">Blog</a>
            <?php echo $logoutLink; ?>
        </nav>
        
    </span>


    <!--Portfolio Article-->
    <article class="home">

        <section>
            <p>
                Hi, I'm Sulaiman Bakali-Mueden
                <br>Welcome to my portfolio
            </p>
        </section>

    </article>


    <!--About Me Page-->
    <article class="about-me" id="about-me">
        <section>
            <h1>
                About Me
            </h1>

            <p>
                I am an undergraduate computer science student at Queen Mary, University of London.
                My hobbies include reading and sports. I am interested in technology, autobiographies, 
                business, entrepreneurship and self-development.
            </p>
            <p>
                I am interested applying the skills and knowledge I have developed and gained at university
                in a real-world enviroment, in order to develop my skills and knowledge further, and develop
                an understanding of how the skills and knowledge I am developing are being applied in real-world practical enviroments.
            </p>
        </section>

        <figure>
            <img src="images/Sulaiman Bakali-Mueden.jpg" alt="Sulaiman Bakali-Mueden" width="100%" height="100%">
        </figure>
    </article>


    <!--Experience Page-->
    <article class="experience" id="experience">
        <section>
            <h1>
                Experience
            </h1>

            <div id="experience-container">
                <p>
                    Jan 2022 - Feb 2022: Front of House Member
                    <br><br>
                    During my time as a front of house member at a resturant, 
                    I developed particular skills including communication, problem solving and teamwork.
                    <br><br>
                    I was pushed outside my comfort zone and developed my ability to communicate clearly
                    with customers and my team. I feel that I developed my professional skills, such as organization, time management.
                    As well as leadership and developing an open-mind.
                </p>
            </div>
        </section>
    </article>


    <!--Skills Page-->
    <article class="skills" id="skills">
        <section>
            <h1>
                Skills
            </h1>

            <p>
                During my time at university I have developed different skills. These includes the basics of HTML, CSS, JavaScript and PHP.
            </p>
            <p>
                I have developed my understanding of programming and computional thinking.
                In particular, I have developed my programming skills in the language of Java,
                and I have gained an understanding of both procedural and object oriented programming styles.
            </p>
            <p>
                Furthermore, I have gained experience with the very basics of assembly language programming, in particular MIPS.
            </p>
        </section>

        <table>
                <tr>
                    <td>
                        <img src="images/java.png" width="100%">
                    </td>
                    <td>
                        <img src="images/html.png" width="100%">
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="images/css.png" width="100%">
                    </td>
                    <td>
                        <img src="images/javascript.png" width="100%">
                    </td>
                </tr>
            </table>
    </article>


    <!--Education Page-->
    <article class="education" id="education">
        <section>
            <h1>
                Education
            </h1>

            <hgroup>
                <h2> Queen Mary, University of London </h2>
                <span> 2020 - Present </span>
            </hgroup>
            <h2> Bsc Computer Science </h2>
        
            <p>
                Modules Taken:
            </p>
            <ul>
                <li>
                    Procedural Programming
                </li>
                <li>                    
                    Computer Systems and Networks
                </li>
                <li>
                    Logic and Discrete Structures
                </li>
                <li>
                    Professional and Research Practice
                </li>
            </ul>
        </section>

        <figure>
            <img src="images/Queen-Mary.png" alt="Queen Mary, University of London" width=100% height=100%>
            <figcaption>Queen Mary, University of London</figcaption>
        </figure>
    </article>


    <!--Projects Page-->
    <article class="projects" id="projects">
        <section>
            <h1>
                Projects
            </h1>

            <div>
                <h2>Group Presentation on Sustainability in Technology</h2>
                <p>
                    In this assignment project I researched the social impact of high-impact materials.
                    In particular in lower economically developed countries.
                    I created the slides and presented, with my group.
                </p>
                
                <h2>Quiz Board Game Program written in Procedural Programming</h2>
                <p>
                    In this mini-project I iteratively developed a quiz board game.
                    The programming languages used was Java, and the program was written in procedural stlye.
                    This was my first Java programming mini-project during the first year of my degree.
                </p>
            </div>
        </section>
    </article>


    <!--Portfolio Footer-->
    <footer>
        <p>Feel free to contact me: </p>
        <a href="mailto:sulaimanbakalimueden@gmail.com">Email</a>
        <a href="https://www.linkedin.com/in/sulaiman-bakali-mueden-3569b5195/">LinkedIn</a>
    </footer>
    
</body>
</html>