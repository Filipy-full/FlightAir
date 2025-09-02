<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Vuelos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="StyleAirplane/vuelos.css">
</head>
<body>
    <?php include("../WebSite/Includes/header.html"); ?>
    
    <div class="container">
        <h1 id="title-vuelos" >Consulta de Vuelos en Tiempo Real</h1>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Buscar por aerolínea, aeropuerto, estado...">
            <div id="autocompleteList" class="autocomplete-list" style="display:none;"></div>
            <button id="loadFlightsBtn">Cargar vuelos</button>
        </div>
        <div id="flightsContainer"></div>
        <button id="loadMoreBtn" style="display:none;">Seguir</button>
    </div>
    <?php include("../WebSite/Includes/footer.html");?>
    <script src="../Airplane/js/llamarVuelos.js"></script>
</body>