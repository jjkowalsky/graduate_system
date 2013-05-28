<?php
include("header.php");
include("applicant.class.php");

if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}

$applicant = new Applicant($_SESSION['id']);

if (mysql_num_rows($applicant->checkUserId($_SESSION['id'],"APPLICANT"))==1) {
// if (mysql_num_rows(checkUserId($_SESSION['id'],"STUDENT"))==1) {
	// echo "<a href='register.php'>Register for Classes</a></br>";
   // $student = new Student($_SESSION['id']);
   // echo $student->getID();
  echo "You are an applicant...<br>";
}
else { 
  echo "You are not an applicant. Please use another page or apply <a href='/application.php'>here</a>.";
  // delete($student);
  $applicant = null;
}
?>

</br>
</br>
</br>

<?php


$status_result = $applicant->get_status();

$application_result = $applicant->get_application();

$letters_result = $applicant->get_letters();

$applicant_status = mysql_fetch_array($status_result);
$application = mysql_fetch_array($application_result);
$letters = mysql_fetch_array($application_result);

if($applicant_status) {
	
	if($applicant_status['accepted']==TRUE) {
		echo "Congratulations you have been admitted. The formal letter of acceptance will be mailed.</br>";
		if($applicant_status['matriculated']==TRUE) {
			echo "<p>You have been matriculated by the Graduate Secretary. Please click on the link below to begin your student journey with us!</p><br>";
			echo "<a id='student' href='/projects/mtsu_grad/student_main.php'>Student Main</a><br>";
			// header("Location: student_main.php");
		}
	}
	else if ($application['Review_Status']==TRUE){
		//application complete when all letters received and transcript received.
		echo "Application reviewed!</br>";
		echo "But you were not accepted.  Please review your requirements.";
		echo "Review your application and the department chairs' review below...";
		$applicant->print_application();
		echo "<br>";
		$applicant->print_letters();
		echo "<br>";
		$applicant->print_application_review();

	}
	else if ($application['Review_Status']==FALSE){
		if($application['complete']==TRUE){
			//application complete when all letters received and transcript received.
			echo "Application complete and under review!</br>";
		}
		else {
			echo "Application incomplete!</br>";
			echo "Letters received: {$application['letters_rcvd']} of 3</br>";
			if($application['transcript_rcvd']==FALSE){
				echo "Waiting on receipt of transcript!</br>";
			}
		}
	}
	else {
		echo "REJECTED!</br>";
	}
	
}

?>


<?php
include("footer.php");
?>
