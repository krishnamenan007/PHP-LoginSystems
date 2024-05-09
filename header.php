<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <a href="#">
                    <img src="">
                </a>
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#">Portfolio</a>
                    </li>
                    <li>
                        <a href="#">About me</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>

                </ul>
                <div class="form-container">
                    <?php
                        if(isset($_SESSION['userId'])){
                            echo '<form action="includes/logout.inc.php" method="post">
                                    <button type="submit" name="logout-submit">Logout</button>
                                </form>';
                        }
                        else{
                            echo '
                            <form action="includes/login.inc.php" method="post">
                                    <input type="text" name="mailuid" placeholder="Email">
                                    <input type="password" name="pwd" placeholder="Password">
                                    <button type="submit" name="login-submit">Login</button>
                                </form>
                                
                                <button><a class="signup" href="signup.php">Signup</a></button>';
                        }
                    ?>
                </div>





            </nav>

        </header>
        
        <!-- <script src="" async defer></script> -->
    </body>
</html>