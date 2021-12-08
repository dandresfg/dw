<?php 
    session_start();
   require '../database/index.php';

    $connection = DataBase::getInstance()->connection;

    if(isset($_GET['id'])) {
        $analysis = getAnalysisByPatientId($connection, $_GET['id']);
        $patient = getPatientById($connection, $_GET['id']);
        $analyst = getUserById($connection, $analysis['user_id']);
    }
        
?>


<!DOCTYPE html>
<html lang="en">

<?php require '../partials/head.php'?>

<body>

    <?php require '../partials/header.php'?>

    <div>
        <div class="d-flex">
            <?php require '../partials/aside.php'?>
    
            <main class="main-styles">
                <div class="my-3 px-4">
                    <span class="h5" style="font-weight:bold;"><?php echo $patient['name'] . ' '. $patient['lastName']?></span>
                    <p><?php echo $patient['email']?></p>
                </div>
                <hr/>
                <div class="text-left m-4">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="analyst" class="form-label">Analista</label>
                            <input type="text" value="<?php echo $analyst['name']?>" class="form-control" disabled required>
                        </div>
                        <div class="col">
                            <label class="form-label">Estudio</label>
                            <input type="text" class="form-control" value="<?php echo $patient['study']?>" disabled required/>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="text-left m-4">
                    <input type="text" name="id" value="<?php echo $patient['id']; ?>" class="d-none" disabled required>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="red_cell" class="form-label">Globulos rojos</label>
                            <input type="text" name="red_cell" value="<?php echo $analysis['red_cell']?>" class="form-control" placeholder="Red blood cells" disabled required>
                        </div>
                        <div class="col">
                            <label for="plateles" class="form-label">Plaquetas</label>
                            <input type="text" name="plateles" value="<?php echo $analysis['plateles']?>" class="form-control" placeholder="Plateles" disabled required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="glucose" class="form-label">Glucosa</label>
                            <input type="text" class="form-control" name="glucose" value="<?php echo $analysis['glucose']?>" placeholder="Blood glucose" disabled required>
                        </div>
                        <div class="col">
                            <label for="electrolytes" class="form-label">Electrolitos</label>
                            <input type="text" class="form-control" placeholder="Electrolytes" name="electrolytes" value="<?php echo $analysis['electrolytes']?>" disabled required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="hemoglobine">Hemoglobina</label>
                            <input type="text" class="form-control" name="hemoglobine" value="<?php echo $analysis['hemoglobine']?>" id="hemoglobine" placeholder="Hemoglobine" disabled required>
                        </div>
                        <div class="col">
                            <label for="leukocytes">Leucocitos</label>
                            <input type="text" class="form-control" name="leukocytes" value="<?php echo $analysis['leukocytes']?>" id="leukocytes" placeholder="Leukocytes" disabled required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="proteinuria" class="form-label">Proteinuria</label>
                            <input type="text" class="form-control" name="proteinuria" value="<?php echo $analysis['proteinuria']?>" id="proteinuria" placeholder="80kg" disabled required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="observation">Observation</label>
                        <textarea class="form-control" name="observation" id="observation" placeholder="" rows="3" disabled><?php echo $analysis['observation']?></textarea>
                    </div>
                    <form method="POST" action='/laboratorio/paciente/email.php'>
                        <button name="id" value="<?php echo $_GET['id'] ?>" class="btn btn-primary">Generar PDF</button>
                    </form>
                </div>
            </main> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity=vGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>