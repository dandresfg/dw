<?php
    session_start();
    require '../database/index.php';
    $connection = DataBase::getInstance()->connection;

    if( isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $result = getAllAnalysis($connection);
        $analysis = is_countable($result) ? $result : null;
    } else {
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

                <div class="text-left">
                    <div class="my-3 px-3">
                        <span class="h5" style="font-weight:bold;">Analisis</span>
                    </div>
                    <hr/>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">C. I.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Analisis</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($analysis as $index=>$analysi): ?>
                                <tr>
                                    <td><?php echo $analysi['cedula'] ?></td>
                                    <td><?php echo $analysi['patientName'] . ' '. $analysi['patientLastName'] ?></td>
                                    <td><?php echo $analysi['userName'] ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <form method="GET" action='/laboratorio/paciente/view.php'>
                                                <button name="id" value="<?php echo $analysi['patient_id']; ?>" class="btn btn-primary">RESULTADOS</button>
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
</body>
</html>