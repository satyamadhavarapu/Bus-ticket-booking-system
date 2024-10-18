const seatCost = 100; // Assuming each seat costs ₹100
let selectedSeats = [];
let totalCost = 0;

// Function to handle seat selection
document.querySelectorAll('.seat.available, .seat.women-only').forEach(seat => {
    seat.addEventListener('click', function () {
        const seatNumber = this.dataset.seat;

        if (this.classList.contains('women-only')) {
            const isWoman = confirm('This seat is reserved for women. Are you a woman?');
            if (!isWoman) {
                alert('You cannot select this seat.');
                return;
            }
        }

        if (selectedSeats.includes(seatNumber)) {
            // Deselect seat
            selectedSeats = selectedSeats.filter(seat => seat !== seatNumber);
            this.classList.remove('selected');
        } else {
            // Select seat
            selectedSeats.push(seatNumber);
            this.classList.add('selected');
        }

        // Update selected seats and total cost
        document.getElementById('selected-seats').textContent = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'None';
        totalCost = selectedSeats.length * seatCost;
        document.getElementById('total-cost').textContent = totalCost;
    });
});

// Proceed to the next page
document.getElementById('next-button').addEventListener('click', function () {
    if (selectedSeats.length === 0) {
        alert('Please select at least one seat.');
    } else {
        // Proceed to passenger details page
        window.location.href = `passenger-details.html?seats=${selectedSeats.join(',')}&cost=${totalCost}`;
    }
});
