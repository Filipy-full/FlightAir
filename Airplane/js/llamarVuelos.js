
const access_key = '03d43ae61d8e4757f5b3b9d4ba286b94';
let allFlights = [];
let filteredFlights = [];
let currentIndex = 0;
const pageSize = 4;

const loadFlightsBtn = document.getElementById('loadFlightsBtn');
const loadMoreBtn = document.getElementById('loadMoreBtn');
const flightsContainer = document.getElementById('flightsContainer');
const searchInput = document.getElementById('searchInput');
const autocompleteList = document.getElementById('autocompleteList');

async function fetchFlights() {
    flightsContainer.innerHTML = '<p>Cargando vuelos...</p>';
    loadMoreBtn.style.display = 'none';
    currentIndex = 0;
    allFlights = [];
    filteredFlights = [];
    autocompleteList.style.display = 'none';

    const api_url = `https://api.aviationstack.com/v1/flights?access_key=${access_key}&limit=40`;
    try {
        const response = await fetch(api_url);
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
        const data = await response.json();
        if (data && data.data && Array.isArray(data.data) && data.data.length > 0) {
            allFlights = data.data;
            filteredFlights = allFlights;
            renderFlights();
            updateAutocompleteOptions();
        } else {
            flightsContainer.innerHTML = '<p>No se encontraron vuelos o hay un problema con los datos.</p>';
        }
    } catch (error) {
        console.error("Error al cargar los datos de vuelos:", error);
        flightsContainer.innerHTML = '<p>Error al cargar la información de vuelos. Inténtalo de nuevo más tarde.</p>';
    }
}

function renderFlights(reset = true) {
    if (reset) {
        flightsContainer.innerHTML = '';
        currentIndex = 0;
    }
    const toShow = filteredFlights.slice(currentIndex, currentIndex + pageSize);
    toShow.forEach(flight => {
        const flightDiv = document.createElement('div');
        flightDiv.classList.add('flight-card');
        const flightNumber = flight.flight?.iata || 'N/A';
        const airlineName = flight.airline?.name || 'N/A';
        const departureAirport = flight.departure?.airport || 'N/A';
        const arrivalAirport = flight.arrival?.airport || 'N/A';
        const status = flight.flight_status || 'N/A';
        const scheduledTime = flight.departure?.scheduled;
        flightDiv.innerHTML = `
            <h2>${airlineName} - Vuelo ${flightNumber}</h2>
            <p><strong>De:</strong> ${departureAirport}</p>
            <p><strong>A:</strong> ${arrivalAirport}</p>
            <p><strong>Salida programada:</strong> ${
                scheduledTime ? new Date(scheduledTime).toLocaleString('es-ES') : 'N/A'
            }</p>
            <p><strong>Estado:</strong> <span class="status-${status.toLowerCase().replace(/ /g, '-')}">${status}</span></p>
        `;
        flightsContainer.appendChild(flightDiv);
    });
    currentIndex += toShow.length;
    loadMoreBtn.style.display = (currentIndex < filteredFlights.length) ? 'block' : 'none';
    if (filteredFlights.length === 0) {
        flightsContainer.innerHTML = '<p>No hay vuelos que coincidan con la búsqueda.</p>';
        loadMoreBtn.style.display = 'none';
    }
}

function filterFlights(query) {
    query = query.trim().toLowerCase();
    if (!query) {
        filteredFlights = allFlights;
    } else {
        filteredFlights = allFlights.filter(flight => {
            // Busca en todos los campos relevantes
            const airline = flight.airline?.name?.toLowerCase() || '';
            const dep = flight.departure?.airport?.toLowerCase() || '';
            const arr = flight.arrival?.airport?.toLowerCase() || '';
            const status = flight.flight_status?.toLowerCase() || '';
            const flightNumber = flight.flight?.iata?.toLowerCase() || '';
            return (
                airline.includes(query) ||
                dep.includes(query) ||
                arr.includes(query) ||
                status.includes(query) ||
                flightNumber.includes(query)
            );
        });
    }
    renderFlights(true);
}

function updateAutocompleteOptions() {
    // Junta todas las opciones posibles de todos los vuelos y elimina duplicados
    const optionsSet = new Set();
    allFlights.forEach(flight => {
        if (flight.airline?.name) optionsSet.add(flight.airline.name);
        if (flight.departure?.airport) optionsSet.add(flight.departure.airport);
        if (flight.arrival?.airport) optionsSet.add(flight.arrival.airport);
        if (flight.flight_status) optionsSet.add(flight.flight_status);
        if (flight.flight?.iata) optionsSet.add(flight.flight.iata);
    });
    autocompleteList.innerHTML = '';
    optionsSet.forEach(option => {
        const item = document.createElement('div');
        item.className = 'autocomplete-item';
        item.textContent = option;
        item.addEventListener('mousedown', function(e) {
            e.preventDefault();
            searchInput.value = option;
            autocompleteList.style.display = 'none';
            filterFlights(option);
        });
        autocompleteList.appendChild(item);
    });
}

searchInput.addEventListener('input', function() {
    const value = this.value.trim().toLowerCase();
    if (!allFlights.length) {
        autocompleteList.style.display = 'none';
        return;
    }
    // Mostrar solo opciones que coincidan
    const optionsSet = new Set();
    allFlights.forEach(flight => {
        if (flight.airline?.name) optionsSet.add(flight.airline.name);
        if (flight.departure?.airport) optionsSet.add(flight.departure.airport);
        if (flight.arrival?.airport) optionsSet.add(flight.arrival.airport);
        if (flight.flight_status) optionsSet.add(flight.flight_status);
        if (flight.flight?.iata) optionsSet.add(flight.flight.iata);
    });
    autocompleteList.innerHTML = '';
    let anyVisible = false;
    optionsSet.forEach(option => {
        if (option.toLowerCase().includes(value)) {
            const item = document.createElement('div');
            item.className = 'autocomplete-item';
            item.textContent = option;
            item.addEventListener('mousedown', function(e) {
                e.preventDefault();
                searchInput.value = option;
                autocompleteList.style.display = 'none';
                filterFlights(option);
            });
            autocompleteList.appendChild(item);
            anyVisible = true;
        }
    });
    autocompleteList.style.display = anyVisible ? 'block' : 'none';
    filterFlights(value);
});

// Ocultar autocomplete si se hace click fuera
document.addEventListener('click', function(e) {
    if (!autocompleteList.contains(e.target) && e.target !== searchInput) {
        autocompleteList.style.display = 'none';
    }
});

loadFlightsBtn.addEventListener('click', () => {
    fetchFlights();
});

loadMoreBtn.addEventListener('click', () => {
    renderFlights(false);
});