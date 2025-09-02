export function guardarEstadistica(formulario, aciertos, errores) {
    let stats = JSON.parse(localStorage.getItem('simuladorStats') || '{}');
    stats[formulario] = { aciertos, errores, fecha: new Date().toISOString() };
    localStorage.setItem('simuladorStats', JSON.stringify(stats));
}

export function obtenerEstadistica(formulario) {
    let stats = JSON.parse(localStorage.getItem('simuladorStats') || '{}');
    return stats[formulario] || { aciertos: 0, errores: 0 };
}