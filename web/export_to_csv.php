<?php
// 100SECURITY
// www.100security.com.br
// Marcos Henrique - @100security

include_once "db.php";

$filename = "sites_" . date('Y-m-d') . ".csv";

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

fputcsv($output, array('Status', 'Site', 'HTTP Code'));

$query = "SELECT status, site, http_code FROM sites";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
