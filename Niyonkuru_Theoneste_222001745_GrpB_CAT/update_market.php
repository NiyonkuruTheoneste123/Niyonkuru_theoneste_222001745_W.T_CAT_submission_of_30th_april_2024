<?php
include 'database_connection.php';

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['MarkID'])) {
    $MarkID = $_GET['MarkID'];
    
    $stmt = $connection->prepare("SELECT * FROM market WHERE MarkID=?");
    $stmt->bind_param("i", $MarkID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $MarkID = $row['MarkID'];
        $Mprovince = $row['Mprovince'];
        $Mdistrict = $row['Mdistrict'];
        $Msector = $row['Msector'];
        $supplydate = $row['supplydate'];
        $EmpID = $row['EmpID'];
        $ProID = $row['ProID'];
    } else {
        echo "Market not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Market Update</title>
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
        <h2>Are you sure you want to update this market record?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="market.php" class="button">Back to Market</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Market Info</h2></u>
        <label for="MarkID">Market ID:</label>
            <input type="number" name="MarkID" value="<?php echo isset($MarkID) ? $MarkID : ''; ?>" readonly>
            <br><br>

        <label for="Mprovince">Province:</label>
        <input type="text" name="Mprovince" value="<?php echo isset($Mprovince) ? $Mprovince : ''; ?>">
        <br><br>

        <label for="Mdistrict">District:</label>
        <input type="text" name="Mdistrict" value="<?php echo isset($Mdistrict) ? $Mdistrict : ''; ?>">
        <br><br>

        <label for="Msector">Sector:</label>
        <input type="text" name="Msector" value="<?php echo isset($Msector) ? $Msector : ''; ?>">
        <br><br>

        <label for="supplydate">Supply Date:</label>
        <input type="date" name="supplydate" value="<?php echo isset($supplydate) ? $supplydate : ''; ?>" required>
        <br><br>

        <label for="EmpID">Employee ID:</label>
        <input type="number" name="EmpID" value="<?php echo isset($EmpID) ? $EmpID : ''; ?>">
        <br><br>

        <label for="ProID">Product ID:</label>
        <input type="number" name="ProID" value="<?php echo isset($ProID) ? $ProID : ''; ?>">
        <br><br>

        <input class="button" type="submit" name="up" value="Update">

        <a class="button" href="./home.html">Go Back to Home</a>
        
    </form>
    <?php
    if(isset($_POST['up'])) {
        $MarkID = $_POST['MarkID'];
        $Mprovince = $_POST['Mprovince'];
        $Mdistrict = $_POST['Mdistrict'];
        $Msector = $_POST['Msector'];
        $supplydate = $_POST['supplydate'];
        $EmpID = $_POST['EmpID'];
        $ProID = $_POST['ProID'];
        
        $stmt = $connection->prepare("UPDATE market SET Mprovince=?, Mdistrict=?, Msector=?, supplydate=?, EmpID=?, ProID=? WHERE MarkID=?");
        $stmt->bind_param("ssssiii", $Mprovince, $Mdistrict, $Msector, $supplydate, $EmpID, $ProID, $MarkID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update market.'); window.location.href = 'market.php?MarkID=$MarkID';</script>";
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
