<?php
// Start the session to access session variables (if using sessions)
session_start();

// Retrieve journey details and selected seat info from session or POST
$journeyDetails = isset($_POST['journey_details']) ? $_POST['journey_details'] : 'Journey details not available.';
$selectedSeats = isset($_POST['selected_seats']) ? $_POST['selected_seats'] : '0';
$totalCost = isset($_POST['total_cost']) ? $_POST['total_cost'] : 0;

// Split selected seats into an array
$seatNumbers = explode(',', $selectedSeats);

// Set the price per seat (this can be dynamic)
$pricePerSeat = 100; // Example cost per seat
$totalCost = count($seatNumbers) * $pricePerSeat; // Calculate total cost

// Prepare journey details to display
$journeyDetailsText = nl2br(htmlspecialchars($journeyDetails));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url("images/payment-bg.jpg"); /* Your payment background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        .payment-container {
            background: rgba(0, 0, 0, 0.8); /* Dark overlay */
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            margin: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .payment-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.7);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #FFD700; /* Gold color for the heading */
        }

        .payment-options {
            margin: 20px 0;
        }

        .payment-options label {
            margin: 10px 0;
            display: block;
            cursor: pointer;
            font-weight: bold;
        }

        .payment-options input[type="radio"] {
            display: none; /* Hide radio buttons */
        }

        .payment-options input[type="radio"] + label::before {
            content: "";
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border: 2px solid #FFD700;
            border-radius: 50%;
            vertical-align: middle;
            transition: background-color 0.3s;
        }

        .payment-options input[type="radio"]:checked + label::before {
            background-color: #FFD700;
        }

        .payment-detail {
            display: none;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        input[type="text"], input[type="email"], input[type="number"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #FFD700;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #ccc;
        }
    </style>
</head>
<body>

<div class="payment-container">
    <h2>Payment</h2>
    
    <h3>Journey Details:</h3>
    <p><?php echo $journeyDetailsText; ?></p>
    
    <h3>Selected Seats:</h3>
    <p><?php echo implode(', ', $seatNumbers); ?></p>
    
    <h3>Total Bill:</h3>
    <p><?php echo $totalCost . ' Kes'; ?></p>

    <div class="payment-options">
        <h3>Select Payment Method:</h3>
        <label>
            <input type="radio" name="payment_method" value="credit_card" checked>
            Credit Card
        </label>
        <label>
            <input type="radio" name="payment_method" value="paypal">
            PayPal
        </label>
        <label>
            <input type="radio" name="payment_method" value="mobile_money">
            Mobile Money
        </label>
    </div>

    <div id="payment-details">
        <div id="credit-card-details" class="payment-detail">
            <h4>Credit Card Details</h4>
            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" name="card-number" required placeholder="XXXX-XXXX-XXXX-XXXX" />

            <label for="expiry-date">Expiry Date:</label>
            <input type="text" id="expiry-date" name="expiry-date" required placeholder="MM/YY" />

            <label for="cvv">CVV:</label>
            <input type="number" id="cvv" name="cvv" required placeholder="CVV" />
        </div>

        <div id="paypal-details" class="payment-detail">
            <h4>PayPal Details</h4>
            <label for="paypal-email">PayPal Email:</label>
            <input type="email" id="paypal-email" name="paypal-email" required placeholder="Enter your PayPal email" />
        </div>

        <div id="mobile-money-details" class="payment-detail">
            <h4>Mobile Money Details</h4>
            <label for="mobile-number">Mobile Number:</label>
            <input type="text" id="mobile-number" name="mobile-number" required placeholder="Enter your mobile number" />

            <label for="mobile-provider">Provider:</label>
            <select id="mobile-provider" name="mobile-provider" required>
                <option value="provider1">Provider 1</option>
                <option value="provider2">Provider 2</option>
                <option value="provider3">Provider 3</option>
            </select>
        </div>
    </div>

    <form action="process_payment.php" method="POST">
        <!-- Hidden fields to pass selected seats and total cost -->
        <input type="hidden" name="selected_seats" value="<?php echo htmlspecialchars($selectedSeats); ?>" />
        <input type="hidden" name="total_cost" value="<?php echo htmlspecialchars($totalCost); ?>" />
        <input type="hidden" name="journey_details" value="<?php echo htmlspecialchars($journeyDetails); ?>" />

        <button type="submit">Pay Now</button>
    </form>

    <div class="footer">
        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
    </div>
</div>

<script>
    // Switch payment details based on selected payment method
    document.querySelectorAll('input[name="payment_method"]').forEach(function(elem) {
        elem.addEventListener('change', function() {
            document.querySelectorAll('.payment-detail').forEach(function(detail) {
                detail.style.display = 'none';
            });
            document.getElementById(this.value + '-details').style.display = 'block';
        });
    });

    // Show credit card details by default
    document.getElementById('credit-card-details').style.display = 'block';
</script>

</body>
</html>
