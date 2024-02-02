<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/connection.php';
include_once '../objects/students.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$student = new Student($db);
 
// get id of the student record to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set which student record to be updated
$student->id = $data->id;
 
// set new student properties
$student->student_number= $data->student_number;
$student->student_age = $data->student_age;
$student->student_name = $data->student_name;
 
// update the student
if($student->update_student()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "student record was updated."));
}
 
// if unable to update the student, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update the student."));
}
?>