<?php
    require_once ('database.php');


    // IF ID
    if(isset($_GET['id'])){
        $db = DB::getInstance();
        $id = (int) $_GET['id'];

        // INSERT
        if(isset($_POST['button'])){
            $stmt= $db->prepare("INSERT INTO score (idPozo, time, hour, value, user) VALUES (:id,:fecha,:hora,:valor,:user)");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $_POST['date'], PDO::PARAM_STR);
            $stmt->bindParam(':hora', $_POST['time'], PDO::PARAM_STR);
            $stmt->bindParam(':valor', $_POST['value'], PDO::PARAM_STR);
            $stmt->bindParam(':user', $_POST['user'], PDO::PARAM_STR);
            if ($stmt->execute()){
            } else {
                $arr = $stmt->errorInfo();
                print_r($arr);
            }
        }
        
        // PREPARE TO SHOW
        $rs = $db->prepare("SELECT * FROM pozo WHERE idPozo = '$id'");
        $rs->execute();
        $pozo = $rs->fetch();
        
        $rs = $db->prepare("SELECT * FROM score WHERE idPozo = '$id' ORDER BY time, hour");
        $rs->execute();
        $entradas = $rs->fetchAll(PDO::FETCH_ASSOC);
        
        $rs = $db->prepare("SELECT idScore, time, SUM(value) as suma FROM score WHERE idPozo = '$id' GROUP BY time ORDER BY time");
        $rs->execute();
        $stats = $rs->fetchAll(PDO::FETCH_ASSOC);

        // SHOW
        require_once ('detail.php');
    }
?>