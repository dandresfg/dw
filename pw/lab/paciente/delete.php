<?php
    session_start();
   require '../database/index.php';
    $connection = DataBase::getInstance()->connection;

    if(isset($_GET['id'])) {
        $result = deletePatientById($connection, $_GET['id']);
        header('Location: /laboratorio/');
    }

?>