<?php
function get_advisees($faculty_id) {
  $advisee_query = "SELECT  `FACULTY`.`facultyID` ,  `STUDENT`.`advisorID` ,  `STUDENT`.`userID` ,  `USERS`.`Lname`,  `STUDENT`.`mNumber`
  FROM FACULTY, STUDENT, USERS
  WHERE ((`FACULTY`.`facultyID` =  `STUDENT`.`advisorID`)
  AND (`STUDENT`.`userID` =  `USERS`.`userId`))
  AND (`FACULTY`.`facultyID` = '{$faculty_id}')
  ORDER BY  `FACULTY`.`facultyID` ASC ,  `STUDENT`.`advisorID` ASC";

  //this query only works if the header is included before advisee_header
  // maybe? not really quite sure.
  $advisee_result = mysql_query($advisee_query);
  return $advisee_result;
}
?>