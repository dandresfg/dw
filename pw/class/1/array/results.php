<?php
    $array = $_SESSION["employees"];
    for($i = 0; $i < count($array); $i++){
        echo '<div>
            <p>'.$array[$i]['name'].' '.$array[$i]['lastname'].' C.I.<strong>'.$array[$i]['ci'].'</strong></p>
            <span>Sueldo: '.$array[$i]['payment'].'</span>
            <p>Departamento: '.$array[$i]['dpto'].'</p>
            <span>Lugar: '.$array[$i]['place'].'</span>
            <hr/>
        </div>';
    }
?>