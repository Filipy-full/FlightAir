<?php
$access_key = '03d43ae61d8e4757f5b3b9d4ba286b94';
$limit = 100; 

// Consulta a la API de aeropuertos
$api_url = "http://api.aviationstack.com/v1/airports?access_key=$access_key&limit=$limit";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

$airports = $data['data'] ?? [];

// ORDENAR ANTES DE MOSTRAR
usort($airports, function($a, $b) {
    return strcmp($a['country_name'] ?? '', $b['country_name'] ?? '');
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Aeropuertos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="StyleAirplane/aeropuerto.css">
</head>
<body>
    <?php include("../WebSite/Includes/header.html"); ?>
    <h1>Listado de Aeropuertos Disponibles</h1>
    <div class="table-container">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>País</th>
                    <th>IATA</th>
                    <th>ICAO</th>
                    <th>GMT</th>
                    <th>Zona Horaria</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($airports as $airport): ?>
                <tr>
                    <td><?= htmlspecialchars($airport['airport_name'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['city_iata_code'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['country_name'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['iata_code'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['icao_code'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['gmt'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['timezone'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['latitude'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($airport['longitude'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (empty($airports)): ?>
            <p class="small-text">No se encontraron aeropuertos o hubo un problema con la API.</p>
        <?php endif; ?>
        <?php include("../WebSite/Includes/footer.html"); ?>
    </div>
</body>
</html>