<?php
    $options = [ "name", "lastname", "ci", "payment", "dpto", "place" ];
    $arr = isset($_SESSION["employees"]) ? $_SESSION["employees"] : [];

    for($i = 0; $i < 3; $i++){
        $item = [];
        for($j = 0; $j < 6; $j++){
            $item[$options[$j]] = $_POST[$options[$j]][$i];
        }

        $isRepeat = false;
        for($x = 0; $x < count($arr); $x++){
            if(in_array($item['ci'], $arr[$x])){
                echo "Cedula de identidad repetida, empleado ignorado.";
                $isRepeat = true;
                break;
            }
        }

        // Solo si tiene nombre cedula y sueldo
        if(!$isRepeat && $item['name'] && $item['ci'] && $item['payment']){
            $arr[] = $item;
        } else {
            echo "Los campos requeridos no estan completos (nombre, sueldo, cedula).";
        }
    }

    $_SESSION["employees"] = $arr;
?>