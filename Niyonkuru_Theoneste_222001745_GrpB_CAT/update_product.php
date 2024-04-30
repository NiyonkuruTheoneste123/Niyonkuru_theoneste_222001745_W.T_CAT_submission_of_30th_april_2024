<?php
include 'database_connection.php';

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['ProID'])) {
    $ProID = $_GET['ProID'];
    
    $stmt = $connection->prepare("SELECT * FROM product WHERE ProID=?");
    $stmt->bind_param("i", $ProID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ProID = $row['ProID'];
        $Pname = $row['Pname'];
        $Amount = $row['Amount'];
        $Price = $row['Price'];
        $Mnfdate = $row['Mnfdate'];
        $Expdate = $row['Expdate'];
        $RmID = $row['RmID'];
    } else {
        echo "<script>alert('Product not found.'); window.location.href = 'product.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Update</title>
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
        <h2>Are you sure you want to update this product record?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="product.php" class="button">Back to Product</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Product</h2></u>
        <label for="ProID">Product ID:</label>
        <input type="number" name="ProID" value="<?php echo isset($ProID) ? $ProID : ''; ?>" readonly>
        <br><br>

        <label for="Pname">Product Name:</label>
        <input type="text" name="Pname" value="<?php echo isset($Pname) ? $Pname : ''; ?>" required>
        <br><br>

        <label for="Amount">Amount:</label>
        <input type="number" name="Amount" value="<?php echo isset($Amount) ? $Amount : ''; ?>" required>
        <br><br>

        <label for="Price">Price:</label>
        <input type="number" name="Price" value="<?php echo isset($Price) ? $Price : ''; ?>" required>
        <br><br>

        <label for="Mnfdate">Manufacture Date:</label>
        <input type="date" name="Mnfdate" value="<?php echo isset($Mnfdate) ? $Mnfdate : ''; ?>" required>
        <br><br>

        <label for="Expdate">Expiration Date:</label>
        <input type="date" name="Expdate" value="<?php echo isset($Expdate) ? $Expdate : ''; ?>" required>
        <br><br>

        <label for="RmID">Raw Material ID:</label>
        <input type="number" name="RmID" value="<?php echo isset($RmID) ? $RmID : ''; ?>" required>
        <br><br>

        <input class="button" type="submit" name="up" value="Update">
        <a class="button" href="./home.html">Go Back to Home</a>
        
    </form>
    <?php
    if(isset($_POST['up'])) {
        $ProID = $_POST['ProID'];
        $Pname = $_POST['Pname'];
        $Amount = $_POST['Amount'];
        $Price = $_POST['Price'];
        $Mnfdate = $_POST['Mnfdate'];
        $Expdate = $_POST['Expdate'];
        $RmID = $_POST['RmID'];
        
        $stmt = $connection->prepare("UPDATE product SET Pname=?, Amount=?, Price=?, Mnfdate=?, Expdate=?, RmID=? WHERE ProID=?");
        $stmt->bind_param("sddssii", $Pname, $Amount, $Price, $Mnfdate, $Expdate, $RmID, $ProID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update product.'); window.location.href = 'product.php?ProID=$ProID';</script>";
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
