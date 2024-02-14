<?php
// 100SECURITY
// www.100security.com.br
// Marcos Henrique - @100security

include_once "db.php";
// "Safe"
$result_safe = "SELECT COUNT(id) AS num_safe FROM sites WHERE status = 'Safe'";
$resultado_safe = mysqli_query($conn, $result_safe);
$row_safe = mysqli_fetch_assoc($resultado_safe);
$num_safe = $row_safe['num_safe'];

// "Unsafe"
$result_unsafe = "SELECT COUNT(id) AS num_unsafe FROM sites WHERE status = 'Unsafe'";
$resultado_unsafe = mysqli_query($conn, $result_unsafe);
$row_unsafe = mysqli_fetch_assoc($resultado_unsafe);
$num_unsafe = $row_unsafe['num_unsafe'];

// Duplicates
$result_duplicates = "SELECT COUNT(*) as total_duplicatas FROM (SELECT site FROM sites GROUP BY site  HAVING COUNT(site) > 1) AS subquery;";
$resultado_duplicates = mysqli_query($conn, $result_duplicates);
$row_duplicates = mysqli_fetch_assoc($resultado_duplicates);
$num_duplicates = $row_duplicates['total_duplicatas'];

// "Total"
$result_total = "SELECT COUNT(id) AS num_total FROM sites";
$resultado_total = mysqli_query($conn, $result_total);
$row_total = mysqli_fetch_assoc($resultado_total);
$num_total= $row_total['num_total'];

echo json_encode(['safe' => $num_safe, 'unsafe' => $num_unsafe, 'duplicates' => $num_duplicates, 'total' => $num_total]);
