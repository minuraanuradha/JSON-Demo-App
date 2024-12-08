<?php
// Read JSON file
$students_json = file_get_contents('students.json');
$students = json_decode($students_json, true);

// Return all students as JSON response
header('Content-Type: application/json');
echo json_encode($students);
?>
