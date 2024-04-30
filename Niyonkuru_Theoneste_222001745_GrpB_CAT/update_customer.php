<?php
include 'database_connection.php';
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['CustID'])) {
    $Cid = $_GET['CustID'];
    
    $stmt = $connection->prepare("SELECT * FROM customer WHERE CustID=?");
    $stmt->bind_param("i", $Cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['CustID'];
        $b = $row['CFname'];
        $c = $row['CLname'];
        $d = $row['CEmail'];
        $e = $row['Cphone'];
        $f = $row['Amountpaid'];
        $h = $row['ProID']; 
    } else {
        echo "<script>alert('Customer not found.'); window.location.href = 'update_customer.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Update</title>
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
    <div class="popup" id="confirmationPopup">
        <h2>Are you sure you want to update this customer?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="customer.php" class="button">Back to Customer</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Customer</h2></u>
        <label for="CustID">Customer ID:</label>
        <input type="number" name="CustID" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>

        <label for="CFname">First Name:</label>
        <input type="text" name="CFname" value="<?php echo isset($b) ? $b : ''; ?>" required>
        <br><br>

        <label for="CLname">Last Name:</label>
        <input type="text" name="CLname" value="<?php echo isset($c) ? $c : ''; ?>" required>
        <br><br>

        <label for="CEmail">Email:</label>
        <input type="email" name="CEmail" value="<?php echo isset($d) ? $d : ''; ?>" required>
        <br><br>

        <label for="CPhone">Phone Number:</label>
        <input type="tel" name="CPhone" value="<?php echo isset($e) ? $e : ''; ?>" required>
        <br><br>

        <label for="Amountpaid">Amount Paid:</label>
        <input type="number" name="Amountpaid" value="<?php echo isset($f) ? $f : ''; ?>" required>
        <br><br>

        <label for="ProID">Product ID:</label>
        <input type="number" name="ProID" value="<?php echo isset($h) ? $h : ''; ?>" required>
        <br><br>
        <input class="button" type="submit" name="up" value="Update">
        <a style="border-style: solid;" class="button" href="./home.html">Go Back to Home</a>

    </form>
    <?php
    if(isset($_POST['up'])) {
        $CustID = $_POST['CustID'];
        $CFname = $_POST['CFname'];
        $CLname = $_POST['CLname'];
        $CEmail = $_POST['CEmail'];
        $CPhone = $_POST['CPhone'];
        $Amountpaid = $_POST['Amountpaid'];
        $ProID = $_POST['ProID'];

        $stmt = $connection->prepare("UPDATE customer SET CFname=?, CLname=?, CEmail=?, CPhone=?, Amountpaid=?, ProID=? WHERE CustID=?");
        $stmt->bind_param("ssssdii", $CFname, $CLname, $CEmail, $CPhone, $Amountpaid, $ProID, $CustID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update customer.'); window.location.href = 'customer.php?CustID=$CustID';</script>";
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
