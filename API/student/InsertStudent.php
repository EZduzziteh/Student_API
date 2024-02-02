<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

include_once '../config/connection.php';
include_once '../objects/students.php';
 
$database = new Database();
$db = $database->getConnection();
 
$student = new Student($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->student_name) &&
    !empty($data->student_age) &&
    !empty($data->student_number) &&
    !empty($data->id)
){
 
    
    $student->id = $data->id;
    $student->student_name = $data->student_name;
    $student->student_number = $data->student_number;
    $student->student_age = $data->student_age;
 
    
    if($student->insert_student()){
 
        // set response code - 201 created
        http_response_code(201);
 
        echo json_encode(array("message" => "student was inserted"));
    }
 
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to insert student"));
    }
}
 
// tell the user data is incomplete
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to insert student. Data is incomplete."));
}
?>