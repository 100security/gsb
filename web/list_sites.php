<?php
// 100SECURITY
// www.100security.com.br
// Marcos Henrique - @100security

include_once "db.php";

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
$statusFilter = filter_input(INPUT_POST, 'statusFilter', FILTER_SANITIZE_STRING);
$inicio = ($pagina - 1) * $qnt_result_pg;

if ($statusFilter == 'Duplicates') {
    $result_sites = "SELECT site, status, http_code, COUNT(*) as cnt FROM sites GROUP BY site HAVING cnt > 1 ORDER BY status DESC LIMIT $inicio, $qnt_result_pg";
} elseif ($statusFilter == '') {
    $result_sites = "SELECT * FROM sites ORDER BY status DESC, http_code ASC LIMIT $inicio, $qnt_result_pg";
} else {
    $result_sites = "SELECT * FROM sites WHERE status = '" . mysqli_real_escape_string($conn, $statusFilter) . "' ORDER BY status DESC LIMIT $inicio, $qnt_result_pg";
}



$resultado_sites = mysqli_query($conn, $result_sites);

if($resultado_sites && $resultado_sites->num_rows != 0) {
    echo "<table class='table table-bordered text-center'>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    echo "<th>Status</th>";
    echo "<th>Site</th>";
    echo "<th>HTTP Code</th>";
    echo "<th>Remove</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while($row_sites = mysqli_fetch_assoc($resultado_sites)){
        $class = ''; 
        if($row_sites['status'] == 'Unsafe') {
            $class = 'table-danger';
        } elseif($row_sites['status'] == 'Safe') {
            $class = 'table-success';
        } elseif($row_sites['status'] == 'Duplicates') {
            $class = 'table-warning';
        }

        echo "<tr>";
        echo "<td class='" . $class . "'>" . $row_sites['status'] . "</td>";
        echo "<td><a href='" . $row_sites['site'] . "' target='_blank'>" . $row_sites['site'] . "</a></td>";
        echo "<td>" . $row_sites['http_code'] . "</td>";
        echo "<td><button class='btn btn-danger btn-sm remove-btn' data-id='" . $row_sites['id'] . "'>⚪</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<div class='alert alert-danger' role='alert'>No site found.</div>";
}

?>
