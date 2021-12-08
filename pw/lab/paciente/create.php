<?php
    session_start();
    require '../database/index.php';
    $connection = DataBase::getInstance()->connection;

    if(isset($_POST['name'])) {
        $result = createPatient($connection, $_POST);
        if($result) {
            echo 'Paciente creado';
        } else {
            echo 'No se pudo crear al paciente';
        }
    }

    if( !isset($_SESSION['user']) ) {
        header('Location: /laboratorio/auth/login.php');
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
                <div class="my-3">
                    <span class="h5" style="font-weight:bold;">Agregar paciente</span>
                </div>
                <hr/>
                <form class="text-left m-4" action="./create.php" method="POST" id="main-form">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label">Apellido</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Apellido" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required>
                        </div>
                        <div class="col">
                            <label for="id" class="form-label">C.I.</label>
                            <input type="text" class="form-control"  placeholder="20708542" name="id" id="id" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="date">Fecha</label>
                            <input type="date" class="form-control" name="date" id="date" required>
                        </div>
                        <div class="col">
                            <label for="direction">Direccion</label>
                            <input type="text" class="form-control" name="direction" id="direction" placeholder="Barrio los andes, calle 112A" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="weight" class="form-label">Peso</label>
                            <input type="text" class="form-control numeric-input" name="weight" id="weight" placeholder="80kg" required>
                        </div>
                        <div class="col">
                            <label for="height" class="form-label">Altura</label>
                            <input type="text" class="form-control numeric-input" name="height" id="height" placeholder="1.8m" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type-exam">Examen</label>
                        <select class="form-control" name="type-exam" id="type-exam" proteinuria>
                            <option value="Lipidic profile">Ematología completa</option>
                            <option value="Complete blood count">Urinálisis completo</option>
                            <option value="Basic metabolic panel">Colesterol</option>
                            <option value="Hepatic Profile">TSH, T3, T4</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Historial medico</label>
                        <textarea class="form-control" name="description" id="description" placeholder="" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </main> 
        </div>
    </div>
    <script src="/laboratorio/assets/js/validate-form.js"></script>
</body>
</html>