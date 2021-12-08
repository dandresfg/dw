<?php

    session_start();
    require '../database/index.php';

    if(isset($_SESSION['user'])) {
        header('Location: /laboratorio');
    }

    $connection = DataBase::getInstance()->connection;
    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $result = createUser($connection, $_POST);
        if($result) {
            $message = 'Nuevo usuario creado';
        } else {
            $message = 'Ocurrio un error creando el usuario';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php require '../partials/head.php'?>

<body>

    <?php if(!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <h1>Bienvenidos</h1>

    <div class="container d-flex justify-content-center align-item-center my-4">
        <form style="width: 400px;" class="my-2" action="./signup.php" method="post" id="signup-form">
            <div class="row mb-4">
                <label class="form-label text-left m-0">Nombre</label>
                <input type="text" class="form-control form-control-sm" name="name" placeholder="Nombre" required>
            </div>
            <div class="row mb-4">
                <label class="form-label text-left m-0">Email</label>
                <input type="email" class="form-control form-control-sm" name="email" placeholder="Ingresa tu email" required>
            </div>
            <div class="row mb-4">
                <label class="form-label text-left m-0">Password</label>
                <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Ingresa tu password" required>
            </div>
            <div class="row mb-4">
                <label class="form-label text-left m-0">Repetir Password</label>
                <input type="password" class="form-control form-control-sm" name="confirm_password" id="confirm_password" placeholder="Repetir Password" required>
            </div>
            <div class="row my-2">
                <div class="col-12">
                    <span>Rol</span>
                </div>
                <div class="col">
                    <input type="radio" id="analyst" name="rol" value="analyst" checked>
                    <label for="analyst">analyst</label>
                </div>
                <div class="col">
                    <input type="radio" id="nurse" name="rol" value="nurse">
                    <label for="nurse">Nurse</label>
                </div>
            </div>
            <button type="submit" class="btn btn-dark my-2">Crear Cuenta</button>
        </form>
    </div>
    <span><a href="./login.php">Iniciar sesion</a></span>
    <script>
        const form = document.getElementById('signup-form');
        const inputPassword = document.getElementById('password');
        const inputConfirmPassword = document.getElementById('confirm_password');

        form.addEventListener('submit', (event) => {
            const password = inputPassword.value;
            const confirmPassword = inputConfirmPassword.value;

            if( password != confirmPassword ) {
                alert('Las claves no coinciden');
                event.preventDefault();
            };
        });
    </script>
</body>
</html>