<?php
    session_start();
   require '../database/index.php';

    $connection = DataBase::getInstance()->connection;

    if( isset($_GET['id'] )) {
        $patient = getPatientById($connection, $_GET['id']);
        if( !is_countable($patient) ) {
            header('Location: /laboratorio/');
        }
    } else if( isset($_POST['name']) ) {
        $result = updatePatientById($connection, $_POST);
        if($result) {
            header('Location: /laboratorio/');
        } else {
            echo 'Sorry there must have been a issue updating user';
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
                <span class="h5" style="font-weight:bold;">Update a patient</span>
                <hr/>
                <form class="text-left" action="./update.php" method="POST" id="main-form">
                    <input type="text" name="id" value="<?php echo $patient['id']; ?>" class="d-none" required>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">First name</label>
                            <input type="text" name="name" value="<?php echo $patient['name']; ?>" id="name" class="form-control" placeholder="First name" required>
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" name="lastName" value="<?php echo $patient['lastName']; ?>"id="lastName" class="form-control" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $patient['email']; ?>" id="email" placeholder="example@example.com" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="col">
                            <label for="cedula" class="form-label">ID</label>
                            <input type="text" class="form-control" value="<?php echo $patient['cedula']; ?>" placeholder="20708542" name="cedula" id="cedula" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="date">Date of Born</label>
                            <input type="date" class="form-control" value="<?php echo $patient['birth_date']; ?>"  name="date" id="date" required>
                        </div>
                        <div class="col">
                            <label for="direction">Direction</label>
                            <input type="text" class="form-control" value="<?php echo $patient['direction']; ?>" name="direction" id="direction" placeholder="Av. Padilla, Calle 74" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" class="form-control numeric-input" value="<?php echo $patient['weight']; ?>" name="weight" id="weight" placeholder="80kg" required>
                            <div class="form-text">Weight should be a number</div>
                        </div>
                        <div class="col">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control numeric-input" value="<?php echo $patient['height']; ?>" name="height" id="height" placeholder="1.8m" required>
                            <div class="form-text">Height should be a number</div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type-exam">Type of Exam</label>
                        <select class="form-control" name="type-exam" id="type-exam" required>
                            <option value="Lipidic profile" <?php echo $patient['study'] === 'Lipidic profile' ? 'selected' : ''; ?>>Lipidic profile</option>
                            <option value="Complete blood count" <?php echo $patient['study'] === 'Complete blood count' ? 'selected' : ''; ?>>Complete blood count</option>
                            <option value="Basic metabolic panel" <?php echo $patient['study'] === 'Basic metabolic panel' ? 'selected' : ''; ?>>Basic metabolic panel</option>
                            <option value="Hepatic Profile" <?php echo $patient['study'] === 'Hepatic Profile' ? 'selected' : ''; ?>>Hepatic Profile</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Medical History</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Can be ampty is not apply" rows="3"><?php echo $patient['medical_history']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </main> 
        </div>
    </div>
    <script src="/laboratorio/assets/js/validate-form.js"></script>

</body>
</html>