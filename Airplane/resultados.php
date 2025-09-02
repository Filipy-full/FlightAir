<?php
// filepath: /workspaces/Airplane/Airplane/resultados.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Simulador | FlightAir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Airplane/StyleAirplane/simulador.css">
    <style>
        .resultados-main {
            max-width: 700px;
            margin: 180px auto 40px auto;
            background: #fafdff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.13);
            padding: 40px 32px 32px 32px;
        }
        .resultados-main h1 {
            color: #2980b9;
            font-weight: 900;
            margin-bottom: 18px;
            text-align: center;
        }
        .resultados-table {
            width: 100%;
            margin-top: 24px;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 8px rgba(44,62,80,0.07);
        }
        .resultados-table th, .resultados-table td {
            padding: 14px 10px;
            text-align: center;
        }
        .resultados-table th {
            background: #e4ebf5;
            color: #1c5d8c;
            font-weight: 700;
        }
        .resultados-table tr:nth-child(even) {
            background: #f1f6fa;
        }
        .badge-correcto {
            background: #34c759;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            padding: 4px 12px;
        }
        .badge-error {
            background: #ff4d4f;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            padding: 4px 12px;
        }
        .badge-fecha {
            background: #bfc9d1;
            color: #2c3e50;
            font-weight: 500;
            border-radius: 8px;
            padding: 4px 10px;
        }
        @media (max-width: 700px) {
            .resultados-main {
                padding: 16px 2vw 18px 2vw;
            }
            .resultados-table th, .resultados-table td {
                padding: 8px 2px;
                font-size: 0.97em;
            }
        }
    </style>
</head>
<body>
<?php include("../WebSite/Includes/header.html"); ?>
<main>
    <div class="resultados-main">
        <h1>Resultados de tus Simuladores</h1>
        <p class="mb-3" style="text-align:center;color:#4a4647;">
            Aquí puedes consultar tu historial de aciertos y errores por cada formulario realizado en este navegador.
        </p>
        <div id="tabla-resultados"></div>
        <div style="text-align:center;margin-top:28px;">
            <button class="btn btn-outline-danger" id="btn-borrar">Borrar historial</button>
        </div>
    </div>
</main>
<?php include("../WebSite/Includes/footer.html"); ?>
<script>
function renderResultados() {
    let stats = JSON.parse(localStorage.getItem('simuladorStats') || '{}');
    let html = '';
    let hayDatos = false;
    html += `<table class="resultados-table">
        <tr>
            <th>Formulario</th>
            <th>Aciertos</th>
            <th>Errores</th>
            <th>Fecha</th>
        </tr>`;
    for (let key in stats) {
        hayDatos = true;
        html += `<tr>
            <td>Formulario ${parseInt(key) + 1}</td>
            <td><span class="badge-correcto">${stats[key].aciertos}</span></td>
            <td><span class="badge-error">${stats[key].errores}</span></td>
            <td><span class="badge-fecha">${new Date(stats[key].fecha).toLocaleString()}</span></td>
        </tr>`;
    }
    html += `</table>`;
    if (!hayDatos) {
        html = `<div style="text-align:center;color:#c82333;font-weight:600;margin:32px 0;">No hay resultados guardados aún.</div>`;
    }
    document.getElementById('tabla-resultados').innerHTML = html;
}

document.addEventListener("DOMContentLoaded", renderResultados);

document.getElementById('btn-borrar').onclick = function() {
    if (confirm("¿Seguro que deseas borrar todo el historial de resultados?")) {
        localStorage.removeItem('simuladorStats');
        renderResultados();
    }
};
</script>
</body>
</html>