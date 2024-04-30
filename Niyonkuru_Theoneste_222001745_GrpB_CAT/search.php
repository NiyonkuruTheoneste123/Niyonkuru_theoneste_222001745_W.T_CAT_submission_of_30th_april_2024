<?php
if (isset($_GET['query'])) {
    $hostname = "localhost";
    $username = "niyoth";
    $password = "niyoth@250";
    $database = "production_company_system_db";

    $connection = new mysqli($hostname, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $searchTerm = $connection->real_escape_string($_GET['query']);

    $sql_customer = "SELECT * FROM customer WHERE CFname LIKE '%$searchTerm%'";
    $result_customer = $connection->query($sql_customer);

    $sql_employee = "SELECT * FROM employee WHERE Fname LIKE '%$searchTerm%'";
    $result_employee = $connection->query($sql_employee);

    $sql_finance = "SELECT * FROM finance WHERE branch_name LIKE '%$searchTerm%'";
    $result_finance = $connection->query($sql_finance);

    $sql_market = "SELECT * FROM market WHERE Mprovince LIKE '%$searchTerm%'";
    $result_market = $connection->query($sql_market);

    $sql_product = "SELECT * FROM product WHERE Pname LIKE '%$searchTerm%'";
    $result_product = $connection->query($sql_product);

    $sql_property = "SELECT * FROM property WHERE Pname LIKE '%$searchTerm%'";
    $result_property = $connection->query($sql_property);

    $sql_raw_material = "SELECT * FROM raw_material WHERE Rtype LIKE '%$searchTerm%'";
    $result_raw_material = $connection->query($sql_raw_material);

    $sql_supplier = "SELECT * FROM supplier WHERE fname LIKE '%$searchTerm%'";
    $result_supplier = $connection->query($sql_supplier);

    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>customer:</h3>";
    if ($result_customer->num_rows > 0) {
        while ($row = $result_customer->fetch_assoc()) {
            echo "<p>" . $row['CFname'] . "</p>";
        }
    } else {
        echo "<p>No customers found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>employee:</h3>";
    if ($result_employee->num_rows > 0) {
        while ($row = $result_employee->fetch_assoc()) {
            echo "<p>" . $row['Fname'] . "</p>";
        }
    } else {
        echo "<p>No employees found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>finance:</h3>";
    if ($result_finance->num_rows > 0) {
        while ($row = $result_finance->fetch_assoc()) {
            echo "<p>" . $row['branch_name'] . "</p>";
        }
    } else {
        echo "<p>No finance entries found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>market:</h3>";
    if ($result_market->num_rows > 0) {
        while ($row = $result_market->fetch_assoc()) {
            echo "<p>" . $row['Mprovince'] . "</p>";
        }
    } else {
        echo "<p>No market entries found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>product:</h3>";
    if ($result_product->num_rows > 0) {
        while ($row = $result_product->fetch_assoc()) {
            echo "<p>" . $row['Pname'] . "</p>";
        }
    } else {
        echo "<p>No products found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>property:</h3>";
    if ($result_property->num_rows > 0) {
        while ($row = $result_property->fetch_assoc()) {
            echo "<p>" . $row['Pname'] . "</p>";
        }
    } else {
        echo "<p>No properties found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>raw_material:</h3>";
    if ($result_raw_material->num_rows > 0) {
        while ($row = $result_raw_material->fetch_assoc()) {
            echo "<p>" . $row['Rtype'] . "</p>";
        }
    } else {
        echo "<p>No raw materials found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>supplier:</h3>";
    if ($result_supplier->num_rows > 0) {
        while ($row = $result_supplier->fetch_assoc()) {
            echo "<p>" . $row['fname'] . "</p>";
        }
    } else {
        echo "<p>No suppliers found matching the search term: " . $searchTerm . "</p>";
    }

    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
