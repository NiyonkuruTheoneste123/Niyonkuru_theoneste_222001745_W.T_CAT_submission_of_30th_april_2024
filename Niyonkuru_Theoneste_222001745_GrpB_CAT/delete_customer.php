<?php
include 'database_connection.php';

// Function to show delete confirmation modal
function showDeleteConfirmation($Cid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($Cid)">Confirm</button>
            <button onclick="returnToCustomer()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(Cid) {
        window.location.href = '?CustID=' + Cid + '&confirm=yes';
    }
    function returnToCustomer() {
        window.location.href = 'customer.php';
    }
    </script>
HTML;
}

// Check if Customer ID is set
if(isset($_REQUEST['CustID'])) {
    $Cid = $_REQUEST['CustID'];
    
    // Check for confirmation response
    if (isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM customer WHERE CustID=?");
        $stmt->bind_param("i", $Cid);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href = 'customer.php';</script>";
        } else {
            echo "<script>alert('Error deleting data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($Cid);
    }
} else {
    echo "<script>alert('CustID is not set.'); window.location.href = 'customer.php';</script>";
}

$connection->close();
?>
