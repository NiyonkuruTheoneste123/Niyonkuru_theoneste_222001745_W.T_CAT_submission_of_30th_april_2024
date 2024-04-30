<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Form</title>
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

</head>

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
        <h2 style="margin-left: 100px;"><u>Finance Form</u></h2>
        <form method="post" action="finance.php">

            <label for="FinID">Finance ID:</label>
            <input type="number" id="FinID" name="FinID" required><br><br>

            <label for="Fin_names">Financial Source:</label>
            <input type="text" id="Fin_names" name="Fin_names" required><br><br>

            <label for="asset_value">Asset Value:</label>
            <input type="number" id="asset_value" name="asset_value" required><br><br>

            <label for="salary_amount">Salary Amount:</label>
            <input type="number" id="salary_amount" name="salary_amount" required><br><br>

            <label for="amount_per_year">Amount per Year:</label>
            <input type="number" id="amount_per_year" name="amount_per_year" required><br><br>

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
            $stmt = $connection->prepare("INSERT INTO finance(FinID, Fin_names, asset_value, salary_amount, amount_per_year) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isddd", $FinID, $Fin_names, $asset_value, $salary_amount, $amount_per_year);

            // Set parameters from POST and execute
            $FinID = $_POST['FinID'];
            $Fin_names = $_POST['Fin_names'];
            $asset_value = $_POST['asset_value'];
            $salary_amount = $_POST['salary_amount'];
            $amount_per_year = $_POST['amount_per_year'];

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

        <h2>Table of finance</h2>
        <table>
            <tr>
                <th>FinID</th>
                <th>Fin_names</th>
                <th>asset_value</th>
                <th>salary_amount</th>
                <th>amount_per_year</th>
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

            // SQL query to fetch data from the finance table
            $sql = "SELECT * FROM finance";
            $result = $connection->query($sql);

            if ($result === false) {
                echo "Error fetching data: " . $connection->error;
            } elseif ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $FinID = $row["FinID"];
                    echo "<tr>
                            <td>" . $row["FinID"] . "</td>
                            <td>" . $row["Fin_names"] . "</td>
                            <td>" . $row["asset_value"] . "</td>
                            <td>" . $row["salary_amount"] . "</td>
                            <td>" . $row["amount_per_year"] . "</td>
                            <td><a style='padding:4px' href='delete_finance.php?FinID=$FinID'>Delete</a></td>
                            <td><a style='padding:4px' href='update_finance.php?FinID=$FinID'>Update</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data found</td></tr>";
            }

            // Close connection
            $connection->close();
            ?>
        </table>
    </div>
</body>

</html>
