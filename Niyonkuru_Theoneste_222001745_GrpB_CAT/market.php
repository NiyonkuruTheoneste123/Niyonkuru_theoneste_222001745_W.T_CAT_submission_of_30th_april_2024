<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Market Form</title>
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
        <h2 style="margin-left: 100px;"><u>Market Form</u></h2>
        <form method="post" action="market.php">

            <label for="MarkID">Market ID:</label>
            <input type="number" id="MarkID" name="MarkID" required><br><br>

            <label for="Mprovince">Province:</label>
            <input type="text" id="Mprovince" name="Mprovince" required><br><br>

            <label for="Mdistrict">District:</label>
            <input type="text" id="Mdistrict" name="Mdistrict" required><br><br>

            <label for="Msector">Sector:</label>
            <input type="text" id="Msector" name="Msector" required><br><br>

            <label for="supplydate">Supply Date:</label>
            <input type="date" id="supplydate" name="supplydate" required><br><br>

            <label for="EmpID">Employee ID:</label>
            <input type="number" id="EmpID" name="EmpID" required><br><br>

            <label for="ProID">Product ID:</label>
            <input type="number" id="ProID" name="ProID" required><br><br>

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
        $stmt = $connection->prepare("INSERT INTO market(MarkID, Mprovince, Mdistrict, Msector, supplydate, EmpID, ProID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssi", $MarkID, $Mprovince, $Mdistrict, $Msector, $supplydate, $EmpID, $ProID);

        // Set parameters from POST and execute
        $MarkID = $_POST['MarkID'];
        $Mprovince = $_POST['Mprovince'];
        $Mdistrict = $_POST['Mdistrict'];
        $Msector = $_POST['Msector'];
        $supplydate = $_POST['supplydate'];
        $EmpID = $_POST['EmpID'];
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

    <h2>Table of marks</h2>
    <table>
        <tr>
            <th>MarkID</th>
            <th>Mprovince</th>
            <th>Mdistrict</th>
            <th>Msector</th>
            <th>supplydate</th>
            <th>EmpID</th>
            <th>ProID</th>
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

        // SQL query to fetch data from the marks table
        $sql = "SELECT * FROM market";
        $result = $connection->query($sql);

        if ($result === false) {
            echo "Error fetching data: " . $connection->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $MarkID = $row["MarkID"];
                echo "<tr>
                        <td>" . $row["MarkID"] . "</td>
                        <td>" . $row["Mprovince"] . "</td>
                        <td>" . $row["Mdistrict"] . "</td>
                        <td>" . $row["Msector"] . "</td>
                        <td>" . $row["supplydate"] . "</td>
                        <td>" . $row["EmpID"] . "</td>
                        <td>" . $row["ProID"] . "</td>
                        <td><a style='padding:4px' href='delete_market.php?MarkID=$MarkID'>Delete</a></td>
                        <td><a style='padding:4px' href='update_market.php?MarkID=$MarkID'>Update</a></td>
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
