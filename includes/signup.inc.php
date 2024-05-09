<?php
if (isset($_POST['signup-submit'])){

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $confirmpwd = $_POST['pwd-repeat'];

   if(empty($username) || empty($email) || empty($password) || empty($confirmpwd)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail".$email);
        exit();
   } 
   elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invalidmail&uid");

   }
   else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
   }
   else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../signup.php?error=invaliduidl&mail=".$email);
    exit();
   }
   elseif ($password !== $confirmpwd) {
    header("Location: ../signup.php?error=passwordnotmatch&mail=".$email."&uid=".$username);
   }
   else {
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=? ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0){
            header("Location: ../signup.php?error=usertaken&mail=".$email);
            exit();
        }
        else {
            $sql = "INSERT INTO users (uidUSers, emailUsers, pwdUsers) VALUES (?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else {
                $hashedPwd = password_hash($password, PASSWORD_BCRYPT);

                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../signup.php?signup=success");
                
            }

    
        }
    }
   }
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}
else {
    header("Location: ../signup.php");
    exit();
}
