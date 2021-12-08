<?php

    session_start();
    require '../database/index.php';

    if(isset($_SESSION['user'])) {
        header('Location: /laboratorio');
    }

    $connection = DataBase::getInstance()->connection;
    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $user = getUserByEmail($connection, $_POST['email']);
        if( is_countable($user) && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: /laboratorio');
        } else {
            $message = 'Datos erroneos';
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<?php require '../partials/head.php'?>

<body>
    <main class="container mx-auto mt-5">
        <h1>Bienvenidos</h1>

        <?php if(!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <div class="container d-flex justify-content-center align-item-center my-2">
            <form style="width: 400px;" action="./login.php" method="post">
                <input type="text" class="form-control form-control-sm" name="email" placeholder="Ingresa tu email">
                <input type="password" class="form-control form-control-sm my-2" name="password" placeholder="Ingresa tu password">
                <button type="submit" class="btn btn-dark">Iniciar Sesion</button>
            </form>
        </div>
        <a href="./signup.php">Crear cuenta</a></span>
    </main>
</body>
</html>