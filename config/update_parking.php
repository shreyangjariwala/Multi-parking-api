<?php
include("db.php");
$data = read_json_body();

$required = ["id", "status"];
foreach ($required as $field) {
    if (!isset($data[$field]) || $data[$field] === "") {
        respond(["status" => "error", "message" => "Missing field: " . $field], 400);
    }
}

$id = intval($data['id']);
$status = mysqli_real_escape_string($conn, $data['status']);

if ($status === "vacant") {
    $sql = "UPDATE parkings SET status='vacant', time_out=NOW() WHERE id={$id}";
} else {
    $sql = "UPDATE parkings SET status='$status' WHERE id={$id}";
}

if (mysqli_query($conn, $sql)) {
    respond(["status" => "success", "message" => "Updated"]);
} else {
    respond(["status" => "error", "message" => mysqli_error($conn)], 500);
}
?>
