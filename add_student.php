<?php
// Load existing student data from students.json
$studentsData = file_get_contents('students.json');
$students = json_decode($studentsData, true);

// Check if form data is provided via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['sid'], $_POST['name'], $_POST['age'], $_POST['address'], $_POST['cgpa'])) {
    // Get form data
    $id = $_POST['sid'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $cgpa = $_POST['cgpa'];

    // Read existing students data
    $students_json = file_get_contents('students.json');
    $students = json_decode($students_json, true);

    // Create new student object
    $new_student = array(
        'sid' => $id,
        'name' => $name,
        'age' => $age,
        'address' => $address,
        'cgpa' => $cgpa
    );

    // Add the new student to the array of students
    $students[] = $new_student;

    // Convert the updated students array back to JSON format
    $updated_students_json = json_encode($students, JSON_PRETTY_PRINT);

    // Write the updated JSON data back to the file
    file_put_contents('students.json', $updated_students_json);

    // Respond with success message
    echo "Student added successfully";

} else {
    // Respond with error message if no form data is provided
    echo json_encode(array("message" => "No data received"));
}
?>
