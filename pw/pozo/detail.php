<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viendo: <?php echo $pozo['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <form action="view.php?id=<?php echo $pozo['idPozo']; ?>" method="post" class="row mt-4">
                <input type="hidden" id="datajson" value='<?php echo json_encode($stats) ?>' />
                <div class="col-12 col-md-3">
                    <input type="date" class="form-control mb-2 mr-sm-2" name="date" id="Fecha" placeholder="Fecha" required="true">
                </div>
                <div class="col-12 col-md-2">
                    <input type="time" class="form-control mb-2 mr-sm-2" name="time" id="Fecha" placeholder="Fecha" required="true">
                </div>
                <div class="col-12 col-md-2">
                    <input type="number" class="form-control mb-2 mr-sm-2" name="value" id="medida" placeholder="Valor" required="true">
                </div>
                <div class="col-12 col-md-3">
                    <input type="text" class="form-control mb-2 mr-sm-2" name="user" id="user" placeholder="Usuario" required="true">
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="w-100 btn btn-primary" name="button" value="medidas">Enviar</button>
                </div>
            </form>
        </section>
        <section class="container mx-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($entradas as $key => $item){
                            echo '<tr>
                                    <th scope="row">#'.($key+1).'</th>
                                    <td>'.date_format(new DateTime($item["time"]), 'd/m/Y').' - '.$item["hour"].'</td>
                                    <td>'.$item["value"].'</td>
                                    <td>'.$item["user"].'</td>
                                </tr>';
                        };
                    ?>
                </tbody>
            </table>
        </section>
        <section class="col-8 mx-auto my-4">
            <div>
                <canvas id="historial"></canvas>
            </div>
        </section>
    </main>
</body>
</html>

<script>
    try {
        const data = JSON.parse(document.querySelector('#datajson').value)
        const config = {
            type: 'line',
            data: {
                labels: data.map(item => item.time),
                datasets: [{
                    label: 'Medidas por dia',
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    data: data.map(item => +item.suma),
                }]
            },
            options: {}
        };
        const myChart = new Chart( document.getElementById('historial'), config);
    } catch (error) {
        console.log(error)
    }
</script>