<?php
include 'database_connection.php';

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['FinID'])) {
    $FinID = $_GET['FinID'];
    
    $stmt = $connection->prepare("SELECT * FROM finance WHERE FinID=?");
    $stmt->bind_param("i", $FinID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['FinID'];
        $b = $row['Fin_names'];
        $c = $row['asset_value'];
        $d = $row['salary_amount'];
        $e = $row['amount_per_year'];
    } else {
        echo "<script>alert('Finance record not found.'); window.location.href = 'update_finance.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Update</title>
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .popup {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: none;
        }
    </style>
</head>
<body>
    <div class="popup" id="confirmationPopup">
        <h2>Are you sure you want to update this finance record?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="finance.php" class="button">Back to Finance</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Finance Record</h2></u>
        <label for="FinID">Finance ID:</label>
        <input type="number" name="FinID" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>

        <label for="Fin_names">Finance source:</label>
        <input type="text" name="Fin_names" value="<?php echo isset($b) ? $b : ''; ?>" required>
        <br><br>

        <label for="asset_value">Asset Value:</label>
        <input type="number" name="asset_value" value="<?php echo isset($c) ? $c : ''; ?>" required>
        <br><br>

        <label for="salary_amount">Salary Amount:</label>
        <input type="number" name="salary_amount" value="<?php echo isset($d) ? $d : ''; ?>" required>
        <br><br>

        <label for="amount_per_year">Amount per Year:</label>
        <input type="number" name="amount_per_year" value="<?php echo isset($e) ? $e : ''; ?>" required>
        <br><br>

        <input class="button" type="submit" name="up" value="Update">
        <a class="button" href="./home.html">Go Back to Home</a>
    </form>
    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $FinID = $_POST['FinID'];
        $Fin_names = $_POST['Fin_names'];
        $asset_value = $_POST['asset_value'];
        $salary_amount = $_POST['salary_amount'];
        $amount_per_year = $_POST['amount_per_year'];
        
        // Update the finance record in the database
        $stmt = $connection->prepare("UPDATE finance SET Fin_names=?, asset_value=?, salary_amount=?, amount_per_year=? WHERE FinID=?");
        $stmt->bind_param("sddii", $Fin_names, $asset_value, $salary_amount, $amount_per_year, $FinID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update finance record.'); window.location.href = 'finance.php?FinID=$FinID';</script>";
        }
    }
    ?>

    <script>
        function confirmUpdate() {
            document.getElementById('confirmationPopup').style.display = 'none';
            document.getElementById('updateSuccessPopup').style.display = 'block';
        }

        function cancelUpdate() {
            document.getElementById('confirmationPopup').style.display = 'none';
        }

        function closePopup() {
            document.getElementById('updateSuccessPopup').style.display = 'none';
        }
    </script>
</body>
</html>
