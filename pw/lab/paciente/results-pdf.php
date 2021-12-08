<?php
    session_start();
    require '../database/index.php';
    $connection = DataBase::getInstance()->connection;

    if(isset($_POST['id'])) {
        $patient = getPatientById($connection, $_POST['id']);
        $analysis = getAnalysisByPatientId($connection, $_POST['id']);
        $analyst = getUserById($connection, $analysis['user_id']);
    }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<span class="h5" style="font-weight:bold;">Informacion</span>
<hr/>
<div class="text-left">
    <div class="row mb-3">
        <div class="col">
            <span>Nombre Completo: <?php echo $patient['name'] . ' ' . $patient['lastName'];?></span>
        </div>
        <div class="col">
            <span>Correo: <?php echo $patient['email']?></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <span>Estudio: <?php echo $patient['study']?></span>
        </div>
        <div class="col">
            <span>Analista: <?php echo $analyst['name']?>(<?php echo $analyst['email']?>)</span>
        </div>
    </div>
</div>
<h4>Resultados</h4>
<hr />
<div class="text-left">
    <div class="row mb-3">
        <div class="col">
            <span>Globulos rojos: <?php echo $analysis['red_cell']?></span>
        </div>
        <div class="col">
            <span>Plaquetas: <?php echo $analysis['plateles']?></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <span>Glucosa: <?php echo $analysis['glucose']?></span>
        </div>
        <div class="col">
            <span>Electrolitos: <?php echo $analysis['electrolytes']?></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <span>Hemoglobina: <?php echo $analysis['hemoglobine']?></span>
        </div>
        <div class="col">
            <span>Leucocitos: <?php echo $analysis['leukocytes']?></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <span>Proteinuria: <?php echo $analysis['proteinuria']?></span>
        </div>
    </div>
</div>
<br />

<?php

if($analysis['observation']){
    echo '<h4>Obervaciones</h4>
        <hr />
        <div class="form-group mb-3">
            <div>
                '. $analysis['observation'] .'
            </div>
        </div>';
}

?>
