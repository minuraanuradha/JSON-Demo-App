<?php
// Check if the JSON file exists and is writable
$jsonFile = 'students.json';
if (!file_exists($jsonFile) || !is_writable($jsonFile)) {
    echo json_encode(array("message" => "Error: JSON file not found or not writable"));
    exit;
}

// Load the existing student data from students.json
$studentsData = file_get_contents($jsonFile);
$students = json_decode($studentsData, true);

// Check if the request method is POST and required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sid'], $_POST['name'], $_POST['age'], $_POST['address'], $_POST['cgpa'])) {
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $cgpa = $_POST['cgpa'];

    // Find the student record with the matching SID
    $updated = false;
    foreach ($students as &$student) {
        if ($student['sid'] == $sid) {
            $student['name'] = $name;
            $student['age'] = $age;
            $student['address'] = $address;
            $student['cgpa'] = $cgpa;
            $updated = true;
            break;
        }
    }

    // Save the updated data back to students.json
    if ($updated) {
        $jsonUpdated = json_encode($students, JSON_PRETTY_PRINT);
        if (file_put_contents($jsonFile, $jsonUpdated)) {
            echo "Student updated successfully";
        } else {
            echo json_encode(array("message" => "Error updating student data"));
        }
    } else {
        echo json_encode(array("message" => "Student not found"));
    }
} else {
    echo json_encode(array("message" => "Invalid request"));
}
?>
