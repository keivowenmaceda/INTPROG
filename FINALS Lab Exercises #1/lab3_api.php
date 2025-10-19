<?php
header('Content-Type: application/json');

$user_profile = array(
    "id" => 1,
    "name" => "Keiv",
    "email" => "keiv@example.com",
    "status" => "active"    
);

echo json_encode($user_profile);
?>
