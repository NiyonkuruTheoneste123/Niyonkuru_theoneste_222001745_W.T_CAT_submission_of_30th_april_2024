<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Form</title>
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
        <h3>Customer Form</h3>
        <form method="post" action="customer.php">

            <label for="CustID">Customer ID:</label>
            <input type="number" id="CustID" name="CustID" required><br><br>

            <label for="CFname">First Name:</label>
            <input type="text" id="CFname" name="CFname" required><br><br>

            <label for="CLname">Last Name:</label>
            <input type="text" id="CLname" name="CLname" required><br><br>

            <label for="CEmail">Email:</label>
            <input type="email" id="CEmail" name="CEmail" required><br><br>

            <label for="CPhone">Phone Number:</label>
            <input type="tel" id="CPhone" name="CPhone" required><br><br>

            <label for="Amountpaid">Amount Paid:</label>
            <input type="number" id="Amountpaid" name="Amountpaid" required><br><br>

            <label for="ProID">Product ID:</label>
            <input type="number" id="ProID" name="ProID" required><br><br>

            <input class="button"  type="submit" name="add" value="Insert">
            
            <a class="button" href="./home.html">Go Back to Home</a>

        </form>
       <?php
       // link for datrabase conne
  include 'database_connection.php';
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Insert section
        $stmt = $connection->prepare("INSERT INTO customer(CustID, CFname, CLname, CEmail, Cphone, Amountpaid, ProID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssi", $CustID, $CFname, $CLname, $CEmail, $Cphone, $Amountpaid, $ProID);

        // Set parameters from POST and execute
        $CustID = $_POST['CustID'];
        $CFname = $_POST['CFname'];
        $CLname = $_POST['CLname'];
        $CEmail = $_POST['CEmail'];
        $Cphone = $_POST['CPhone'];
        $Amountpaid = $_POST['Amountpaid'];
        $ProID = $_POST['ProID'];

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

    <h2>Table of customers</h2>
    <table>
        <tr>
            <th>CustID</th>
            <th>CFname</th>
            <th>CLname</th>
            <th>CEmail</th>
            <th>Cphone</th>
            <th>Amountpaid</th>
            <th>ProID</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        //link for database Connection
     include 'database_connection.php';

        // SQL query to fetch data from the customers table
        $sql = "SELECT * FROM customer";
        $result = $connection->query($sql);

        if ($result === false) {
            echo "Error fetching data: " . $connection->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $CustID = $row["CustID"];
                echo "<tr>
                        <td>" . $row["CustID"] . "</td>
                        <td>" . $row["CFname"] . "</td>
                        <td>" . $row["CLname"] . "</td>
                        <td>" . $row["CEmail"] . "</td>
                        <td>" . $row["Cphone"] . "</td>
                        <td>" . $row["Amountpaid"] . "</td>
                        <td>" . $row["ProID"] . "</td>
                        <td><a style='padding:4px' href='delete_customer.php?CustID=$CustID'>Delete</a></td>
                        <td><a style='padding:4px' href='update_customer.php?CustID=$CustID'>Update</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No data found</td></tr>";
        }

        // Close connection
        $connection->close();
        ?>
    </table>

    </div>
</body>

</html>
