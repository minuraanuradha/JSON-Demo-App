<?php
// Read JSON file
$students_json = file_get_contents('students.json');
$students = json_decode($students_json, true);

// Check if SID is provided in the GET request
if(isset($_GET['sid'])) {
    $sid = $_GET['sid'];
    $found = false;
    // Find the student record with matching SID
    foreach($students as $student) {
        if($student['sid'] == $sid) {
            echo json_encode($student);
            $found = true;
            break;
        }
    }
    if(!$found) {
        echo json_encode("SID not found");
    }
} else {
    echo "SID parameter is missing";
}
?>
