<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/connection.php';
include_once '../objects/students.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$student = new Student($db);
  
$stmt = $student->get_students();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // array of studenst
    $students_arr=array();
    $students_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   
        extract($row);
  
        $students_item=array(
            "id" => $id,
            "student_name" => $student_name,
            "student_age"=>$student_age,
            "student_number"=>$student_number
        );
  
        array_push($students_arr["records"], $students_item);
    }
  
    http_response_code(200);
  
    echo json_encode($students_arr);
}
else{
  
    http_response_code(404);

    echo json_encode(
        array("message" => "No students found.")
    );
}
?>