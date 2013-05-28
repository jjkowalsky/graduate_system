<?php
// include("user.class.php");

class Student extends User {
  // private $id;    //id of student
  // private $stud;  //array to hold student

  public function __construct($i) {
    User::__construct($i);
  }

  //return student id
  public function getID() {
    return User::getID();
  }

  //query database to return student's user info as php array
  public function getStudent() {
    return User::get_user();
    // return $this->get_user();
  }
 
  //query db to return classes as rows in php array
  public function getClasses() {
    //call Classes function to get classes
    //remember to include Classes class file
    $classes_query = "SELECT DISTINCT `ENROLL`.`sectID`,`STUDENT`.`mNumber`, `ENROLL`.`mNumber`, `STUDENT`.`userID`, `SECTIONS`.`sectID`, `STUDENT`.*, `ENROLL`.*,`SECTIONS`.*
    FROM STUDENT, ENROLL, SECTIONS
    WHERE ((`STUDENT`.`mNumber` = `ENROLL`.`mNumber`) AND (`STUDENT`.`userID` = '{$this->getID()}') AND (`SECTIONS`.`sectID` = `ENROLL`.`sectID`))";

    return mysql_query($classes_query);
  }

  public function view_transcript() {

    echo "<h3>Your Unofficial Transcript</h3>";
    echo "<table border='1' cellspacing='3' cellpadding='5'>
      <tr><th>Course Number</th>
        <th>Course Section</th>
        <th>Semester</th>
        <th>Year</th>
        <th>Grade</th></tr>";

    $classes_result = $this->getClasses();
    if (empty($classes_result)) {
      echo "<p>This student has not taken any classes yet...</p><br>";
    }
    else {
      while($row=mysql_fetch_array($classes_result)) {
        echo "<tr><td>{$row['courseNumber']}</td>";
        echo "<td>{$row['sectNumber']}</td>";
        echo "<td>{$row['semester']}</td>";
        echo "<td>{$row['year_offered']}</td>";
        echo "<td>{$row['grade']}</td></tr>";
        $gpa = $row['gpa'];
      }
      echo "
      </table>
      </br>
      GPA: {$gpa}
      </br>";
    }
  }//end view_transcript

  public function audit_transcript() {
    //audit transcript
    //return true if 
      //transcript matches grad_form
      //transcript satisfies program req's
        //if no classes have IP or grade less than
      //program req's
        //36 hours of graduate coursework
        //min 24 hours at 6000 level
        //all courses taken from cs dept
        //each course min GPA of B or 3.0
  }

  public function apply_graduation() {
    //if audit returns good true
      //set applied for graduation to true to signal the GS
      $apply_query = "UPDATE STUDENT SET STUDENT.applied_gradn = TRUE WHERE STUDENT.userID='{$this->getID()}'";
      mysql_query($apply_query);
  } //return result of audit

  public function edit_grad_form() {

  }

  public function display_user_form($user_row) {
    echo "
    <form action='student_main.php' method='post'>
      </br>
        <label>Firstname</label>
         <input type='text' name='firstname' value='{$user_row['Fname']}' size='20' maxlength='20' />
         
         <label>M.I.</label>
         <input type='text' name='minit' value='{$user_row['Minit']}' size='1' maxlength='1'/>
       
         <label>Lastname</label> 
         <input type='text' name='lastname' value='{$user_row['Lname']}' size='20' maxlength='20' />
      </br>
      </br>
         <label>Social Security #</label>
         <input type='text' name='SSN' value='{$user_row['Ssn']}' size='9' maxlength='9'/>

         <label>Student #</label>
         <input type='text' name='studentnumber' value='{$user_row['mNumber']}' size='9' maxlength='9' />
      </br>
      </br>
         <label>Birth Date</label>
         <input type='text' name='birthdate' value='{$user_row['BDate']}' size='10' maxlength='10' />
           
         <label>Gender</label>
         <input type='text' name='gender' value='{$user_row['Sex']}' size='1' maxlength='1' />
      </br>
      </br>
         <label>Address</label>
         <input type='text' name='address' value='{$user_row['Address']}' size='50' maxlength='50'/>
      </br>
      </br>    
         <label>Home Phone</label>
         <input type='text' name='phone_home' value='{$user_row['Phone_Home']}' size='12' maxlength='15' />
      </br>
        <label>Cell Phone</label>
         <input type='text' name='phone_cell' value='{$user_row['Phone_Cell']}' size='12' maxlength='15' />
      </br>
         <label>Email</label>
         <input type='email' name='email' value='{$user_row['Email']}' size='15' maxlength='30'/>
      </br>
      </br> 
         <label>Username</label>
         <input type='text' name='username' value='{$user_row['username']}' size='10' maxlength='10'/>
      </br> 
         <label>Password</label>
         <input type='password' name='password' value='{$user_row['Password']}' size='8' maxlength='8' />
      <br>
      </br> 
         <input type='submit' name='submit_update' value='submit' />
    </form>";
  }

}//end Student

?>