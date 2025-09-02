<?php
// Conectar a la base de datos SQLite
include("../WebSite/Includes/db_connect.php");
include("../WebSite/Includes/header.html");

// Obtener todos los modelos de aviones Airbus (fab_id = 2)
$query = "SELECT m.mod_nom, m.mod_descripcio, m.mod_imagen, m.fecha_lanzamiento, m.velocidad_maxima, f.fab_nom
          FROM modelos_aviones m
          JOIN fabricantes f ON m.fab_id = f.fab_id
          WHERE m.fab_id = 2";
$result = $db->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelos Airbus | FlightAir</title>
    <link rel="stylesheet" href="../WebSite/Includes/Style/modelAirplane.css">
    <style>
        /* Modal para imagen expandida */
        .modal-img-bg {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0; top: 0;
            width: 100vw; height: 100vh;
            background: rgba(44,62,80,0.82);
            align-items: center;
            justify-content: center;
        }
        .modal-img-bg.active {
            display: flex;
        }
        .modal-img-content {
            position: relative;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.18);
            padding: 18px 18px 10px 18px;
            max-width: 96vw;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: modalFadeIn 0.25s;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.95);}
            to { opacity: 1; transform: scale(1);}
        }
        .modal-img-content img {
            max-width: 80vw;
            max-height: 70vh;
            border-radius: 10px;
            box-shadow: 0 4px 18px rgba(44,62,80,0.13);
            margin-bottom: 12px;
        }
        .modal-img-close {
            position: absolute;
            top: 10px; right: 18px;
            font-size: 2em;
            color: #2980b9;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
            z-index: 10;
            transition: color 0.2s;
        }
        .modal-img-close:hover {
            color: #e74c3c;
        }
        .modal-img-title {
            font-size: 1.25em;
            color: #14507a;
            margin-bottom: 8px;
            text-align: center;
        }
        @media (max-width: 600px) {
            .modal-img-content img {
                max-width: 96vw;
                max-height: 50vh;
            }
        }
        /* Cursor zoom para imágenes */
        .aircraft-image {
            cursor: zoom-in;
            transition: box-shadow 0.2s;
        }
        .aircraft-image:hover {
            box-shadow: 0 6px 24px #2980b9aa;
        }
    </style>
</head>
<body>
    <main>
        <h1 class="title-modelos" id="titulo-Airbus">Modelos de Aviones Airbus</h1>
        <div class="container" id="container-modelos-Airbus">
            <?php
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo "<div class='aircraft-card' data-modelo='" . htmlspecialchars($row['mod_nom']) . "'>";
                echo "<h2 class='modelo-nombre'>" . htmlspecialchars($row['mod_nom']) . " <span class='modelo-fabricante'>(" . htmlspecialchars($row['fab_nom']) . ")</span></h2>";
                echo "<p class='modelo-descripcion'>" . htmlspecialchars($row['mod_descripcio']) . "</p>";
                echo "<img src='" . htmlspecialchars($row['mod_imagen']) . "' alt='" . htmlspecialchars($row['mod_nom']) . "' class='aircraft-image' data-nombre='" . htmlspecialchars($row['mod_nom']) . "'>";
                // Información extra bajo la imagen
                echo "<div class='modelo-info-extra'>";
                echo "<span class='info-label'><strong> Velocidad máxima:</strong> " . (htmlspecialchars($row['velocidad_maxima']) ? htmlspecialchars($row['velocidad_maxima']) . " km/h" : "N/D") . "</span><br>";
                echo "<span class='info-label'><strong> Lanzamiento:</strong> " . (htmlspecialchars($row['fecha_lanzamiento']) ? htmlspecialchars($row['fecha_lanzamiento']) : "N/D") . "</span>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </main>

    <!-- Modal para imagen expandida -->
    <div class="modal-img-bg" id="modal-img-bg">
        <div class="modal-img-content">
            <button class="modal-img-close" id="modal-img-close" title="Cerrar">&times;</button>
            <div class="modal-img-title" id="modal-img-title"></div>
            <img src="" alt="Imagen ampliada" id="modal-img-big">
        </div>
    </div>

    <?php include("../WebSite/Includes/footer.html"); ?>
    <script>
    // Modal expandir imagen
    document.addEventListener('DOMContentLoaded', function() {
        const modalBg = document.getElementById('modal-img-bg');
        const modalImg = document.getElementById('modal-img-big');
        const modalTitle = document.getElementById('modal-img-title');
        const closeBtn = document.getElementById('modal-img-close');

        // Al hacer click en cualquier imagen de avión
        document.querySelectorAll('.aircraft-image').forEach(function(img) {
            img.addEventListener('click', function() {
                modalImg.src = this.src;
                modalImg.alt = this.alt;
                modalTitle.textContent = this.getAttribute('data-nombre');
                modalBg.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        // Cerrar modal
        closeBtn.addEventListener('click', cerrarModal);
        modalBg.addEventListener('click', function(e) {
            if (e.target === modalBg) cerrarModal();
        });
        function cerrarModal() {
            modalBg.classList.remove('active');
            modalImg.src = '';
            modalTitle.textContent = '';
            document.body.style.overflow = '';
        }
        // Cerrar con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") cerrarModal();
        });
    });
    </script>
</body>
</html>
<?php
$db->close();
?>