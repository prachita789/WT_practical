<!-- Write a program to calculate Electricity bill using functions in PHP 
Conditions: 
 For first 50 units – Rs. 3.50/unit 
 For next 100 units – Rs. 4.00/unit 
 For next 100 units – Rs. 5.20/unit 
 For units above 250 – Rs. 6.50/unit  -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f3efff;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .calculator {
        background: #f5f8fa;
        border-radius: 18px;
        box-shadow: 10px 10px 25px #d1d9e6, -10px -10px 25px #ffffff;
        padding: 35px;
        max-width: 420px;
        width: 90%;
        text-align: center;
    }

    h2 {
        color: #3a3d46;
        margin-bottom: 25px;
        font-size: 24px;
        letter-spacing: 0.5px;
    }

    label {
        font-size: 15px;
        color: #5e6771;
        margin-bottom: 10px;
        display: block;
        text-align: left;
    }

    input[type="number"] {
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        border: none;
        background: #e6ecf1;
        box-shadow: inset 3px 3px 8px #d1d9e6, inset -3px -3px 8px #ffffff;
        margin-bottom: 20px;
        font-size: 15px;
        color: #333;
        outline: none;
    }

    input[type="submit"] {
        width: 100%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-size: 16px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    input[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(102, 126, 234, 0.3);
    }

    .result {
        margin-top: 25px;
        background-color: #ffffff;
        border-left: 6px solid #764ba2;
        padding: 16px;
        border-radius: 10px;
        font-size: 16px;
        color: #333;
        box-shadow: 3px 3px 12px rgba(0,0,0,0.06);
    }

    .error {
        margin-top: 15px;
        color: #c0392b;
        font-weight: bold;
    }

    @media (max-width: 480px) {
        .calculator {
            padding: 25px 20px;
        }
    }
</style>

</head>
<body>
    <div class="calculator">
        <h2>🔌 Electricity Bill Calculator</h2>
        <form method="post">
            <label for="units">Enter Units Consumed</label>
            <input type="number" name="units" id="units" required>
            <input type="submit" name="submit" value="Calculate Bill">
        </form>

        <?php
        function calculateBill($units) {
            if ($units <= 50) {
                return $units * 3.50;
            } elseif ($units <= 150) {
                return (50 * 3.50) + (($units - 50) * 4.00);
            } elseif ($units <= 250) {
                return (50 * 3.50) + (100 * 4.00) + (($units - 150) * 5.20);
            } else {
                return (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
            }
        }

        if (isset($_POST['submit'])) {
            $units = $_POST['units'];
            if (is_numeric($units) && $units > 0) {
                $bill = calculateBill($units);
                echo "<div class='result'>Total bill for $units units is: <strong>₹" . number_format($bill, 2) . "</strong></div>";
            } else {
                echo "<p class='error'>Please enter a valid positive number for units.</p>";
            }
        }
        ?>
    </div>
</body>

</html>