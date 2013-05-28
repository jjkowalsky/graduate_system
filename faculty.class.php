<?php
include("advisee.class.php");
include("course.class.php");

function query_advisees($faculty_id) {
  return get_advisees($faculty_id);
}

function query_courses($faculty_id, $year, $semester) {
  return get_courses($faculty_id, $year, $semester);
}

function current_semester() {
  $today = getdate();
  // return semester_to_s(getdate()['mon']);
  return semester_to_s($today['mon']);
}
?>