
// Preguntas del simulador (puedes conectar a una base de datos aquí)
const preguntas = [
    {
        texto: "¿Cuál es la función principal del altímetro en una cabina de avión?",
        opciones: [
            "Medir la velocidad del avión",
            "Indicar la altitud sobre el nivel del mar",
            "Mostrar la dirección del viento",
            "Controlar la temperatura de la cabina"
        ],
        correcta: 1,
        imagen: "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
        alt: "Altímetro"
    },
    {
        texto: "¿Qué significa la sigla ATC en aviación?",
        opciones: [
            "Air Traffic Control",
            "Automatic Thrust Control",
            "Aircraft Technical Certificate"
        ],
        correcta: 0,
        imagen: "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
        alt: "Torre de control"
    },
    {
        texto: "¿Cuál es la velocidad máxima aproximada de crucero de un Airbus A320?",
        opciones: [
            "560 km/h",
            "840 km/h",
            "1.200 km/h"
        ],
        correcta: 1,
        imagen: "https://cdn-icons-png.flaticon.com/512/616/616494.png",
        alt: "Avión Airbus"
    },
    {
        texto: "¿Qué instrumento se utiliza para indicar el rumbo de la aeronave?",
        opciones: [
            "Horizonte artificial",
            "Brújula o indicador de rumbo",
            "Altímetro"
        ],
        correcta: 1,
        imagen: "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
        alt: "Brújula de avión"
    },
    {
        texto: "¿Qué fenómeno meteorológico puede causar turbulencia severa?",
        opciones: [
            "Niebla densa",
            "Tormentas y cumulonimbos",
            "Viento suave"
        ],
        correcta: 1,
        imagen: "https://cdn-icons-png.flaticon.com/512/414/414974.png",
        alt: "Nube tormenta"
    }
];

// Estado del simulador
let estado = {
    actual: 0,
    respuestas: [],
    terminado: false
};

// Render principal
function renderSimulador() {
    const app = document.getElementById('simulador-app');
    app.innerHTML = "";

    if (estado.terminado) {
        let correctas = estado.respuestas.filter(r => r.correcta).length;
        app.innerHTML = `
            <div class="sim-card sim-result animate__animated animate__fadeIn">
                <h2>¡Examen finalizado!</h2>
                <p>Respuestas correctas: <strong>${correctas}</strong> de <strong>${preguntas.length}</strong></p>
                <button class="btn btn-primary sim-btn" onclick="reiniciarSimulador()">Reiniciar examen</button>
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
            <div class="${clase}" onclick="seleccionarOpcion(${idx})">${op}</div>
        `;
    });

    let feedback = "";
    if (respuestaUsuario) {
        if (respuestaUsuario.seleccionada === pregunta.correcta) {
            feedback = `<div class="text-success mt-2"><strong>¡Correcto!</strong></div>`;
        } else {
            feedback = `<div class="text-danger mt-2"><strong>Incorrecto.</strong> La respuesta correcta es: <span class="fw-bold">${pregunta.opciones[pregunta.correcta]}</span></div>`;
        }
    }

    let btnSiguiente = "";
    if (respuestaUsuario) {
        if (estado.actual < preguntas.length - 1) {
            btnSiguiente = `<button class="btn btn-success sim-btn" onclick="siguientePregunta()">Siguiente pregunta</button>
                            <button class="btn btn-outline-secondary sim-btn" onclick="intentarOtraVez()">Intentar otra vez</button>`;
        } else {
            btnSiguiente = `<button class="btn btn-primary sim-btn" onclick="finalizarExamen()">Ver resultados</button>
                            <button class="btn btn-outline-secondary sim-btn" onclick="intentarOtraVez()">Intentar otra vez</button>`;
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
}

function seleccionarOpcion(idx) {
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

function intentarOtraVez() {
    estado.respuestas[estado.actual] = undefined;
    renderSimulador();
}

function finalizarExamen() {
    estado.terminado = true;
    renderSimulador();
}

function reiniciarSimulador() {
    estado = { actual: 0, respuestas: [], terminado: false };
    renderSimulador();
}

// Inicializar
document.addEventListener("DOMContentLoaded", renderSimulador);
