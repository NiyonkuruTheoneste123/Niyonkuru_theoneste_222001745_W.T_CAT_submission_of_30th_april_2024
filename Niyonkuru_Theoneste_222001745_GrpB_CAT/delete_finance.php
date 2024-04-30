<?php
// Link for database Connection
include 'database_connection.php';

function showDeleteConfirmation($Fid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion('$Fid')">Confirm</button>
            <button onclick="returnToFinance()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(Fid) {
        window.location.href = '?FinID=' + Fid + '&confirm=yes';
    }
    function returnToFinance() {
        window.location.href = 'finance.php';
    }
    </script>
HTML;
}

// Check if FinID is set
if(isset($_REQUEST['FinID'])) {
    $Fid = $_REQUEST['FinID'];
    
    // Check for confirmation response
    if (isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM finance WHERE FinID=?");
        $stmt->bind_param("i", $Fid);
        if ($stmt->execute()) {
            echo "<script>alert('Record deleted successfully.'); window.location.href = 'finance.php';</script>";
        } else {
            echo "<script>alert('Error deleting data: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        // Show confirmation dialog
        showDeleteConfirmation($Fid);
    }
} else {
    echo "<script>alert('FinID is not set.'); window.location.href = 'finance.php';</script>";
}

$connection->close();
?>
