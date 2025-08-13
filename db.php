<?php
header("Content-Type: application/json");
$conn = mysqli_connect("localhost", "root", "", "parking_db");
if (!$conn) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}

function respond($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data);
    exit;
}

function read_json_body() {
    $input = file_get_contents("php://input");
    return json_decode($input, true);
}
?>
