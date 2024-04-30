<?php
// Link for database Connection
include 'database_connection.php';

function showDeleteConfirmation($Cid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($Cid)">Confirm</button>
            <button onclick="returnToSupplier()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(Cid) {
        window.location.href = '?SupID=' + Cid + '&confirm=yes';
    }
    function returnToSupplier() {
        window.location.href = 'supplier.php';
    }
    </script>
HTML;
}

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if SupID is set
if(isset($_REQUEST['SupID'])) {
    $Sid = $_REQUEST['SupID'];
    
    // Check for confirmation response
    if (isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM supplier WHERE SupID=?");
        $stmt->bind_param("i", $Sid);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href = 'supplier.php';</script>";
        } else {
            echo "<script>alert('Error deleting data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($Sid);
    }
} else {
    echo "<script>alert('SupID is not set.'); window.location.href = 'supplier.php';</script>";
}

$connection->close();
?>
