<?php
    session_start();
    require './database/index.php';

    if( isset($_SESSION['user']) ) {
        $user = $_SESSION['user'];
    } else {
        header('Location: /laboratorio/auth/login.php');
    }

?>
<!DOCTYPE html>
<html lang="es">
<?php require 'partials/head.php'?>
<body>
    <?php require 'partials/header.php'?>
    <div>
        <div class="d-flex">
            <?php require 'partials/aside.php'?>
            <main class="main-styles">

                <div class="text-left">
                    <div class="my-3 px-4">
                        <span class="h5" style="font-weight:bold;">Pacientes</span>
                    </div>
                    <hr/>
                    <table class="table mt-4 p-4">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Email</th>
                                <th scope="col">Examen</th>
                                <th scope="col">Evaluaciones</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $connection = DataBase::getInstance()->connection;
                                $result = getActivePatient($connection);
                                $pacientes = is_countable($result) ? $result : null;
                            ?>
                            <?php foreach($pacientes as $index=>$paciente): ?>
                                <tr>
                                    <td><?php echo $paciente['name'] . ' '. $paciente['lastName'] ?></td>
                                    <td><?php echo $paciente['cedula'] ?></td>
                                    <td><?php echo $paciente['email'] ?></td>
                                    <td><?php echo $paciente['study'] ?></td>
                                    <td>
                                        <?php echo 
                                                $paciente['evaluated'] ? 'Yes'
                                                    : ($user['analyst'] 
                                                        ? '<form method="GET" action="/laboratorio/paciente/results.php"> <button name="id" value="'. $paciente["id"] . '." class="btn btn-secondary">Evaluate</button> </form>'
                                                        : 'No'
                                                    );
                                        ?>            
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <?php if($paciente['evaluated']): ?>
                                                <form method="GET" action='/laboratorio/paciente/view.php'>
                                                    <button name="id" value="<?php echo $paciente['id'] ?>" class="btn btn-primary">DETALLES</button>
                                                </form>
                                            <?php else: ?>
                                                <form method="GET" action='/laboratorio/paciente/update.php'>
                                                    <button name="id" value="<?php echo $paciente['id'] ?>" class="btn btn-warning">MODIFICAR</button>
                                                </form>
                                            <?php endif; ?>
                                            <form method="GET" action='/laboratorio/paciente/delete.php'>
                                                <button name="id" value="<?php echo $paciente['id'] ?>" class="btn btn-danger">ELIMINAR</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>