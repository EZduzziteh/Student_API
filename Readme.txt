GLA done by Sasha Greene

instructions: 

import the database included: students_student.sql

for my database i added a user with the username
'user' and the password 'password' with full DBA priveleges. 
You can either create this user, or in the connection.php, 
modify lines 10 and 11 to be either blank or reflect the user and password that you have.

I ran the server on port 8080 but that shouldnt really matter, its just for the api calls, you likely will have to just use localhost.

put the api folder in your apache/htdocs

I used postman for making the requests, but these can also be done form the web browser(except the one requiring json data) 

sample requests: 

localhost:8080/api/student/getallstudents.php

localhost:8080/api/student/insertstudent.php 
with raw json data: 
{
    
    "id" : 12345,
    "student_name" : "Frank Wolf",
    "student_number" : 123456,
    "student_age" : 32
}

localhost:8080/api/student/getstudentbyid.php?id=12345 
replace id=12345 with whatever id you want to look up.


localhost:8080/api/student/updatestudent.php
with raw json data: 
{
 "student_name": "Yoda",
 "student_age": "900", 
 "student_number" : "692472",
 "id":3
}

replace the id with whatever record id you would like to update

localhost:8080/api/student/deletestudent.php
with raw json data: 
{
   "id":"3"    
}


