<?php
$json_string = '{"name":"Keiv","age":19,"email":"keiv@example.com"}';

$student_object = json_decode($json_string);

$student_array = json_decode($json_string, true);

echo "Object: " . $student_object->name . "<br>";
echo "Array: " . $student_array['email'];
?>
