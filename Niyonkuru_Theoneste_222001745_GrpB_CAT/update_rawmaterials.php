<?php
include 'database_connection.php';
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['RmID'])) {
    $RmID = $_GET['RmID'];
    
    $stmt = $connection->prepare("SELECT * FROM raw_material WHERE RmID=?");
    $stmt->bind_param("i", $RmID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Rtype = $row['Rtype'];
        $Ramount = $row['Ramount'];
        $stored_date = $row['stored_date'];
        $unstore_date = $row['unstore_date'];
        $SupID = $row['SupID'];
    } else {
        echo "<script>alert('Raw Material not found.'); window.location.href = 'update_rawmaterials.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raw Material Update</title>
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
        <h2>Are you sure you want to update this raw material?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="rawmaterials.php" class="button">Back to Raw Materials</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Raw Material</h2></u>
        <label for="RmID">Raw Material ID:</label>
        <input type="number" name="RmID" value="<?php echo isset($RmID) ? $RmID : ''; ?>" readonly>
        <br><br>

        <label for="Rtype">Raw Material Type:</label>
        <input type="text" name="Rtype" value="<?php echo isset($Rtype) ? $Rtype : ''; ?>" required>
        <br><br>

        <label for="Ramount">Raw Material Amount:</label>
        <input type="number" name="Ramount" value="<?php echo isset($Ramount) ? $Ramount : ''; ?>" required>
        <br><br>

        <label for="stored_date">Stored Date:</label>
        <input type="date" name="stored_date" value="<?php echo isset($stored_date) ? $stored_date : ''; ?>" required>
        <br><br>

        <label for="unstore_date">Unstore Date:</label>
        <input type="date" name="unstore_date" value="<?php echo isset($unstore_date) ? $unstore_date : ''; ?>" required>
        <br><br>

        <label for="SupID">Supplier ID:</label>
        <input type="number" name="SupID" value="<?php echo isset($SupID) ? $SupID : ''; ?>" required>
        <br><br>

        <input class="button" type="submit" name="up" value="Update">
        <a class="button" href="./home.html">Go Back to Home</a>
    </form>
    <?php
    if(isset($_POST['up'])) {
        $RmID = $_POST['RmID'];
        $Rtype = $_POST['Rtype'];
        $Ramount = $_POST['Ramount'];
        $stored_date = $_POST['stored_date'];
        $unstore_date = $_POST['unstore_date'];
        $SupID = $_POST['SupID'];

        $stmt = $connection->prepare("UPDATE raw_material SET Rtype=?, Ramount=?, stored_date=?, unstore_date=?, SupID=? WHERE RmID=?");
        $stmt->bind_param("sdsdsi", $Rtype, $Ramount, $stored_date, $unstore_date, $SupID, $RmID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update raw material.'); window.location.href = 'rawmaterials.php?RmID=$RmID';</script>";
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
