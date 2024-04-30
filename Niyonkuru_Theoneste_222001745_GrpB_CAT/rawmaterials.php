<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raw Materials Form</title>
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
        <h2 style="margin-left: 100px;"><u>Raw Materials Form</u></h2>
        <form method="post" action="rawmaterials.php">

            <label for="RmID">Raw Material ID:</label>
            <input type="number" id="RmID" name="RmID" required><br><br>

            <label for="Rtype">Raw Material Type:</label>
            <input type="text" id="Rtype" name="Rtype" required><br><br>

            <label for="Ramount">Raw Material Amount:</label>
            <input type="number" id="Ramount" name="Ramount" required><br><br>

            <label for="stored_date">Stored Date:</label>
            <input type="date" id="stored_date" name="stored_date" required><br><br>

            <label for="unstore_date">Unstore Date:</label>
            <input type="date" id="unstore_date" name="unstore_date" required><br><br>

            <label for="SupID">Supplier ID:</label>
            <input type="number" id="SupID" name="SupID" required><br><br>

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
        $stmt = $connection->prepare("INSERT INTO raw_material(RmID, Rtype, Ramount, stored_date, unstore_date, SupID) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isdsds", $RmID, $Rtype, $Ramount, $stored_date, $unstore_date, $SupID);

        // Set parameters from POST and execute
        $RmID = $_POST['RmID'];
        $Rtype = $_POST['Rtype'];
        $Ramount = $_POST['Ramount'];
        $stored_date = $_POST['stored_date'];
        $unstore_date = $_POST['unstore_date'];
        $SupID = $_POST['SupID'];

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

    <h2>Table of Raw materials</h2>
    <table>
        <tr>
            <th>RmID</th>
            <th>Rtype</th>
            <th>Ramount</th>
            <th>stored_date</th>
            <th>unstore_date</th>
            <th>SupID</th>
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

        // SQL query to fetch data from the inventory table
        $sql = "SELECT * FROM raw_material";
        $result = $connection->query($sql);

        if ($result === false) {
            echo "Error fetching data: " . $connection->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $RmID = $row["RmID"];
                echo "<tr>
                        <td>" . $row["RmID"] . "</td>
                        <td>" . $row["Rtype"] . "</td>
                        <td>" . $row["Ramount"] . "</td>
                        <td>" . $row["stored_date"] . "</td>
                        <td>" . $row["unstore_date"] . "</td>
                        <td>" . $row["SupID"] . "</td>
                        <td><a style='padding:4px' href='delete_rawmaterials.php?RmID=$RmID'>Delete</a></td>
                        <td><a style='padding:4px' href='update_rawmaterials.php?RmID=$RmID'>Update</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No data found</td></tr>";
        }

        // Close connection
        $connection->close();
        ?>
    </table>

    </div>
</body>

</html>
