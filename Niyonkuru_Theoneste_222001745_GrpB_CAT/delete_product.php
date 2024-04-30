<?php
// Link for database Connection
include 'database_connection.php';

function showDeleteConfirmation($Pid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($Pid)">Confirm</button>
            <button onclick="returnToProduct()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(Pid) {
        window.location.href = '?ProID=' + Pid + '&confirm=yes';
    }
    function returnToProduct() {
        window.location.href = 'product.php';
    }
    </script>
HTML;
}

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if ProID is set
if(isset($_REQUEST['ProID'])) {
    $Pid = $_REQUEST['ProID'];
    
    // Check for confirmation response
    if (isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM product WHERE ProID=?");
        $stmt->bind_param("i", $Pid);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href = 'product.php';</script>";
        } else {
            echo "<script>alert('Error deleting data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($Pid);
    }
} else {
    echo "<script>alert('ProID is not set.'); window.location.href = 'product.php';</script>";
}

$connection->close();
?>
