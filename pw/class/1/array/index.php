<?php
    session_start();

    if(isset($_POST['data'])){
        require('./add.php');
    }
    
    require('./form.php');
    require('./results.php');
?>