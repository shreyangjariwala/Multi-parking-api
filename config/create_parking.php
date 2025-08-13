<?php
include("db.php");
$data = read_json_body();

$required = ["vehicle_number", "floor", "slot"];
foreach ($required as $field) {
    if (!isset($data[$field]) || $data[$field] === "") {
        respond(["status" => "error", "message" => "Missing field: " . $field], 400);
    }
}

$vehicle_number = mysqli_real_escape_string($conn, $data['vehicle_number']);
$floor = intval($data['floor']);
$slot = intval($data['slot']);

$sql = "INSERT INTO parkings (vehicle_number, floor, slot, time_in, status) 
        VALUES ('$vehicle_number', $floor, $slot, NOW(), 'occupied')";

if (mysqli_query($conn, $sql)) {
    respond(["status" => "success", "id" => mysqli_insert_id($conn)]);
} else {
    respond(["status" => "error", "message" => mysqli_error($conn)], 500);
}
?>
