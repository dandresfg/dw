<?php 
    session_start();
    require '../database/index.php';
    $connection = DataBase::getInstance()->connection;

    if(isset($_GET['id'])) {
        $patient = getPatientById($connection, $_GET['id']);
        if(!is_countable($patient)) {
            header('Location: /laboratorio/');
        }
    } else if( isset($_POST['id'] )) {
        $analisysData = $_POST;
        $analisysData['user_id']  = $_SESSION['user']['id'];
        $insertAnalysis = insertAnalysis($connection, $analisysData);
        if($insertAnalysis) {
            $result = updatePatientEvaluationById($connection, $_POST['id']);
            if($result) {
                header('Location: /laboratorio/');
            }
        }
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
                <span class="h5" style="font-weight:bold;">Patient results</span>
                <hr/>
                <div class="text-left">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First name</label>
                            <input type="text" class="form-control" value="<?php echo $patient['name'] . ' ' . $patient['lastName']; ?>" disabled />
                        </div>
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="text"value="<?php echo $patient['email']?>" class="form-control" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Type of Analysis</label>
                            <input type="text" class="form-control" value="<?php echo $patient['study']?>" disabled />
                        </div>
                    </div>
                </div>
                <h4>Results</h4>
                <hr />
                <form class="text-left" action="./results.php" method="POST">
                    <input type="text" name="id" value="<?php echo $patient['id']; ?>" class="d-none" required>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="red_cell" class="form-label">Red blood cells</label>
                            <select class="form-control" name="red_cell" id="red_cell" required>
                                <option value="low">Low</option>
                                <option value="normal" selected>Normal</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="plateles" class="form-label">Plateles</label>
                            <select class="form-control" name="plateles" id="plateles" required>
                                <option value="low">Low</option>
                                <option value="normal" selected>Normal</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="glucose" class="form-label">Blood glucose</label>
                            <input type="text" class="form-control numeric-input" name="glucose" placeholder="Blood glucose" required>
                            <div class="form-text">Electrolytes should be a number</div>
                        </div>
                        <div class="col">
                            <label for="electrolytes" class="form-label">Electrolytes</label>
                            <input type="text" class="form-control numeric-input" placeholder="Electrolytes" name="electrolytes" required>
                            <div class="form-text">Electrolytes should be a number</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="hemoglobine">Hemoglobine</label>
                            <input type="text" class="form-control numeric-input" name="hemoglobine" id="hemoglobine" placeholder="Hemoglobine" required>
                            <div class="form-text">Hemoglobine should be a number</div>
                        </div>
                        <div class="col">
                            <label for="leukocytes">Leukocytes</label>
                            <input type="text" class="form-control numeric-input" name="leukocytes" id="leukocytes" placeholder="Leukocytes" required>
                            <div class="form-text">Leukocytes should be a number</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="proteinuria" class="form-label">Proteinuria</label>
                            <select class="form-control" name="proteinuria" id="proteinuria" required>
                                <option value="low">Low</option>
                                <option value="normal" selected>Normal</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="observation">Observation</label>
                        <textarea class="form-control" name="observation" id="observation" placeholder="There's not observation" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </main> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity=vGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="/laboratorio/assets/js/validate-form.js"></script>

</body>
</html>