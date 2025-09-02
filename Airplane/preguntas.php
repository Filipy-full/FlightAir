<?php
// filepath: /workspaces/Airplane/Airplane/preguntas.php
header('Content-Type: application/json');
echo json_encode([
    // Formulario 1
    [
        [
            "texto" => "¿Cuál es el principio físico que permite el vuelo de un avión?",
            "opciones" => [
                "Principio de Pascal",
                "Principio de Bernoulli",
                "Ley de Ohm",
                "Ley de Newton"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Principio de Bernoulli"
        ],
        [
            "texto" => "¿Qué instrumento indica la velocidad relativa del avión respecto al aire?",
            "opciones" => [
                "Altímetro",
                "Anemómetro",
                "Velocímetro",
                "Indicador de velocidad aérea (ASI)"
            ],
            "correcta" => 3,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "Indicador de velocidad aérea"
        ],
        [
            "texto" => "¿Cuál es la función del estabilizador horizontal?",
            "opciones" => [
                "Controlar el guiñada",
                "Controlar el cabeceo",
                "Controlar el alabeo",
                "Reducir la resistencia"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Estabilizador horizontal"
        ],
        [
            "texto" => "¿Qué sucede si el centro de gravedad está demasiado atrás?",
            "opciones" => [
                "El avión será más estable",
                "El avión será menos estable y difícil de recuperar de una pérdida",
                "El avión consumirá menos combustible",
                "El avión no podrá despegar"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Centro de gravedad"
        ],
        [
            "texto" => "¿Qué significa la sigla VNE en aviación?",
            "opciones" => [
                "Velocidad de no entrada",
                "Velocidad nunca excedida",
                "Velocidad de navegación estándar",
                "Velocidad de emergencia"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "VNE"
        ],
        [
            "texto" => "¿Cuál es el propósito del transpondedor en una aeronave?",
            "opciones" => [
                "Medir la altitud",
                "Transmitir la posición y altitud a los radares de control",
                "Controlar el piloto automático",
                "Regular la presión de cabina"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Transpondedor"
        ],
        [
            "texto" => "¿Qué es un NOTAM?",
            "opciones" => [
                "Un tipo de motor",
                "Un aviso a navegantes aéreos sobre condiciones temporales",
                "Un sistema de navegación",
                "Un tipo de combustible"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "NOTAM"
        ],
        [
            "texto" => "¿Qué significa el código meteorológico METAR?",
            "opciones" => [
                "Meteorological Aerodrome Report",
                "Meteorología de Área de Ruta",
                "Medición de Altitud Real",
                "Manual de Emergencias Técnicas"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "METAR"
        ],
        [
            "texto" => "¿Cuál es la función de los slats en el ala?",
            "opciones" => [
                "Reducir la resistencia",
                "Aumentar la sustentación a bajas velocidades",
                "Aumentar la velocidad máxima",
                "Reducir el peso del ala"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Slats"
        ],
        [
            "texto" => "¿Qué es la hipoxia en aviación?",
            "opciones" => [
                "Falta de combustible",
                "Falta de oxígeno en sangre",
                "Fallo del sistema hidráulico",
                "Pérdida de presión en neumáticos"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Hipoxia"
        ]
    ],
    // Formulario 2
    [
        [
            "texto" => "¿Qué significa la sigla TCAS?",
            "opciones" => [
                "Traffic Collision Avoidance System",
                "Total Control Aircraft System",
                "Technical Cabin Alert System",
                "Tactical Communication and Alert System"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "TCAS"
        ],
        [
            "texto" => "¿Qué es el Mach crítico?",
            "opciones" => [
                "La velocidad máxima de aterrizaje",
                "La velocidad a la que el flujo de aire sobre el ala alcanza la velocidad del sonido",
                "La velocidad mínima de despegue",
                "La velocidad de crucero óptima"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "Mach crítico"
        ],
        [
            "texto" => "¿Qué instrumento indica la inclinación lateral del avión?",
            "opciones" => [
                "Altímetro",
                "Indicador de viraje y deslizamiento",
                "Brújula",
                "Transpondedor"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Indicador de viraje"
        ],
        [
            "texto" => "¿Qué es el efecto suelo?",
            "opciones" => [
                "Aumento de sustentación y reducción de resistencia cerca del suelo",
                "Pérdida de potencia del motor",
                "Aumento de la resistencia al aire",
                "Reducción de la sustentación"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Efecto suelo"
        ],
        [
            "texto" => "¿Qué significa la sigla ILS?",
            "opciones" => [
                "Instrument Landing System",
                "Integrated Landing System",
                "International Landing Service",
                "Instrument Light System"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "ILS"
        ],
        [
            "texto" => "¿Qué es la velocidad de pérdida (stall speed)?",
            "opciones" => [
                "La velocidad máxima de crucero",
                "La velocidad mínima a la que el avión puede volar sin perder sustentación",
                "La velocidad de aterrizaje",
                "La velocidad de ascenso óptima"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Stall speed"
        ],
        [
            "texto" => "¿Qué es el QNH?",
            "opciones" => [
                "Presión atmosférica ajustada al nivel del mar",
                "Temperatura exterior",
                "Altitud verdadera",
                "Velocidad del viento"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "QNH"
        ],
        [
            "texto" => "¿Qué es el viraje coordinado?",
            "opciones" => [
                "Viraje con inclinación excesiva",
                "Viraje en el que la fuerza centrífuga y la gravedad están equilibradas",
                "Viraje con pérdida de sustentación",
                "Viraje con motor apagado"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Viraje coordinado"
        ],
        [
            "texto" => "¿Qué es el punto de no retorno?",
            "opciones" => [
                "El punto donde el avión no puede regresar al aeropuerto de salida con el combustible restante",
                "El punto de máxima altitud",
                "El punto de máxima velocidad",
                "El punto de máxima sustentación"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Punto de no retorno"
        ],
        [
            "texto" => "¿Qué es el VOR?",
            "opciones" => [
                "Un sistema de navegación por radio",
                "Un tipo de motor",
                "Un sistema de control de vuelo",
                "Un sistema de iluminación de pista"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "VOR"
        ]
    ],
    // Formulario 3
    [
        [
            "texto" => "¿Qué es el ángulo de ataque en un ala?",
            "opciones" => [
                "El ángulo entre el borde de salida y el viento relativo",
                "El ángulo entre la cuerda del ala y el viento relativo",
                "El ángulo entre el fuselaje y el suelo",
                "El ángulo entre el estabilizador y el ala"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Ángulo de ataque"
        ],
        [
            "texto" => "¿Qué es la deriva en navegación aérea?",
            "opciones" => [
                "El desplazamiento lateral causado por el viento",
                "El movimiento vertical del avión",
                "El cambio de altitud",
                "El giro del avión sobre su eje longitudinal"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Deriva"
        ],
        [
            "texto" => "¿Cuál es la función del flap en el ala?",
            "opciones" => [
                "Aumentar la velocidad de crucero",
                "Aumentar la sustentación y la resistencia para el despegue y aterrizaje",
                "Reducir el consumo de combustible",
                "Controlar el alabeo"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Flap"
        ],
        [
            "texto" => "¿Qué es el peso máximo al despegue (MTOW)?",
            "opciones" => [
                "El peso máximo permitido para aterrizar",
                "El peso máximo permitido para despegar",
                "El peso máximo de combustible",
                "El peso máximo de carga útil"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "MTOW"
        ],
        [
            "texto" => "¿Qué es la senda de planeo (glide slope) en un ILS?",
            "opciones" => [
                "La trayectoria horizontal de aproximación",
                "La trayectoria vertical de aproximación",
                "La trayectoria lateral de aproximación",
                "La trayectoria de salida"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "Glide slope"
        ],
        [
            "texto" => "¿Qué es el factor de carga (load factor)?",
            "opciones" => [
                "La relación entre la sustentación y el peso",
                "La relación entre el peso y la resistencia",
                "La relación entre la velocidad y la altitud",
                "La relación entre el empuje y la resistencia"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Load factor"
        ],
        [
            "texto" => "¿Qué es el punto de decisión (decision point) en una aproximación?",
            "opciones" => [
                "El punto donde se decide el tipo de combustible",
                "El punto donde se decide continuar o abortar el aterrizaje",
                "El punto de máxima velocidad",
                "El punto de máxima sustentación"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Decision point"
        ],
        [
            "texto" => "¿Qué es el efecto de la altitud sobre el rendimiento del motor?",
            "opciones" => [
                "Aumenta la potencia",
                "Disminuye la potencia",
                "No afecta la potencia",
                "Aumenta el consumo de combustible"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "Altitud y motor"
        ],
        [
            "texto" => "¿Qué es el VMC en aviones multimotor?",
            "opciones" => [
                "Velocidad mínima de control con un motor inoperativo",
                "Velocidad máxima de crucero",
                "Velocidad de ascenso óptima",
                "Velocidad de pérdida"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "VMC"
        ],
        [
            "texto" => "¿Qué es el efecto P-factor en aviones de hélice?",
            "opciones" => [
                "El efecto de la presión atmosférica",
                "El efecto de la hélice que causa guiñada a la izquierda",
                "El efecto de la altitud sobre la sustentación",
                "El efecto del viento cruzado"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "P-factor"
        ]
    ],
    // Formulario 4
    [
        [
            "texto" => "¿Qué es el centrado de masas en una aeronave?",
            "opciones" => [
                "La distribución de combustible",
                "La ubicación del centro de gravedad respecto al avión",
                "La posición de los pasajeros",
                "La posición de los motores"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Centro de masas"
        ],
        [
            "texto" => "¿Qué es el viento de cara (headwind)?",
            "opciones" => [
                "Viento que sopla en la misma dirección del avión",
                "Viento que sopla en contra de la dirección de avance del avión",
                "Viento lateral",
                "Viento descendente"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Headwind"
        ],
        [
            "texto" => "¿Qué es el viento de cola (tailwind)?",
            "opciones" => [
                "Viento que sopla en contra del avión",
                "Viento que sopla a favor de la dirección de avance del avión",
                "Viento lateral",
                "Viento ascendente"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "Tailwind"
        ],
        [
            "texto" => "¿Qué es el viento cruzado (crosswind)?",
            "opciones" => [
                "Viento que sopla desde arriba",
                "Viento que sopla perpendicular a la dirección de avance del avión",
                "Viento que sopla en la misma dirección del avión",
                "Viento descendente"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Crosswind"
        ],
        [
            "texto" => "¿Qué es el efecto de la densidad del aire en el despegue?",
            "opciones" => [
                "A mayor densidad, mayor distancia de despegue",
                "A menor densidad, mayor distancia de despegue",
                "No afecta la distancia de despegue",
                "A mayor densidad, menor sustentación"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Densidad aire"
        ],
        [
            "texto" => "¿Qué es el efecto de la altitud sobre la sustentación?",
            "opciones" => [
                "A mayor altitud, mayor sustentación",
                "A mayor altitud, menor sustentación",
                "No afecta la sustentación",
                "A menor altitud, menor sustentación"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Altitud y sustentación"
        ],
        [
            "texto" => "¿Qué es el efecto de la temperatura sobre el rendimiento del motor?",
            "opciones" => [
                "A mayor temperatura, mayor potencia",
                "A mayor temperatura, menor potencia",
                "No afecta la potencia",
                "A menor temperatura, menor potencia"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "Temperatura motor"
        ],
        [
            "texto" => "¿Qué es el efecto de la humedad sobre la densidad del aire?",
            "opciones" => [
                "A mayor humedad, mayor densidad",
                "A mayor humedad, menor densidad",
                "No afecta la densidad",
                "A menor humedad, menor densidad"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "Humedad aire"
        ],
        [
            "texto" => "¿Qué es el efecto de la presión atmosférica sobre la altitud indicada?",
            "opciones" => [
                "A mayor presión, mayor altitud indicada",
                "A mayor presión, menor altitud indicada",
                "No afecta la altitud indicada",
                "A menor presión, menor altitud indicada"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Presión altitud"
        ],
        [
            "texto" => "¿Qué es el efecto de la velocidad sobre la sustentación?",
            "opciones" => [
                "A mayor velocidad, mayor sustentación",
                "A mayor velocidad, menor sustentación",
                "No afecta la sustentación",
                "A menor velocidad, mayor sustentación"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Velocidad sustentación"
        ]
    ],
    // Formulario 5
    [
        [
            "texto" => "¿Qué es el efecto de la altitud sobre la velocidad de pérdida?",
            "opciones" => [
                "A mayor altitud, mayor velocidad de pérdida",
                "A mayor altitud, menor velocidad de pérdida",
                "No afecta la velocidad de pérdida",
                "A menor altitud, menor velocidad de pérdida"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Altitud y pérdida"
        ],
        [
            "texto" => "¿Qué es el efecto de la carga alar sobre la velocidad de pérdida?",
            "opciones" => [
                "A mayor carga alar, mayor velocidad de pérdida",
                "A mayor carga alar, menor velocidad de pérdida",
                "No afecta la velocidad de pérdida",
                "A menor carga alar, mayor velocidad de pérdida"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Carga alar"
        ],
        [
            "texto" => "¿Qué es el efecto de la configuración de flaps sobre la velocidad de pérdida?",
            "opciones" => [
                "Con flaps extendidos, mayor velocidad de pérdida",
                "Con flaps extendidos, menor velocidad de pérdida",
                "No afecta la velocidad de pérdida",
                "Con flaps retraídos, menor velocidad de pérdida"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "Flaps y pérdida"
        ],
        [
            "texto" => "¿Qué es el efecto de la aceleración centrífuga en un viraje?",
            "opciones" => [
                "Aumenta la sustentación",
                "Aumenta la carga sobre el avión",
                "Disminuye la sustentación",
                "No afecta la carga"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "Centrífuga viraje"
        ],
        [
            "texto" => "¿Qué es el efecto de la altitud sobre la velocidad indicada?",
            "opciones" => [
                "A mayor altitud, mayor velocidad indicada",
                "A mayor altitud, menor velocidad indicada",
                "No afecta la velocidad indicada",
                "A menor altitud, mayor velocidad indicada"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Altitud velocidad"
        ],
        [
            "texto" => "¿Qué es el efecto de la temperatura sobre la densidad del aire?",
            "opciones" => [
                "A mayor temperatura, mayor densidad",
                "A mayor temperatura, menor densidad",
                "No afecta la densidad",
                "A menor temperatura, menor densidad"
            ],
            "correcta" => 1,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
            "alt" => "Temperatura densidad"
        ],
        [
            "texto" => "¿Qué es el efecto de la humedad sobre la velocidad de pérdida?",
            "opciones" => [
                "A mayor humedad, mayor velocidad de pérdida",
                "A mayor humedad, menor velocidad de pérdida",
                "No afecta la velocidad de pérdida",
                "A menor humedad, mayor velocidad de pérdida"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/616/616494.png",
            "alt" => "Humedad pérdida"
        ],
        [
            "texto" => "¿Qué es el efecto de la presión atmosférica sobre la velocidad de pérdida?",
            "opciones" => [
                "A mayor presión, mayor velocidad de pérdida",
                "A mayor presión, menor velocidad de pérdida",
                "No afecta la velocidad de pérdida",
                "A menor presión, mayor velocidad de pérdida"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/414/414974.png",
            "alt" => "Presión pérdida"
        ],
        [
            "texto" => "¿Qué es el efecto de la velocidad sobre la resistencia?",
            "opciones" => [
                "A mayor velocidad, mayor resistencia",
                "A mayor velocidad, menor resistencia",
                "No afecta la resistencia",
                "A menor velocidad, mayor resistencia"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933887.png",
            "alt" => "Velocidad resistencia"
        ],
        [
            "texto" => "¿Qué es el efecto de la configuración de tren de aterrizaje sobre la resistencia?",
            "opciones" => [
                "Con tren extendido, mayor resistencia",
                "Con tren extendido, menor resistencia",
                "No afecta la resistencia",
                "Con tren retraído, mayor resistencia"
            ],
            "correcta" => 0,
            "imagen" => "https://cdn-icons-png.flaticon.com/512/2933/2933886.png",
            "alt" => "Tren resistencia"
        ]
    ],
    // ...Agrega aquí los formularios 6 al 20 siguiendo el mismo formato...
]);