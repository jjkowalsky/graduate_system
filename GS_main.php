<?php
include("header.php");
include("gs.class.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}

$gs = new GS($_SESSION['id']);

if (mysql_num_rows($gs->checkUserId($_SESSION['id'],"GRAD_SECT"))==1) {
// if (mysql_num_rows(checkUserId($_SESSION['id'],"STUDENT"))==1) {
	// echo "<a href='register.php'>Register for Classes</a></br>";
   // $student = new Student($_SESSION['id']);
   // echo $student->getID();
  echo "You are the graduate secretary...<br>";
}
else { 
  echo "You are not the graduate secretary. Please use another page.";
  // delete($student);
  $gs = null;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml"> 
<head><title>Graduate Secretary</title>
</head>
<body>

<fieldset><legend>Search for Applicant by Lastname or M#</legend>
  <form action="GS_main.php" method="post">
    <label>Lastname</label>
    <input type="text" name="lastname" size="20" maxlength="20"/>
    </br> 
    
    <label>Student number</label>
    <input type="text" name="student_number" size="9" maxlength="9" />
    </br>
    
    <input type="submit" name="search" value="search"/>
    </form>
</fieldset>

</br>

<fieldset><legend>Applicant Search by Semester and Year</legend>

  <form action="GS_main.php" method="post">
    <lable>Select a semster</label>
    <select name="semester1">
    <option> Spring </option>
    <option> Summer </option>
    <option> Fall </option>
    </select>
    
    <label>and Year</label>
    <input type="text" name="expectedyear1" size="4" maxlength="4" />
    </br>

  <input type="submit"name="search1" value="search"/>
  </form>
</fieldset>
<br>

<fieldset><legend>Alumni Search by Semester and Year</legend>
  <form action="GS_main.php" method="post">
    <lable>Select a semster</label>
    <select name="semester3">
    <option> Spring </option>
    <option> Summer </option>
    <option> Fall </option>
    </select>

    <label>and Year</label>
    <input type="text" name="expectedyear3" size="4" maxlength="4" />
    </br>

    <input type="submit"name="search_alumni" value="Search Alumni"/>

    </br>
    </br>
  </form>
</fieldset>
<br>

<fieldset><legend>Prospective Graduate Search by Semester and Year</legend>
  <form action="GS_main.php" method="post">
    <lable>Select a semster</label>
    <select name="semester2">
    <option> Spring </option>
    <option> Summer </option>
    <option> Fall </option>
    </select>

    <label>and Year</label>
    <input type="text" name="expectedyear2" size="4" maxlength="4" />
    </br>

  <input type="submit"name="search_graduation" value="Search Graduation"/>
	<br>
  <input type = "submit" name="view_students" value="View Students By Admit Year" />
  </form>

  <?php
  if(isset($_POST['view_students'])) {
    $student_query = "SELECT `USERS`.*, STUDENT.*
    FROM STUDENT, USERS
    WHERE (`STUDENT`.`userID` = `USERS`.`userID`) ORDER BY STUDENT.admission_year";
    $student_result = mysql_query($student_query);
      echo "</br>";
      echo "</br>";
    while($student = mysql_fetch_array($student_result)) {
      echo "{$student['mNumber']}  |  {$student['Fname']}  |  {$student['Lname']}  |  {$student['admission_year']}";
      echo "</br>";
    }
  }
  ?>
</fieldset>
</br>

<?php
// $mnumber="0";
// $lastname="&";
//search for applicant by lastname or student mnumber
if(isset($_POST['search'])) {
	$mnumber=$_POST['student_number'];
	$lastname=$_POST['lastname'];
	echo'</br>';
	echo'</br>';
  $query_mnumber="SELECT DISTINCT `USERS`.`mNumber`, `USERS`.`Lname`, `USERS`.`Fname`, `USERS`.`userID` FROM USERS,APPLICANT WHERE ((`USERS`.`mNumber` = '".$mnumber."') AND (`APPLICANT`.`applicantID` = `USERS`.`userID`)) ORDER BY `USERS`.`mNumber` ASC, `USERS`.`Lname` ASC";
  // $query_lname="SELECT DISTINCT `USERS`.`mNumber`, `USERS`.`Lname`, `USERS`.`Fname`, `USERS`.`userID` FROM USERS,APPLICANT WHERE ((`USERS`.`Lname` = '".$lastname."') AND (`APPLICANT`.`applicantID` = `USERS`.`userID`)) ORDER BY `USERS`.`mNumber` ASC, `USERS`.`Lname` ASC";
  $query_lname="SELECT `USERS`.`mNumber`, `USERS`.`Lname`, `USERS`.`Fname`, `USERS`.`userID` FROM USERS,APPLICANT WHERE ((`USERS`.`Lname` = '".$lastname."') AND (`APPLICANT`.`applicantID` = `USERS`.`userID`)) ORDER BY `USERS`.`mNumber` ASC, `USERS`.`Lname` ASC";
  //echo"SELECT `USERS`.`Fname`, `USERS`.`Lname`, `USERS`.`mNumber` FROM USERS,APPLICANT WHERE ((`USERS`.`Lname` ='".$lastname."') OR (`USERS`.`mNumber` ='".$mnumber."'))";
  if($lastname!="") {
    $applicant_result=mysql_query($query_lname);
    $row=mysql_fetch_array($applicant_result);
    do {
      $query_student="SELECT * FROM 'STUDENT' WHERE 'STUDENT'.'userID' = '{$row['userID']}';";
      $student_result=mysql_query($query_student);
      if(empty($student_result)) {
        echo $row['Fname'];
        echo" | ";
        echo $row['Lname'];
        echo" | ";
        echo $row['mNumber'];
        echo'</br>';
        $row=mysql_fetch_array($applicant_result);
      }
      else {
        echo "The student with last name '{$row['Lname']}' and first name '{$row['Fname']}' is already a student.<br>";
      }
    } while ($row=mysql_fetch_array($applicant_result));
	}
	else if($mnumber!="")	{
  	$applicant_result=mysql_query($query_mnumber);
  	$row=mysql_fetch_array($applicant_result);
    do {
      $query_student="SELECT * FROM 'STUDENT' WHERE 'STUDENT'.'userID' = '{$row['userID']}';";
      $student_result=mysql_query($query_student);
      if(empty($student_result)) {
        echo $row['Fname'];
        echo" | ";
        echo $row['Lname'];
        echo" | ";
        echo $row['mNumber'];
        echo'</br>';
        $row=mysql_fetch_array($applicant_result);
      }
      else {
        echo "The student with last name '{$row['Lname']}' and first name '{$row['Fname']}' is already a student.<br>";
      }
    } while ($row=mysql_fetch_array($applicant_result));
	}			
}
//search for applicant by semester and year	
else if(isset($_POST['search1'])) {     
	$semester=$_POST['semester1'];
	$year=$_POST['expectedyear1'];
	echo'</br>';
	echo'</br>';
$query="SELECT DISTINCT USERS.userID, USERS.* FROM APPLICANT,APPLICATION,USERS WHERE ((`APPLICATION`.`admission_year`='".$year."' ) AND (`APPLICATION`.`admission_sem`='".$semester."'))";
		//echo $query;
		echo '</br>';
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result))
		{
		echo'</br>';
		echo $row['Fname'];
		echo" ";
		echo $row['Lname'];

		echo'</br>';
		}
}
else if(isset($_POST['search_graduation'])) {     
		$semester=$_POST['semester2'];
		$year=$_POST['expectedyear2'];
		echo'</br>';
		echo'</br>';
		$query="SELECT USERS.* FROM STUDENT,USERS where STUDENT.mNumber=USERS.mNumber AND STUDENT.cleared_gradn=1 AND STUDENT.admission_year= '".$year."' AND STUDENT.admission_sem='".$semester."'";
		//echo $query;
		echo '</br>';
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result))
		{
		echo'</br>';
		echo $row['Fname'];
		echo" ";
		echo $row['Lname'];

		echo'</br>';
		}
}
else if(isset($_POST['search_alumni'])) {     
  $semester=$_POST['semester3'];
	$year=$_POST['expectedyear3'];
	echo'</br>';
	echo'</br>';
$query="SELECT  `ALUMNI`.`alumniID`, `USERS`.*,`ALUMNI`.`sems_grad`,`ALUMNI`.`grad_year`,`USERS`.`Email` FROM ALUMNI, USERS WHERE ((`ALUMNI`.`alumniID` = `USERS`.`userID`) AND (`ALUMNI`.`sems_grad`='".$semester."' ) AND (`ALUMNI`.`grad_year`='".$year."'))";
		//echo $query;
		echo '</br>';
		$result=mysql_query($query);
		while($row=mysql_fetch_array($result))
		{
		echo'</br>';
		echo $row['Fname'];
		echo" | ";
		echo $row['Lname'];
		echo" | ";
		echo $row['sems_grad'];
		echo" | ";
		echo $row['grad_year'];
		echo" | ";
		echo $row['Email'];

		echo'</br>';
		}
}
?>

<br>
<fieldset><legend>View Students Transcript</legend>
  <form action="GS_main.php" method="post">
    <input type="text"name="search_mnumber" size="9" maxlength="9" />
    <input type="submit"name="view_transcript" value="View Transcript"/>
  </form>

  <?php
  if(isset($_POST['view_transcript'])) {
  ?>

  <table border="1" cellspacing="3" cellpadding="5">
    <tr><th>Course Number</th>
      <th>Course Section</th>
      <th>Semester</th>
      <th>Year</th>
      <th>Grade</th></tr>
  <?php
  echo "<h3>Unofficial Transcript for {$_POST['search_mnumber']}</h3>";
  $classes_query = "SELECT DISTINCT `ENROLL`.`sectID`,`STUDENT`.`mNumber`, `ENROLL`.`mNumber`, `STUDENT`.`userID`, `SECTIONS`.`sectID`, `STUDENT`.*, `ENROLL`.*,`SECTIONS`.*
  FROM STUDENT, ENROLL, SECTIONS
  WHERE ((`STUDENT`.`mNumber` = `ENROLL`.`mNumber`) AND (`STUDENT`.`mNumber` = '".$_POST['search_mnumber']."')  AND (`SECTIONS`.`sectID` = `ENROLL`.`sectID`))";
  $result=mysql_query($classes_query);
  while($row=mysql_fetch_array($result)) {
    echo "<tr><td>{$row['courseNumber']}</td>";
    echo "<td>{$row['sectNumber']}</td>";
    echo "<td>{$row['semester']}</td>";
    echo "<td>{$row['year_offered']}</td>";
    echo "<td>{$row['grade']}</td></tr>";
    $gpa = $row['gpa'];
  }

  ?>
  </table>
  </br>
  GPA: <?= $gpa ?>
</fieldset>
<br>
<?php
}
?>

<fieldset><legend>Clear For Graduation</legend>
  <table border="1" cellspacing="3" cellpadding="5">
    <tr><th>Student Number</th></tr>
    <?php
    //'".$_POST['search_mnumber']."'    (`STUDENT`.`mNumber` = ) AND 
    echo "<h3>Applied for Graduation:</h3>";
    $classes_query = "SELECT `STUDENT`.*
    FROM STUDENT
    WHERE ((`STUDENT`.`applied_gradn` = TRUE) AND (`STUDENT`.`cleared_gradn` = FALSE))";
    $result=mysql_query($classes_query);
    while($row=mysql_fetch_array($result)) {
      echo "<tr><td>{$row['mNumber']}</td></tr>";
    }
    if(isset($_POST['submit_clear'])) {
      $clear_graduation = "UPDATE STUDENT SET cleared_gradn=TRUE WHERE mNumber='".$_POST['clear_gradn']."'";
      mysql_query($clear_graduation);
    }
    ?>
  </table>
  <br>
  <form action="GS_main.php" method="post">
    <input type="text"name="clear_gradn" size="9" maxlength="9" />
    <input type="submit"name="submit_clear" value="Clear for Graduation"/>
  </form>
</fieldset>
</br>

<fieldset><legend>Update Application Status</legend>
  <form action="GS_main.php" method="post">
    <input type="text" name="app_letters" value="M_Number" size="9" maxlength="9" />
    How many letters received?
    <input type="radio"name="letter" value="letter0"/><label>0</label>
    <input type="radio"name="letter" value="letter1"/><label>1</label>
    <input type="radio"name="letter" value="letter2"/><label>2</label>
    <input type="radio"name="letter" value="letter3"/><label>3</label>
    Transcript received?
    <input type="checkbox"name="transcript" value="transcript"/><label>Transcript</label>
    <input type="submit"name="update_ltrs" value="Update Letters"/>
  </form>
</fieldset>

<?php
if(isset($_POST['update_ltrs'])) {
  $query_app = "SELECT USERS.* FROM USERS,APPLICATION WHERE ((USERS.userID = APPLICATION.applicantID) AND (USERS.mNumber='".$_POST['app_letters']."'))";
  $query_rez = mysql_query($query_app);
  $resultz = mysql_fetch_array($query_rez);

	if($_POST['letter']=="letter1") {
		$clear_app = "UPDATE APPLICATION SET letters_rcvd=1 WHERE applicantID='".$resultz['userID']."'";
		mysql_query($clear_app);
	}
	if($_POST['letter']=="letter2") {
		$clear_app = "UPDATE APPLICATION SET letters_rcvd=2 WHERE applicantID='".$resultz['userID']."'";
		mysql_query($clear_app);
	}
	if($_POST['letter']=="letter3") {
		$clear_app = "UPDATE APPLICATION SET letters_rcvd=3,complete=TRUE WHERE applicantID='".$resultz['userID']."'";
		mysql_query($clear_app);
	}
	if($_POST['transcript']=="transcript") {
		$clear_app = "UPDATE APPLICATION SET transcript_rcvd=TRUE WHERE applicantID='".$resultz['userID']."'";
		mysql_query($clear_app);
	}
	//$clear_graduation = "UPDATE STUDENT SET cleared_gradn=TRUE WHERE mNumber='".$_POST['clear_gradn']."'";
	//mysql_query($clear_graduation);
}
?>

<br>
<form action="GS_main.php" method="post">
<label>MNumber</label>
<input type="text" name="matri_mNumber" size="9" maxlength="9" />
<lable>Select admission semster</label>
  <select name="admission_semester">
  <option>Spring</option>
  <option>Summer</option>
  <option>Fall</option>
  </select>
<label>and Year</label>
  <input type="text" name="admission_year" size="4" maxlength="4" />
<input type="submit" name="matriculate" value="Matriculate Applicant"/>
</form>
<br>

<?php
if(isset($_POST['matriculate'])) {
	$sel_quer = "SELECT applicantID, APPLICANT.*, USERS.* FROM APPLICANT,USERS WHERE (USERS.mNumber='{$_POST['matri_mNumber']}' AND USERS.userID=APPLICANT.applicantID)";
	$rezQ = mysql_query($sel_quer);
	$rowRez = mysql_fetch_array($rezQ);
	$queryone = "UPDATE APPLICANT SET matriculated=TRUE WHERE applicantID={$rowRez['applicantID']}";
	mysql_query($queryone);
  //also need to insert applicant into student table
  $insert_student_query = "INSERT INTO STUDENT (userID, mNumber, gpa, admission_year, admission_sem, graduated, applied_gradn, cleared_gradn, advisorID) VALUES
    ({$rowRex['userID']},{$rowRex['mNumber']},0,{$_POST['admission_semester']},{$_POST['admission_year']},'false','false','false',NULL);";
  mysql_query($insert_student_query);
}
?>

	</body>
</html>

<?php

include("footer.php");
?>
