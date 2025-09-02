<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Includes/Style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>FlightAir - Mundo de Aviones</title>
</head>
<body>
    <?php include("Includes/header.html"); ?>

    
    <section class="banner-hero">

        <div class="banner-hero-content">
            <h2>¿Te apasiona la aviación?</h2>
            <p>
                FlightAir es tu portal para descubrir el universo de los aviones: historia, tecnología, formación y curiosidades.<br>
                ¡Explora, aprende y déjate inspirar por el mundo de la aviación!
            </p>
        </div>
        
        <div id="flightsContainer"></div>
        <button id="loadMoreBtn" style="display:none;">Seguir</button>
    </div>
    <script src="js/llamarVuelos.js"></script>
    </section>


    <main>
        <section class="bienvenida">
            <h1 id="titulo-inicio">Bienvenido a <span class="marca">FlightAir</span></h1>
            <p class="intro-text">
                Descubre el fascinante mundo de los aviones.<br>
                Explora modelos, fabricantes, historia y curiosidades de la aviación.
            </p>
        </section>

        <section class="destacados-aviones">
            <h2 id="titulo-destacados">Fabricantes destacados</h2>
            <div class="grid-modelos">
                <?php
                include("Includes/db_connect.php");
                $result = $db->query("SELECT fab_nom, fab_imagen FROM fabricantes");
                while ($fab = $result->fetchArray(SQLITE3_ASSOC)) {
                    $url = "#";
                    if (strtolower($fab['fab_nom']) == "airbus") $url = "/Airplane/airbus.php";
                    if (strtolower($fab['fab_nom']) == "boeing") $url = "/Airplane/boing.php";
                    if (strtolower($fab['fab_nom']) == "embraer") $url = "/Airplane/embraer.php";
                    if (strtolower($fab['fab_nom']) == "bombardier") $url = "/Airplane/bombardier.php";
                    if (strtolower($fab['fab_nom']) == "otros") $url = "/Airplane/otrosAviones.php";

                    // Puedes agregar más fabricantes aquí si los tienes
                    echo '<a href="'.$url.'" class="card-modelo">';
                    echo '<img src="'.htmlspecialchars($fab['fab_imagen']).'" alt="'.htmlspecialchars($fab['fab_nom']).'" />';
                    echo '<h3>'.htmlspecialchars($fab['fab_nom']).'</h3>';
                    echo '<p>Descubre los aviones de '.htmlspecialchars($fab['fab_nom']).'.</p>';
                    echo '</a>';
                }
                ?>
            </div>
        </section>

        <section class="curiosidades">
            <h2>¿Sabías que...?</h2>
            <ul class="lista-curiosidades">
                <li>✈️ El Airbus A380 es el avión de pasajeros más grande del mundo.</li>
                <li>🌎 El Boeing 747 fue el primer avión de doble pasillo de la historia.</li>
                <li>🚀 Algunos aviones comerciales pueden volar a más de 900 km/h.</li>
            </ul>
        </section>
    </main>

    <!-- Sección fuera del container principal: Historia de la aviación -->
    <section class="historia-aviacion">
        <div class="historia-content">
            <h2>Historia de la Aviación</h2>
            <p>
                Desde los primeros vuelos de los hermanos Wright en 1903 hasta los modernos jets de hoy, la aviación ha transformado el mundo. 
                La evolución de los aviones ha permitido conectar continentes, acercar culturas y revolucionar el transporte global.
            </p>
            <ul>
                <li><strong>1903:</strong> Primer vuelo controlado por los hermanos Wright.</li>
                <li><strong>1919:</strong> Primer vuelo transatlántico sin escalas.</li>
                <li><strong>1970:</strong> Nace el Boeing 747, el "Jumbo Jet".</li>
                <li><strong>2005:</strong> Primer vuelo del Airbus A380, el avión de pasajeros más grande.</li>
            </ul>
        </div>
    </section>

    <!-- Sección fuera del container principal: Curso de Piloto -->
    <section class="curso-piloto">
        <div class="curso-content">
            <h2>¿Quieres ser piloto?</h2>
            <p>
                Conoce los pasos para convertirte en piloto profesional: requisitos, formación, licencias y oportunidades de carrera.<br>
                <a href="../Airplane/curso.php" class="btn-curso">Ver más sobre el curso de piloto</a>
            </p>
            <div class="curso-pasos">
                <div>
                    <span>📚</span>
                    <h3>Formación teórica</h3>
                    <p>Aprende sobre navegación, meteorología, reglamentos y sistemas de aeronaves.</p>
                </div>
                <div>
                    <span>✈️</span>
                    <h3>Práctica de vuelo</h3>
                    <p>Horas de vuelo con instructor y simulador para dominar el pilotaje.</p>
                </div>
                <div>
                    <span>📝</span>
                    <h3>Examen y licencias</h3>
                    <p>Supera los exámenes oficiales y obtén tu licencia de piloto.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include("Includes/footer.html"); ?>
</body>
</html>