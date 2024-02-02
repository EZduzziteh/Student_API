<?php

//database file
class Student{
  
    // database connection and table name
    private $conn;
    private $table_name = "student";
  
    // object properties
    public $id;
    public $student_name;
    public $student_number;
    public $student_age;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function get_students() {// to get all records of students
    
        // select all query
        $query = "SELECT
                 id, student_name, student_number, student_age
                FROM
                    " . $this->table_name ;
                   
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    
    }


    function get_student(){ // to get the record of the student with the provided ID
   
        
            // query to read single record
            $query = "SELECT
            id, student_name, student_age, student_number 
        FROM
            student
        WHERE
            id = ?";
       

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        
        $this->id = $row['id'];
        $this->student_name = $row['student_name'];
        $this->student_number = $row['student_number'];
        $this->student_age = $row['student_age'];

    }
    function delete_student(){
 
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }

    function insert_student(){

    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                student_name=:student_name, student_age=:student_age, student_number=:student_number, id=:id";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->student_name=htmlspecialchars(strip_tags($this->student_name));
    $this->student_number=htmlspecialchars(strip_tags($this->student_number));
    $this->student_age=htmlspecialchars(strip_tags($this->student_age));
 
    // bind values
    $stmt->bindParam(":student_name", $this->student_name);
    $stmt->bindParam(":student_number", $this->student_number);
    $stmt->bindParam(":student_age", $this->student_age);
    $stmt->bindParam(":id", $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     

    }
    
function update_student(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                student_name = :student_name,
                student_age = :student_age,
                student_number= :student_number
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->student_name=htmlspecialchars(strip_tags($this->student_name));
    $this->student_age=htmlspecialchars(strip_tags($this->student_age));
    $this->student_number=htmlspecialchars(strip_tags($this->student_number));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':student_name', $this->student_name);
    $stmt->bindParam(':student_number', $this->student_number);
    $stmt->bindParam(':student_age', $this->student_age);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
    }

}
?>