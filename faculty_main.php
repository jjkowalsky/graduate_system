<?php
include("header.php");
include("faculty.class.php");
//require_once("checkUser.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}
?>

<html xmlns="http://www.w3.org/1999/xhtml"> 
<head><title> Faculty </title>
Faculty Main Page
</head>
</br>

<?php
if (mysql_num_rows(checkUserId($_SESSION['id'],"CHAIR"))==1) {
	echo "<a href='review.php'>Review Applicants</a></br>";
}
?>

<!-- print advisees -->
<a href='faculty_main.php'>View Advisees</a>
<h2>Current Advisees:</h2>
<table border="1" cellspacing="3" cellpadding="5">
	<tr><th>Last Name</th>
		<th>M#</th></tr>
<?php

$advisees_result = query_advisees($_SESSION['id']);
if (empty($advisees_result)) {
	echo "<p id=\"no_advisees\">Not currently assigned as an advisor to any students...</p>";
}
else {
	while($advisee = mysql_fetch_assoc($advisees_result)) {
	  echo "<tr><td>{$advisee['Lname']}</td>";
		echo "<td>{$advisee['mNumber']}</td></tr>";
	}
}
	echo "</table>";
	echo "</br>";
?>


<h2>Courses Currently Teaching:</h2>
<table border="1" cellspacing="3" cellpadding="5">
	<tr>
		<th>Course Number</th>
		<th>Section Number</th>
		<th>Day(s)</th>
		<th>Time</th>		
		<th>Number of Students</th>		
	</tr>
<?php
// get_courses(0,0);

//faculty_id, year, semester
// get_courses($_SESSION['id'],2012,'Spring');

// $course_query = "SELECT `SECTIONS`.`courseNumber`, `SECTIONS`.`sectNumber`, `SECTIONS`.`day_offered`, `SECTIONS`.`time_offered`, `SECTIONS`.`semester`, `SECTIONS`.`year_offered`
// FROM COURSE, SECTIONS
// WHERE ((`COURSE`.`courseNumber` = `SECTIONS`.`courseNumber`) AND (`SECTIONS`.`semester` = 'Fall') AND (`SECTIONS`.`year_offered` = '2012') AND (`COURSE`.`courseInstrID` = {$_SESSION['id']}))
// ORDER BY `SECTIONS`.`courseNumber` ASC";
// $course_result = mysql_query($course_query);
$today = getdate();
$course_result = query_courses($_SESSION['id'],$today['year'],current_semester());
if (empty($course_result)) {
	echo "<p id=\"no_courses\">No courses taught during the current semester...</p>";
}
else {
	while($courses = mysql_fetch_assoc($course_result)) {
	  	echo "<tr><td>{$courses['courseNumber']}</td>";
	  	echo "<td>{$courses['sectNumber']}</td>";
	  	echo "<td>{$courses['day_offered']}</td>";
			echo "<td>{$courses['time_offered']}</td>";
			echo "<td>";
			// $num_students = mysql_num_rows(num_enrolled($_SESSION['id'], $courses['courseNumber']));
			// if (empty($num_students)) {
			// 	echo "0";
			// }
			// else {
			// 	echo $num_students;
			// }
			echo "</td>";
			echo "</tr>";
	}
}
?>
</table>
</br>

<h2>Past Semester Courses:</h2>
<form action="faculty_main.php" method="post">
	<input type="text" name="past_semester"><label>Past Semester</label>
	<br>
	<input type="text" name="past_year"><label>Past Year</label>
	<input type="submit" name="search_past_semester" value="Search Past Semester">
</form>

<table border="1" cellspacing="3" cellpadding="5">
	<tr>
		<th>Course Number</th>
		<th>Section Number</th>
		<th>Day(s)</th>
		<th>Time</th>		
		<th>Number of Students</th>		
	</tr>
<?php
if(isset($_POST['search_past_semester'])) {
	$past_course_result = query_courses($_SESSION['id'], $_POST['past_year'], $_POST['past_semester']);
	if (empty($past_course_result)) {
		echo "<p id=\"no_courses\">No courses taught during the requested semester...</p>";
	}
	else {
		while($past_courses = mysql_fetch_assoc($past_course_result)) {
		  	echo "<tr><td>{$past_courses['courseNumber']}</td>";
		  	echo "<td>{$past_courses['sectNumber']}</td>";
		  	echo "<td>{$past_courses['day_offered']}</td>";
				echo "<td>{$past_courses['time_offered']}</td>";
				echo "<td>";
				// echo num_enrolled($_SESSION['id'], $past_courses['courseNumber']);
				echo "</td>";
				echo "</tr>";
		}
	}
}
else { echo "Please provide a semester (Spring,Summer,Fall) and a year (XXXX)"; }
?>
</table>
</br>

<form action="faculty_main.php" method="post">
</br>

<h2>Assign Final Grades:</h2>
Course Number
<input type="text" name="course_final" size="10" maxlength="10"/>
<input type="submit" name="search_course" value="Search Course" />
Student Number
<input type="text" name="student_final" size="10" maxlength="10"/>
<input type="submit" name="search_student" value="Search Student" />
</form>
</br>
</br>
<table border="1" cellspacing="3" cellpadding="5">
	<tr>
		<th>Course Number</th>
		<th>CRN</th>
		<th>Student Number</th>		
		<th>Final Grade</th>		
	</tr>
<?php
$final_query = "";
if(isset($_POST['course_final'])) {
	// echo "{$_POST['course_final']}";
	$final_query = "SELECT `course`.`courseNumber`, `enroll`.`sectID`, `enroll`.`mNumber`
FROM `course`, `sections`, `enroll`
WHERE ((`course`.`courseNumber` = '{$_POST['course_final']}') AND (`sections`.`courseNumber` = `course`.`courseNumber`) AND (`sections`.`sectID` = `enroll`.`sectID`) AND (`course`.`courseInstrID` = {$_SESSION['id']}))
ORDER BY `course`.`courseNumber` ASC";
	// echo $final_query;

	// "SELECT `COURSE`.`courseNumber`, `ENROLL`.`sectID`, `ENROLL`.`mNumber`
	// FROM COURSE, SECTIONS, ENROLL
	// WHERE ((`COURSE`.`courseInstrID` = {$_SESSION['id']}) AND (`SECTIONS`.`courseNumber` = {$_POST['search_course']}) AND (`SECTIONS`.`sectID` = `ENROLL`.`sectID`))
	// ORDER BY `COURSE`.`courseNumber` ASC";
}
elseif (isset($_POST['search_student'])) {
	//code...
}	
else {
	echo "<p>Please enter a course number or student number...</p>";
}	
	$final_result = mysql_query($final_query);
	while($classes = mysql_fetch_assoc($final_result)) {
	  	echo "<tr><td>{$classes['courseNumber']}</td>";
	  	echo "<td>{$classes['sectID']}</td>";
	  	echo "<td>{$classes['mNumber']}</td>";
	?>
		<td><input type="text" name="<?=$classes['mNumber']?><?=$classes['sectID']?>" size="2" maxlength="2"/></td></tr>
	<?php
	}
	?>

	</table>
	</br>

	<form action="faculty_main.php" method="post">
	<input type="submit" name="submit_final" value="Submit Final Grades" />
	</form> 
	  
	<?php
	//end assign final grades

if(isset($_POST['submit_final'])) {
	$final_query = "SELECT `COURSE`.`courseNumber`, `ENROLL`.`sectID`, `ENROLL`.`mNumber`
	FROM COURSE, SECTIONS, ENROLL
	WHERE ((`COURSE`.`courseInstrID` = {$_SESSION['id']}) AND (`SECTIONS`.`courseNumber` = `COURSE`.`courseNumber`) AND (`SECTIONS`.`sectID` = `ENROLL`.`sectID`))
	ORDER BY `COURSE`.`courseNumber` ASC";
	$final_result = mysql_query($final_query);
	while($student = mysql_fetch_assoc($final_result)) {
		$studNum=$student['mNumber'];
		$studSect=$student['sectID'];
		$studJoin = $studNum.$studSect;
		$studGrade = $_POST["{$studJoin}"];//$student['{$studJoin}'];
		echo $studGrade;
		echo "</br>";	
		echo "{$student['{$studGrade}']}</br>";	
		echo $student['mNumber'],$student['sectID'];
		$update_final = "UPDATE ENROLL SET ENROLL.grade='{$studGrade}' WHERE ENROLL.mNumber='{$student['mNumber']}' AND ENROLL.sectID='{$student['sectID']}'";
		mysql_query($update_final);
	}
	header("Location: faculty_main.php");
}
?>

</html>
<?php
include("footer.php");
?>
