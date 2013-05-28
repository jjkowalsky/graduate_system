<?php
include("header.php");
include("calculateGPA.php");
include("student.class.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}

$student = new Student($_SESSION['id']);

if (mysql_num_rows($student->checkUserId($_SESSION['id'],"STUDENT"))==1) {
// if (mysql_num_rows(checkUserId($_SESSION['id'],"STUDENT"))==1) {
	echo "<a href='register.php'>Register for Classes</a></br>";
   // $student = new Student($_SESSION['id']);
   // echo $student->getID();
   echo '<form action="student_main.php" method="post">
           <input type="submit" name="view_transcript" value="View Transcript"/>
           <input type="submit" name="close_transcript" value="Close Transcript"/>
           <input type="submit" name="update_info" value="Update Personal Info"/>
         </form>';
}
else { 
   echo "You are not a student. Please use another page.";
   // delete($student);
      $student = null;
}
?>

<!-- <form action="student_main.php" method="post">
<input type="submit" name="view_transcript" value="View Transcript"/>
<input type="submit" name="close_transcript" value="Close Transcript"/>
<input type="submit" name="update_info" value="Update Personal Info"/>
</form> -->

<?php
if(isset($_POST['view_transcript'])) {
   $student->view_transcript();
?>

<form action="student_main.php" method="post">
<input type="submit"name="apply_gradn" value="Apply for Graduation"/>
</form>

<?php
}//end if view_transcript
else if(isset($_POST['apply_gradn'])) {
   //apply for graduation
   echo "<p id='apply_gradn'>
            Checking to see if you can graduate...</br>";

   $cleared = $student->apply_graduation();
   if (!$cleared) {
      echo "You are not cleared for graduation. Please check that you have met the requirements.</p>";
   }
   else {
      echo "Congratulations! You are cleared for graduation.</p>";
   }//end cleared for graduation
}//end if apply_gradn
else if(isset($_POST['update_info'])) {
   $user_result = $student->getStudent();
   if (empty($user_result)) {
      echo "<p>Student is not a registered user. Please fill out an application or contact the Graduate Secretarty.</p><br>";
   }
   else {
      $user_row = mysql_fetch_array($user_result);
      $student->display_user_form($user_row);	
   }
}//end elseif update_info   

//process user's changes and update student info in user table
if(isset($_POST['submit_update'])) {
   $user_update = "UPDATE `users` 
   SET `userID`='{$_SESSION['id']}', `mNumber`='{$_POST['studentnumber']}',`Ssn`='{$_POST['SSN']}',
   `Password`='{$_POST['password']}',`BDate`='{$_POST['birthdate']}',`Sex`='{$_POST['gender']}',
   `Fname`='{$_POST['firstname']}',`Minit`='{$_POST['minit']}',`Lname`='{$_POST['lastname']}',
   `Address`='{$_POST['address']}',`Phone_Home`='{$_POST['phone_home']}',`Phone_Cell`='{$_POST['phone_cell']}',
   `Email`='{$_POST['email']}',`username`='{$_POST['username']}' WHERE `userID`='{$_SESSION['id']}';";

   echo $user_result = mysql_query($user_update) ? "Update successful...<br>" : "Update not successful...<br>";
}
else { 
   // echo "You didn't submit the updates yet?"; 
}
?>

<?php include("footer.php"); 
?>
