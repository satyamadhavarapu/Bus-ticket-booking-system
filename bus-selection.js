document.getElementById('search-button').addEventListener('click', function() {
    const busType = document.querySelector('input[name="busType"]:checked').value;
    const busCategory = document.querySelector('input[name="busCategory"]:checked').value;
    
    // Example distance (this should ideally be calculated based on user input)
    const distance = 100; // Distance in km; adjust as necessary

    // Buses list with pricing
    const buses = [
        { name: 'Bus 1', type: 'ac', category: 'seater' },
        { name: 'Bus 2', type: 'ac', category: 'sleeper' },
        { name: 'Bus 3', type: 'non-ac', category: 'seater' },
        { name: 'Bus 4', type: 'non-ac', category: 'sleeper' },
        { name: 'Bus 5', type: 'ac', category: 'seater' },
        { name: 'Bus 6', type: 'non-ac', category: 'sleeper' },
        { name: 'Bus 7', type: 'ac', category: 'sleeper' },
        { name: 'Bus 8', type: 'non-ac', category: 'seater' },
        { name: 'Bus 9', type: 'ac', category: 'seater' },
        { name: 'Bus 10', type: 'non-ac', category: 'seater' }
    ];

    // Function to calculate price based on bus type and category
    const calculatePrice = (type, category) => {
        if (category === 'seater') {
            return type === 'ac' ? 10 * distance : 5 * distance; // ₹10/km for AC, ₹5/km for Non-AC
        } else if (category === 'sleeper') {
            return type === 'ac' ? 20 * distance : 10 * distance; // ₹20/km for AC, ₹10/km for Non-AC
        }
        return 0; // Default to 0 if none match
    };

    // Filter buses based on user selection
    const filteredBuses = buses.filter(bus => bus.type === busType && bus.category === busCategory);

    // Show the bus list
    const busList = document.getElementById('bus-list');
    const busesContainer = document.getElementById('buses-container');
    busesContainer.innerHTML = ''; // Clear previous results

    if (filteredBuses.length > 0) {
        busList.style.display = 'block'; // Show bus list section

        // Add each filtered bus to the bus container
        filteredBuses.forEach(bus => {
            const price = calculatePrice(bus.type, bus.category); // Calculate price for the bus
            const busElement = document.createElement('div');
            busElement.classList.add('bus-item');
            busElement.innerHTML = `
                <h3>${bus.name}</h3>
                <p>Type: ${bus.type.toUpperCase()} | Category: ${bus.category.charAt(0).toUpperCase() + bus.category.slice(1)}</p>
                <p>Price: ₹${price}</p>
                <button onclick="selectBus('${bus.name}', ₹${price})">Select</button>
            `;
            busesContainer.appendChild(busElement);
        });
    } else {
        busesContainer.innerHTML = '<p>No buses available for the selected criteria.</p>';
        busList.style.display = 'block';
    }
});

// Function to handle bus selection
function selectBus(busName, price) {
    alert(`You have selected ${busName} for ₹${price}.`);
    // Here, you can redirect to the seat selection page or handle the selection further
    window.location.href = 'seat-selection.html';
}
const timings = bus.timings.join(', '); // Join timings into a string
busDiv.innerHTML = `
    <input type="radio" name="selectedBus" value="${bus.id}" required>
    ${bus.name} - ${bus.type} - ${bus.category} - Timings: ${timings}
`;
