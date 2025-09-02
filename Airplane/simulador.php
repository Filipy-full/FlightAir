<!-- filepath: /workspaces/Airplane/Airplane/simulador.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Examen Teórico de Aviación | FlightAir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Airplane/StyleAirplane/simulador.css">
</head>
<body>
    <?php include("../WebSite/Includes/header.html"); ?>
    <div class="containerpy-4">
        <div class="sim-header">
            <h1>Simulador de Examen Teórico de Aviación</h1>
         </div>
        <div id="simulador-app"></div>
    </div>

<script type="module">
        function guardarEstadistica(formulario, aciertos, errores) {
            let stats = JSON.parse(localStorage.getItem('simuladorStats') || '{}');
            stats[formulario] = { aciertos, errores, fecha: new Date().toISOString() };
            localStorage.setItem('simuladorStats', JSON.stringify(stats));
        }
        function obtenerEstadistica(formulario) {
            let stats = JSON.parse(localStorage.getItem('simuladorStats') || '{}');
            return stats[formulario] || { aciertos: 0, errores: 0 };
        }

        let bancosDePreguntas = [];
        fetch('preguntas.php')
            .then(res => res.json())
            .then(data => {
                bancosDePreguntas = data;
                renderSelector();
            });

        let estado = {
            bloque: null,
            actual: 0,
            respuestas: [],
            terminado: false
        };

        // Renderiza el selector de formulario
        function renderSelector() {
            const app = document.getElementById('simulador-app');
            let options = bancosDePreguntas.map((b, i) =>
                `<button class="form-btn" data-idx="${i}">Formulario ${i + 1}</button>`
            ).join('');
            app.innerHTML = `
                <div class="sim-selector">
                    <label>Selecciona el formulario de preguntas:</label>
                    <div class="form-btn-group">${options}</div>
                    <div style="margin-top:18px;">
                        <a href="resultados.php" class="btn btn-outline-primary sim-btn" style="min-width:200px;">
                            Ver historial de resultados
                        </a>
                    </div>
                </div>
            `;
            document.querySelectorAll('.form-btn').forEach(btn => {
                btn.onclick = function() {
                    estado.bloque = parseInt(this.dataset.idx);
                    estado.actual = 0;
                    estado.respuestas = [];
                    estado.terminado = false;
                    renderSimulador();
                };
            });
        }

        // Render principal
        function renderSimulador() {
            const app = document.getElementById('simulador-app');
            app.innerHTML = "";

            if (estado.bloque === null) {
                renderSelector();
                return;
            }

            const preguntas = bancosDePreguntas[estado.bloque];

            if (estado.terminado) {
                let correctas = estado.respuestas.filter(r => r && r.correcta).length;
                let errores = estado.respuestas.filter(r => r && !r.correcta).length;
                let stats = obtenerEstadistica(estado.bloque);
                app.innerHTML = `
                    <div class="sim-card sim-result animate__animated animate__fadeIn">
                        <h2>¡Examen finalizado!</h2>
                        <p>Respuestas correctas: <strong>${correctas}</strong> de <strong>${preguntas.length}</strong></p>
                        <p>Histórico de este formulario: <br>
                            <span style="color:#218838;">Aciertos: ${stats.aciertos}</span> /
                            <span style="color:#c82333;">Errores: ${stats.errores}</span>
                        </p>
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-4">
                            <button class="btn btn-primary sim-btn" onclick="window.location.reload()">Elegir otro formulario</button>
                            <a href="resultados.php" class="btn btn-outline-primary sim-btn">Ver historial</a>
                        </div>
                    </div>
                `;
                return;
            }

            const pregunta = preguntas[estado.actual];
            const progreso = `<div class="sim-progress">Pregunta ${estado.actual + 1} de ${preguntas.length}</div>`;
            let opcionesHtml = "";

            // Si ya respondió, mostrar feedback
            const respuestaUsuario = estado.respuestas[estado.actual];

            pregunta.opciones.forEach((op, idx) => {
                let clase = "sim-option";
                if (respuestaUsuario) {
                    if (idx === pregunta.correcta) clase += " correct";
                    else if (idx === respuestaUsuario.seleccionada) clase += " incorrect";
                    clase += " disabled";
                }
                opcionesHtml += `
                    <div class="${clase}" data-idx="${idx}">${op}</div>
                `;
            });

            let feedback = "";
            let btnSiguiente = "";

            if (respuestaUsuario) {
                if (respuestaUsuario.seleccionada === pregunta.correcta) {
                    feedback = `<div class="text-success mt-2"><strong>¡Correcto!</strong></div>`;
                } else {
                    feedback = `<div class="text-danger mt-2"><strong>Incorrecto.</strong> La respuesta correcta es: <span class="fw-bold">${pregunta.opciones[pregunta.correcta]}</span></div>`;
                }
                if (estado.actual < preguntas.length - 1) {
                    btnSiguiente = `<button class="btn btn-success sim-btn" id="btn-siguiente">Siguiente pregunta</button>`;
                  } else {
                    btnSiguiente = `<button class="btn btn-primary sim-btn" id="btn-finalizar">Ver resultados</button>`;
                }
            }

            app.innerHTML = `
                <div class="sim-card animate__animated animate__fadeIn">
                    ${progreso}
                    <img src="${pregunta.imagen}" alt="${pregunta.alt}">
                    <h4 class="mb-3">${pregunta.texto}</h4>
                    ${opcionesHtml}
                    ${feedback}
                    ${btnSiguiente}
                </div>
            `;

            // Solo permite seleccionar una opción y muestra feedback, luego permite avanzar
            if (!respuestaUsuario) {
                document.querySelectorAll('.sim-option').forEach(opt => {
                    opt.onclick = function() {
                        seleccionarOpcion(parseInt(this.dataset.idx));
                    };
                });
            } else {
                if (estado.actual < preguntas.length - 1) {
                    document.getElementById('btn-siguiente').onclick = siguientePregunta;
                } else {
                    document.getElementById('btn-finalizar').onclick = finalizarExamen;
                }
            }
        }

        function seleccionarOpcion(idx) {
            const preguntas = bancosDePreguntas[estado.bloque];
            const pregunta = preguntas[estado.actual];
            estado.respuestas[estado.actual] = {
                seleccionada: idx,
                correcta: idx === pregunta.correcta
            };
            renderSimulador();
        }

        function siguientePregunta() {
            estado.actual++;
            renderSimulador();
        }

        function finalizarExamen() {
            estado.terminado = true;
            let correctas = estado.respuestas.filter(r => r && r.correcta).length;
            let errores = estado.respuestas.filter(r => r && !r.correcta).length;
            guardarEstadistica(estado.bloque, correctas, errores);
            renderSimulador();
        }

        // Inicializar
        document.addEventListener("DOMContentLoaded", renderSelector);
    </script>
</body>
</html>