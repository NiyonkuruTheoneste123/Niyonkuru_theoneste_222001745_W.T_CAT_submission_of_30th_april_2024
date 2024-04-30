<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property Form</title>
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
        <h2 style="margin-left: 100px;"><u>Property Form</u></h2>
        <form method="post" action="property.php">

            <label for="PropID">Property ID:</label>
            <input type="number" id="PropID" name="PropID" required><br><br>

            <label for="EmpID">Employee ID:</label>
            <input type="number" id="EmpID" name="EmpID" required><br><br>

            <label for="Pname">Property Name:</label>
            <input type="text" id="Pname" name="Pname" required><br><br>

            <label for="Province">Province:</label>
            <input type="text" id="Province" name="Province" required><br><br>

            <label for="District">District:</label>
            <input type="text" id="District" name="District" required><br><br>

            <label for="Sector">Sector:</label>
            <input type="text" id="Sector" name="Sector" required><br><br>

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
        $stmt = $connection->prepare("INSERT INTO property(PropID, EmpID, Pname, Province, District, Sector) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $PropID, $EmpID, $Pname, $Province, $District, $Sector);

        // Set parameters from POST and execute
        $PropID = $_POST['PropID'];
        $EmpID = $_POST['EmpID'];
        $Pname = $_POST['Pname'];
        $Province = $_POST['Province'];
        $District = $_POST['District'];
        $Sector = $_POST['Sector'];

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

    <h2>Table of property</h2>
    <table>
        <tr>
            <th>PropID</th>
            <th>EmpID</th>
            <th>Pname</th>
            <th>Province</th>
            <th>District</th>
            <th>Sector</th>
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

        // SQL query to fetch data from the property table
        $sql = "SELECT * FROM property";
        $result = $connection->query($sql);

        if ($result === false) {
            echo "Error fetching data: " . $connection->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $PropID = $row["PropID"];
                echo "<tr>
                        <td>" . $row["PropID"] . "</td>
                        <td>" . $row["EmpID"] . "</td>
                        <td>" . $row["Pname"] . "</td>
                        <td>" . $row["Province"] . "</td>
                        <td>" . $row["District"] . "</td>
                        <td>" . $row["Sector"] . "</td>
                        <td><a style='padding:4px' href='delete_property.php?PropID=$PropID'>Delete</a></td>
                        <td><a style='padding:4px' href='update_property.php?PropID=$PropID'>Update</a></td>
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
