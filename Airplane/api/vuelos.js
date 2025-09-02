document.addEventListener('DOMContentLoaded', () => {
    const loadFlightsBtn = document.getElementById('loadFlightsBtn');
    const flightsContainer = document.getElementById('flightsContainer');
    const access_key = '03d43ae61d8e4757f5b3b9d4ba286b94'; // Tu API key

    loadFlightsBtn.addEventListener('click', async () => {
        const api_url = `https://api.aviationstack.com/v1/flights?access_key=${access_key}&limit=40`;

        flightsContainer.innerHTML = '<p>Cargando vuelos...</p>';

        try {
            const response = await fetch(api_url);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            const data = await response.json();

            if (data && data.data && Array.isArray(data.data) && data.data.length > 0) {
                flightsContainer.innerHTML = '';

                data.data.forEach(flight => {
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
            } else {
                flightsContainer.innerHTML = '<p>No se encontraron vuelos o hay un problema con los datos.</p>';
            }
        } catch (error) {
            console.error("Error al cargar los datos de vuelos:", error);
            flightsContainer.innerHTML = '<p>Error al cargar la información de vuelos. Inténtalo de nuevo más tarde.</p>';
        }
    });
});