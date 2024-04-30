<?php
include 'database_connection.php';
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['SupID'])) {
    $Sid = $_GET['SupID'];
    
    $stmt = $connection->prepare("SELECT * FROM supplier WHERE SupID=?");
    $stmt->bind_param("i", $Sid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['SupID'];
        $b = $row['fname'];
        $c = $row['Lname'];
        $d = $row['Province'];
        $e = $row['District'];
        $f = $row['sector'];
        $g = $row['phone'];
        $h = $row['email'];
        $i = $row['amount_paid'];
    } else {
        echo "<script>alert('Supplier not found.'); window.location.href = 'update_supplier.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier Update</title>
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
        <h2>Are you sure you want to update this supplier?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="supplier.php" class="button">Back to Supplier</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Supplier</h2></u>
        <label for="SupID">Supplier ID:</label>
        <input type="number" name="SupID" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>

        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo isset($b) ? $b : ''; ?>" required>
        <br><br>

        <label for="Lname">Last Name:</label>
        <input type="text" name="Lname" value="<?php echo isset($c) ? $c : ''; ?>" required>
        <br><br>

        <label for="Province">Province:</label>
        <input type="text" name="Province" value="<?php echo isset($d) ? $d : ''; ?>" required>
        <br><br>

        <label for="District">District:</label>
        <input type="text" name="District" value="<?php echo isset($e) ? $e : ''; ?>" required>
        <br><br>

        <label for="sector">Sector:</label>
        <input type="text" name="sector" value="<?php echo isset($f) ? $f : ''; ?>" required>
        <br><br>

        <label for="phone">Phone:</label>
        <input type="tel" name="phone" value="<?php echo isset($g) ? $g : ''; ?>" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($h) ? $h : ''; ?>" required>
        <br><br>

        <label for="amount_paid">Amount Paid:</label>
        <input type="number" name="amount_paid" value="<?php echo isset($i) ? $i : ''; ?>" required>
        <br><br>

        <input class="button" type="submit" name="up" value="Update">
        <a class="button" href="./home.html">Go Back to Home</a>
    </form>
    <?php
    if(isset($_POST['up'])) {
        $SupID = $_POST['SupID'];
        $fname = $_POST['fname'];
        $Lname = $_POST['Lname'];
        $Province = $_POST['Province'];
        $District = $_POST['District'];
        $sector = $_POST['sector'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $amount_paid = $_POST['amount_paid'];
        
        $stmt = $connection->prepare("UPDATE supplier SET fname=?, Lname=?, Province=?, District=?, sector=?, phone=?, email=?, amount_paid=? WHERE SupID=?");
        $stmt->bind_param("sssssssii", $fname, $Lname, $Province, $District, $sector, $phone, $email, $amount_paid, $SupID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update supplier.'); window.location.href = 'supplier.php?SupID=$SupID';</script>";
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
