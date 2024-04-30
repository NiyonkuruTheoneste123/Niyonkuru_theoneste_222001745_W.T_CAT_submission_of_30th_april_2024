<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Linking to external stylesheet -->
    <link rel="stylesheet" type="text/css" href="styles.css" title="style 1" media="screen, tv, projection, handheld, print" />
    <!-- Defining character encoding -->
    <meta charset="utf-8">
    <!-- Setting viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Form</title>
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
        <h2 style="margin-left: 100px;"><u>Product Form</u></h2>
        <form method="post" action="product.php">

            <label for="ProID">Product ID:</label>
            <input type="number" id="ProID" name="ProID" required><br><br>

            <label for="Pname">Product Name:</label>
            <input type="text" id="Pname" name="Pname" required><br><br>

            <label for="Amount">Amount:</label>
            <input type="number" id="Amount" name="Amount" required><br><br>

            <label for="Price">Price:</label>
            <input type="number" id="Price" name="Price" required><br><br>

            <label for="Mnfdate">Manufacture Date:</label>
            <input type="date" id="Mnfdate" name="Mnfdate" required><br><br>

            <label for="Expdate">Expiration Date:</label>
            <input type="date" id="Expdate" name="Expdate" required><br><br>

            <label for="RmID">Raw Material ID:</label>
            <input type="number" id="RmID" name="RmID" required><br><br>

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
        $stmt = $connection->prepare("INSERT INTO product(ProID, Pname, Amount, Price, Mnfdate, Expdate, RmID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdssi", $ProID, $Pname, $Amount, $Price, $Mnfdate, $Expdate, $RmID);

        // Set parameters from POST and execute
        $ProID = $_POST['ProID'];
        $Pname = $_POST['Pname'];
        $Amount = $_POST['Amount'];
        $Price = $_POST['Price'];
        $Mnfdate = $_POST['Mnfdate'];
        $Expdate = $_POST['Expdate'];
        $RmID = $_POST['RmID'];

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

    <h2>Table of products</h2>
    <table>
        <tr>
            <th>ProID</th>
            <th>Pname</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Mnfdate</th>
            <th>Expdate</th>
            <th>RmID</th>
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

        // SQL query to fetch data from the product table
        $sql = "SELECT * FROM product";
        $result = $connection->query($sql);

        if ($result === false) {
            echo "Error fetching data: " . $connection->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ProID = $row["ProID"];
                echo "<tr>
                        <td>" . $row["ProID"] . "</td>
                        <td>" . $row["Pname"] . "</td>
                        <td>" . $row["Amount"] . "</td>
                        <td>" . $row["Price"] . "</td>
                        <td>" . $row["Mnfdate"] . "</td>
                        <td>" . $row["Expdate"] . "</td>
                        <td>" . $row["RmID"] . "</td>
                        <td><a style='padding:4px' href='delete_product.php?ProID=$ProID'>Delete</a></td>
                        <td><a style='padding:4px' href='update_product.php?ProID=$ProID'>Update</a></td>
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
