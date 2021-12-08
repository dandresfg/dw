<?php
    require_once ('database.php');

    if(isset($_POST['button'])){
        $db = DB::getInstance();
        $name = $_POST['name'];

        $rs = $db->prepare("SELECT name FROM pozo WHERE name = '$name' LIMIT 1");
        $rs->execute();
        $pozo = $rs->fetch();

        if(!$pozo){
            $stmt= $db->prepare("INSERT INTO pozo (name) VALUES (:name)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            echo "Ya existe un pozo con ese nombre";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo $pozo['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <main class="container mx-auto">
        <header class="container mx-auto">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php">Control de pozos</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </header>
        <section class="container-fluid">
            <form action="create.php" method="post" class="row mt-4">
                <div class="col-12">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" name="name" id="name" placeholder="Nombre" required="true">
                </div>
                <div class="col-12">
                    <button type="submit" class="w-100 btn btn-primary" name="button" value="enviar">Guardar</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>