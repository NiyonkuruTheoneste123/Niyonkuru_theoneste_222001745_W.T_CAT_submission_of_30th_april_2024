<?php
include 'database_connection.php';

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_GET['EmpID'])) {
    $Eid = $_GET['EmpID'];
    
    $stmt = $connection->prepare("SELECT * FROM employee WHERE EmpID=?");
    $stmt->bind_param("i", $Eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $EmpID = $row['EmpID'];
        $Fname = $row['Fname'];
        $Lname = $row['Lname'];
        $DOB = $row['DOB'];
        $Email = $row['Email'];
        $Contact = $row['Contact'];
        $Department = $row['Department'];
        $Salary = $row['Salary'];
        $Contract = $row['contract'];
    } else {
        echo "<script>alert('Employee not found.'); window.location.href = 'update_employee.php';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Update</title>
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
        <h2>Are you sure you want to update this employee?</h2>
        <button onclick="confirmUpdate()">Yes</button>
        <button onclick="cancelUpdate()">No</button>
    </div>

    <div class="popup" id="updateSuccessPopup">
        <h2>Update successful!</h2>
        <button onclick="closePopup()">Close</button>
        <a href="employee.php" class="button">Back to Employee</a>
    </div>

    <form method="POST">
        <u><h2 style="margin-left: 100px;">Update Employee</h2></u>
        <label for="EmpID">Employee ID:</label>
        <input type="number" name="EmpID" value="<?php echo isset($EmpID) ? $EmpID : ''; ?>" readonly>
        <br><br>

        <label for="Fname">First Name:</label>
        <input type="text" name="Fname" value="<?php echo isset($Fname) ? $Fname : ''; ?>" required>
        <br><br>

        <label for="Lname">Last Name:</label>
        <input type="text" name="Lname" value="<?php echo isset($Lname) ? $Lname : ''; ?>" required>
        <br><br>

        <label for="DOB">Date of Birth:</label>
        <input type="date" name="DOB" value="<?php echo isset($DOB) ? $DOB : ''; ?>" required>
        <br><br>

        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo isset($Email) ? $Email : ''; ?>" required>
        <br><br>

        <label for="Contact">Contact:</label>
        <input type="tel" name="Contact" value="<?php echo isset($Contact) ? $Contact : ''; ?>">
        <br><br>

        <label for="Department">Department:</label>
        <input type="text" name="Department" value="<?php echo isset($Department) ? $Department : ''; ?>">
        <br><br>

        <label for="Salary">Salary:</label>
        <input type="number" name="Salary" value="<?php echo isset($Salary) ? $Salary : ''; ?>" required>
        <br><br>

        <label for="Contract">Contract:</label>
        <input type="text" name="Contract" value="<?php echo isset($Contract) ? $Contract : ''; ?>">
        <br><br>

        <input class="button" type="submit" name="up" value="Update">
        <a class="button" href="./home.html">Go Back to Home</a>
    </form>
    <?php
    if(isset($_POST['up'])) {
        $EmpID = $_POST['EmpID'];
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $DOB = $_POST['DOB'];
        $Email = $_POST['Email'];
        $Contact = $_POST['Contact'];
        $Department = $_POST['Department'];
        $Salary = $_POST['Salary'];
        $Contract = $_POST['Contract'];

        $stmt = $connection->prepare("UPDATE employee SET Fname=?, Lname=?, DOB=?, Email=?, Contact=?, Department=?, Salary=?, contract=? WHERE EmpID=?");
        $stmt->bind_param("ssssisiii", $Fname, $Lname, $DOB, $Email, $Contact, $Department, $Salary, $Contract, $EmpID);
        if($stmt->execute()) {
            echo "<script>document.getElementById('updateSuccessPopup').style.display = 'block';</script>";
        } else {
            echo "<script>alert('Failed to update employee.'); window.location.href = 'employee.php?EmpID=$EmpID';</script>";
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
