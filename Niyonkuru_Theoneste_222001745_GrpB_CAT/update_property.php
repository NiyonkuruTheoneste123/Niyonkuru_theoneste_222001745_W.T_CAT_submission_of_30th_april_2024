<?php
include 'database_connection.php';
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['PropID'])) {
    $PropID = $_GET['PropID'];
    
    $stmt = $connection->prepare("SELECT * FROM property WHERE PropID=?");
    $stmt->bind_param("i", $PropID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['PropID'];
        $b = $row['EmpID'];
        $c = $row['Pname'];
        $d = $row['Province'];
        $e = $row['District'];
        $f = $row['Sector'];
    } else {
        echo "<script>alert('Property not found.'); window.location.href = 'update_property.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property Update</title>
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
        <h2>Are you sure you want to update this property?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="property.php" class="button">Back to Property</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Property</h2></u>
        <label for="PropID">Property ID:</label>
        <input type="number" name="PropID" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>

        <label for="EmpID">Employee ID:</label>
        <input type="number" name="EmpID" value="<?php echo isset($b) ? $b : ''; ?>" required>
        <br><br>

        <label for="Pname">Property Name:</label>
        <input type="text" name="Pname" value="<?php echo isset($c) ? $c : ''; ?>" required>
        <br><br>

        <label for="Province">Province:</label>
        <input type="text" name="Province" value="<?php echo isset($d) ? $d : ''; ?>" required>
        <br><br>

        <label for="District">District:</label>
        <input type="text" name="District" value="<?php echo isset($e) ? $e : ''; ?>" required>
        <br><br>

        <label for="Sector">Sector:</label>
        <input type="text" name="Sector" value="<?php echo isset($f) ? $f : ''; ?>" required>
        <br><br>

        <input class="button" type="submit" name="up" value="Update">
        <a style="border-style: solid;" class="button" href="./home.html">Go Back to Home</a>
    </form>
    <?php
    if(isset($_POST['up'])) {
        $PropID = $_POST['PropID'];
        $EmpID = $_POST['EmpID'];
        $Pname = $_POST['Pname'];
        $Province = $_POST['Province'];
        $District = $_POST['District'];
        $Sector = $_POST['Sector'];

        $stmt = $connection->prepare("UPDATE property SET EmpID=?, Pname=?, Province=?, District=?, Sector=? WHERE PropID=?");
        $stmt->bind_param("isssii", $EmpID, $Pname, $Province, $District, $Sector, $PropID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update property.'); window.location.href = 'property.php?PropID=$PropID';</script>";
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
