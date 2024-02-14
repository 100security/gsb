<?php
// 100SECURITY
// www.100security.com.br
// Marcos Henrique - @100security

include_once "db.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM sites WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        echo "Record removed successfully";
    } else {
        echo "Error removing record";
    }
}
?>
