<?php
// 100SECURITY
// www.100security.com.br
// Marcos Henrique - @100security

include_once "db.php";

$sql = "SELECT http_code, COUNT(*) as count FROM sites GROUP BY http_code";
$result = mysqli_query($conn, $sql);

$httpCodes = [];
while($row = mysqli_fetch_assoc($result)) {
    $httpCodes[$row['http_code']] = $row['count'];
}

echo json_encode($httpCodes);
?>
