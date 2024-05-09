<?php
require "header.php"
?>

<main>
    <?php
    if(isset($_SESSION['userId'])){
        echo '<h1 style="text-align: center; margin-top: 50px;"> You are Logged in  </h1>';
    }
    else{
        echo '<h1 style="text-align: center; margin-top: 50px;"> You are Logged out  </h1>';
    }
    ?>



</main>

<?php
require "footer.php"
?>