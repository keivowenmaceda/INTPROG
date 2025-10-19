<?php
$input = file_get_contents('php://input');
$data = json_decode($input);

$response = array(
    "status" => "success",
    "message" => "Welcome, " . $data->name . "!"
);

header('Content-Type: application/json');
echo json_encode($response);
?>

