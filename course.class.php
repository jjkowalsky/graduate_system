<?php

function semester_to_s($semester) {
  if ($semester >= 1 && $semester <= 5) {
    $semester = 'Spring';
    // return $semester;
  }
  elseif ($semester >= 6 && $semester <= 8) {
    $semester = 'Summer';
    // return $semester;
  }
  elseif ($semester >= 9 && $semester <= 12) {
    $semester = 'Fall';
    // return $semester;
  }
  else { echo "Error. Please provide a valid month (1-12)"; }
  return $semester;
}

//NEED TO REWRITE THIS QUERY TO CORRECTLY COUNT THE NUMBER OF STUDENTS ENROLLED IN SPECIFIC SEMESTERS
//  IT CURRENTLY COUNTS ALL STUDENTS IN ALL SEMESTERS?
function num_enrolled($faculty_id, $course_number) {
  $num_enrolled_students = "SELECT `course`.`courseNumber`, `enroll`.`sectID`, `enroll`.`mNumber`
    FROM `course`, `sections`, `enroll`
    WHERE ((`course`.`courseNumber` = '{$course_number}') AND (`sections`.`courseNumber` = `course`.`courseNumber`) AND (`sections`.`sectID` = `enroll`.`sectID`) AND (`course`.`courseInstrID` = '{$faculty_id}'))
    ORDER BY `course`.`courseNumber` ASC";

    $num_students_result = mysql_query($num_enrolled_students);
    // return mysql_num_rows($num_students_result);
    return $num_students_result;
}

function get_courses($faculty_id, $year, $semester) {
  $today = getdate();
  // echo $today['year'];
  // echo $today['mon'];


  $year = empty($year) ? $today['year'] : $year;
  // echo $year;
  // echo $semester;

  $semester = empty($semester) ? $today['mon'] : $semester;
  if (is_int($semester)) {
    $semester = semester_to_s($semester);
    // if ($semester >= 1 && $semester <= 5) {
    //   $semester = 'Spring';
    // }
    // elseif ($semester >= 6 && $semester <= 8) {
    //   $semester = 'Summer';
    // }
    // elseif ($semester >= 9 && $semester <= 12) {
    //   $semester = 'Fall';
    // }
    // else { echo "Error. Please provide a valid month (1-12) or semester ('Spring','Summer','Fall')"; }
  }
  else {
    switch ($semester) {
      case 'Spring':
      case 'Summer':
      case 'Fall':
        break;
      
      default:
        echo "Error. Please provide a valid semester ('Spring','Summer','Fall')";
        break;
    }
  }
  // echo $semester;
  // echo $faculty_id;
  // fully functional query to accomodate for changes in school year
  $course_query = "SELECT `SECTIONS`.`courseNumber`, `SECTIONS`.`sectNumber`, 
  `SECTIONS`.`day_offered`, `SECTIONS`.`time_offered`, `SECTIONS`.`semester`, 
  `SECTIONS`.`year_offered` 
  FROM COURSE, SECTIONS
  WHERE ((`COURSE`.`courseNumber` = `SECTIONS`.`courseNumber`) AND 
        (`SECTIONS`.`semester` = '{$semester}') AND 
        (`SECTIONS`.`year_offered` = {$year}) AND 
        (`COURSE`.`courseInstrID` = {$faculty_id}))
  ORDER BY `SECTIONS`.`courseNumber` ASC";
  // echo $course_query;

  $course_result = mysql_query($course_query);
  return $course_result;
}
?>