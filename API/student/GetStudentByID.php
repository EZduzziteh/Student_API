<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
  
// database connection will be here
// include database and object files
include_once '../config/connection.php';
include_once '../objects/students.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$student = new Student($db);
 
$student->id = isset($_GET['id']) ? $_GET['id'] : die();
 
$student->get_student();
 
if($student->student_name!=null){
    // create array
    $student_arr = array(
        "id" =>  $student->id,
        "student_name" => $student->student_name,
        "student_number" => $student->student_number,
        "student_age" => $student-> student_age,
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($student_arr);
}
 
else{
    http_response_code(404);
 
    echo json_encode(array("message" => "Student does not exist."));
}





?>