<?php
include("db.php");
$result = mysqli_query($conn, "SELECT * FROM parkings ORDER BY time_in DESC");
$rows = [];
if ($result) {
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
}
respond($rows);
?>
