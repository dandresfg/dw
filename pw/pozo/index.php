<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pozos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <header class="container mx-auto">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php">Control de pozos</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </header>
        <section class="container mx-auto">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once ('database.php');

                        $db = DB::getInstance();
                        $rs = $db->prepare("SELECT * FROM pozo");
                        $rs->execute();
                        $pozos = $rs->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($pozos as $item){
                            echo '<tr>
                                    <th scope="row">'.$item["idPozo"].'</th>
                                    <td>'.$item["name"].'</td>
                                    <td style="text-align: right">
                                        <a href="view.php?id='.$item["idPozo"].'" class="btn btn-sm btn-primary">DETALLES</a>
                                        <a href="destroy.php?id='.$item["idPozo"].'" class="btn btn-sm btn-danger">ELIMINAR</a>
                                    </td>
                                </tr>';
                        };
                    ?>
                </tbody>
            </table>
        </section>
        <section class="container mx-auto">
            <div class="w-100" style="text-align: right">
                <a href="create.php" class="btn btn-success">Anadir Pozo</a>
            </div>
        </section>
    </main>
</body>
</html>l