<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Form</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tr:nth-child(even) {
        background-color: #ffffff;
    }

    tr:not(:last-child) {
        border-bottom: 1px solid black;
    }
</style>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="./Customer.php">Customer</a></li>
                <li><a href="./Employee.php">Employee</a></li>
                <li><a href="./rawmaterials.php">Raw Materials</a></li>
                <li><a href="./Market.php">Market</a></li>
                <li><a href="./Property.php">Property</a></li>
                <li><a href="./Product.php">Product</a></li>
                <li><a href="./Finance.php">Finance</a></li>
                <li><a href="./Supplier.php">Supplier</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <h2 style="margin-left: 100px;"><u>Employee Form</u></h2>
        <form method="post" action="employee.php">

            <label for="EmpID">Employee ID:</label>
            <input type="number" id="EmpID" name="EmpID" required><br><br>

            <label for="Fname">First Name:</label>
            <input type="text" id="Fname" name="Fname" required><br><br>

            <label for="Lname">Last Name:</label>
            <input type="text" id="Lname" name="Lname" required><br><br>

            <label for="DOB">Date of Birth:</label>
            <input type="date" id="DOB" name="DOB" required><br><br>

            <label for="Email">Email:</label>
            <input type="email" id="Email" name="Email" required><br><br>

            <label for="Contact">Contact:</label>
            <input type="tel" id="Contact" name="Contact" required><br><br>

            <label for="Department">Department:</label>
            <input type="text" id="Department" name="Department" required><br><br>

            <label for="Salary">Salary:</label>
            <input type="number" id="Salary" name="Salary" required><br><br>

            <label for="Contract">Contract:</label>
            <input type="text" id="Contract" name="Contract" required><br><br>

            <input class="button" type="submit" name="add" value="Insert">
            
            <a class="button" href="./home.html">Go Back to Home</a>

        </form>
        <?php
    //link for database Connection
     include 'database_connection.php';
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Insert section
        $stmt = $connection->prepare("INSERT INTO employee(EmpID, Fname, Lname, DOB, Email, Contact, Department, Salary, contract) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssss", $EmpID, $Fname, $Lname, $DOB, $Email, $Contact, $Department, $Salary, $contract);

        // Set parameters from POST and execute
        $EmpID = $_POST['EmpID'];
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $DOB = $_POST['DOB'];
        $Email = $_POST['Email'];
        $Contact = $_POST['Contact'];
        $Department = $_POST['Department'];
        $Salary = $_POST['Salary'];
        $contract = $_POST['Contract'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }

    // Close connection
    $connection->close();
    ?>

    <h2>Table of employee</h2>
    <table>
        <tr>
            <th>EmpID</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>DOB</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Contract</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
     //link for database Connection
     include 'database_connection.php';
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // SQL query to fetch data from the employees table
        $sql = "SELECT * FROM employee";
        $result = $connection->query($sql);

        if ($result === false) {
            echo "Error fetching data: " . $connection->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $EmpID = $row["EmpID"];
                echo "<tr>
                        <td>" . $row["EmpID"] . "</td>
                        <td>" . $row["Fname"] . "</td>
                        <td>" . $row["Lname"] . "</td>
                        <td>" . $row["DOB"] . "</td>
                        <td>" . $row["Email"] . "</td>
                        <td>" . $row["Contact"] . "</td>
                        <td>" . $row["Department"] . "</td>
                        <td>" . $row["Salary"] . "</td>
                        <td>" . $row["contract"] . "</td>
                        <td><a style='padding:4px' href='delete_employee.php?EmpID=$EmpID'>Delete</a></td>
                        <td><a style='padding:4px' href='update_employee.php?EmpID=$EmpID'>Update</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='12'>No data found</td></tr>";
        }

        // Close connection
        $connection->close();
        ?>
    </table>


    </div>
</body>

</html>

