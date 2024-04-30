<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier Form</title>
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
        <h2 style="margin-left: 100px;"><u>Supplier Form</u></h2>
        <form method="post" action="supplier.php">

            <label for="SupID">Supplier ID:</label>
            <input type="number" id="SupID" name="SupID" required><br><br>

            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required><br><br>

            <label for="Lname">Last Name:</label>
            <input type="text" id="Lname" name="Lname" required><br><br>

            <label for="Province">Province:</label>
            <input type="text" id="Province" name="Province" required><br><br>

            <label for="District">District:</label>
            <input type="text" id="District" name="District" required><br><br>

            <label for="sector">Sector:</label>
            <input type="text" id="sector" name="sector" required><br><br>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="amount_paid">Amount Paid:</label>
            <input type="number" id="amount_paid" name="amount_paid" required><br><br>

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
        $stmt = $connection->prepare("INSERT INTO supplier(SupID, fname, Lname, Province, District, sector, phone, email, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssss", $SupID, $fname, $Lname, $Province, $District, $sector, $phone, $email, $amount_paid);

        // Set parameters from POST and execute
        $SupID = $_POST['SupID'];
        $fname = $_POST['fname'];
        $Lname = $_POST['Lname'];
        $Province = $_POST['Province'];
        $District = $_POST['District'];
        $sector = $_POST['sector'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $amount_paid = $_POST['amount_paid'];

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

    <h2>Table of supplier</h2>
    <table>
        <tr>
            <th>SupID</th>
            <th>fname</th>
            <th>Lname</th>
            <th>Province</th>
            <th>District</th>
            <th>sector</th>
            <th>phone</th>
            <th>email</th>
            <th>amount_paid</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        //link for database Connection
     include 'database_connection.php';

        // SQL query to fetch data from the supplier table
        $sql = "SELECT * FROM supplier";
        $result = $connection->query($sql);

        if ($result === false) {
            echo "Error fetching data: " . $connection->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $SupID = $row["SupID"];
                echo "<tr>
                        <td>" . $row["SupID"] . "</td>
                        <td>" . $row["fname"] . "</td>
                        <td>" . $row["Lname"] . "</td>
                        <td>" . $row["Province"] . "</td>
                        <td>" . $row["District"] . "</td>
                        <td>" . $row["sector"] . "</td>
                        <td>" . $row["phone"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["amount_paid"] . "</td>
                        <td><a style='padding:4px' href='delete_supplier.php?SupID=$SupID'>Delete</a></td>
                        <td><a style='padding:4px' href='update_supplier.php?SupID=$SupID'>Update</a></td>
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
