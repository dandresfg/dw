<?php

    // Helper
    function isValidNumberOrZero($n){
        if(is_numeric($n)) return $n;

        echo "El valor (".$n.") no es un numero y ha sido sustituido por un 0";
        return 0;
    };

    if(isset($_POST['box'])){
        $lado = 2 * pow(isValidNumberOrZero($_POST['box']), 2);

        $ap = round(tan(deg2rad(22.5)), 2);
        $area = round($lado / $ap, 2);

        require('./result.php');
    } else {
        require('./form.html');
    }
?>