<?php
$db = new SQLite3('../DataBase/aerolineas.db');

// Consultar y mostrar los datos en una tabla HTML
$result = $db->query("SELECT * FROM aerolineas ORDER BY pais ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aerolíneas (SQLite)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="StyleAirplane/aerolinea.css">
    

</head>
<body>
    <?php include("../WebSite/Includes/header.html"); ?>
    <h1>Listado de Aerolíneas</h1>
    <div class="container">
        <table class="table table-bordered table-hover" id="tabla-aerolineas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>IATA</th>
                    <th>ICAO</th>
                    <th>Web</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
                <tr class="fila-aerolinea"
                    data-nombre="<?= htmlspecialchars($row['nombre']) ?>"
                    data-pais="<?= htmlspecialchars($row['pais']) ?>"
                    data-iata="<?= htmlspecialchars($row['iata']) ?>"
                    data-icao="<?= htmlspecialchars($row['icao']) ?>"
                    data-web="<?= htmlspecialchars($row['web']) ?>"
                    data-descripcion="<?= htmlspecialchars($row['descripcion']) ?>"
                    style="cursor:pointer;">
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['pais']) ?></td>
                    <td><?= htmlspecialchars($row['iata']) ?></td>
                    <td><?= htmlspecialchars($row['icao']) ?></td>
                    <td>
                        <?php if ($row['web']): ?>
                            <a href="<?= htmlspecialchars($row['web']) ?>" target="_blank" onclick="event.stopPropagation();">Sitio web</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="modalAerolinea" tabindex="-1" aria-labelledby="modalAerolineaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAerolineaLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body" id="modalAerolineaBody">
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.querySelectorAll('.fila-aerolinea').forEach(function(row) {
        row.addEventListener('click', function() {
            const nombre = this.dataset.nombre;
            const pais = this.dataset.pais;
            const iata = this.dataset.iata;
            const icao = this.dataset.icao;
            const web = this.dataset.web;
            const descripcion = this.dataset.descripcion;

            document.getElementById('modalAerolineaLabel').textContent = nombre;
            document.getElementById('modalAerolineaBody').innerHTML = `
                <p><strong>País:</strong> ${pais}</p>
                <p><strong>IATA:</strong> ${iata}</p>
                <p><strong>ICAO:</strong> ${icao}</p>
                <p><strong>Descripción:</strong> ${descripcion ? descripcion : 'Sin información adicional.'}</p>
                ${web ? `<p><a href="${web}" target="_blank">Sitio web oficial</a></p>` : ''}
            `;
            var modal = new bootstrap.Modal(document.getElementById('modalAerolinea'));
            modal.show();
        });
    });
    </script>
</body>
</html>