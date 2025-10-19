<?php
$input = file_get_contents('php://input');

$data = json_decode($input);

echo "Username: " . $data->username . "<br>";
echo "Password: " . $data->password;
?>
