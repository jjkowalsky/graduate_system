<?php
include("header.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}
?>

<html xmlns = "http://www.w3.org/1999/xhtml"> 
<head><title> Application Review </title>
Application Review
</br>
</br>
</head>
<!-- query the database to display the results-->
</html>

<table border="1" cellspacing="3" cellpadding="5">
	<tr><th>First Name</th>
		<th>Middle Initial</th>
		<th>Last Name</th>
		<th>M#</th></tr>
<?php

//$applicantid=$_SESSION['id'];
echo "<h3>Listing Applicants in Need of Review</h3>";
$application_query="SELECT DISTINCT USERS.userID, USERS.Fname, USERS.Minit, USERS.Lname, USERS.mNumber FROM APPLICATION,USERS where APPLICATION.Review_Status=FALSE and APPLICATION.applicantID = USERS.userID";
$application=mysql_query($application_query);
while($row=mysql_fetch_array($application)) {
	echo "<tr><td>{$row['Fname']}</td>";
	echo "<td>{$row['Minit']}</td>";
	echo "<td>{$row['Lname']}</td>";
	echo "<td>{$row['mNumber']}</td></tr>";
}
?>
</table>
</br>

<?php
echo"***************************************************</br>";
echo"Enter the name of the user you would like to review ";
echo"</br>";
echo"</br>";
?>

<form action="review.php" method="post">
M#
<input type="text" name="mnumber" size="9" maxlength="9"/>
</br>
or
</br>
Last Name
<input type="text" name="lname" size="15" maxlength="20"/>
<input type="submit" name="view_review" value="View Review Form"/>
<input type="submit" name="close_review" value="Close Review Form"/>
</form>

<?php
$lastname=$_POST['lname'];
$mnumber=$_POST['mnumber'];
$applicant_query="SELECT DISTINCT USERS.userID, USERS.*, APPLICATION.*, LETTER.* FROM USERS,APPLICATION,LETTER where ((USERS.userID = APPLICATION.applicantID) AND (USERS.userID = LETTER.applicantID) AND (USERS.Lname = '".$_POST['lname']."' OR USERS.mNumber = '".$_POST['mnumber']."'))";
$applicant=mysql_query($applicant_query);
$row=mysql_fetch_array($applicant);

//if($_POST['view_review']) {
?>
<p>
<h4>Graduate Admission Review Form: </h4>
<b>NAME:</b>   <?= $row['Fname']?>  <?= $row['Lname']?>
</br>
<b>Student Number:</b>   <?= $row['mNumber']?>
</br>
<b>Semester and Year of Application:</b>   <?= $row['admission_sem']?> <?= $row['admission_year']?>
</br>
<b>Summary of Applicant Credentials:</b> 
</br>
<b>GRE: Total score:</b> <?= $row['Total_GRE']?>  <b>Verbal</b> <?= $row['Verbal_GRE']?>   <b>Analytical</b> <?= $row['Analytical_GRE']?>   <b>Quantitative</b> <?= $row['Quantitative_GRE']?>
</br>
<b>Date of GRE Exam:</b> May 2010
</br>
<b>GRE Advanced Score: Subject</b> <?= $row['Subject_GRE']?>
</br>
<b>Prior Degrees:</b> 
</br>
<?= $row['Prior_Degree']?> 
</br>
<b>GPA:</b> <?= $row['Degree_GPA']?>   <b>Year:</b> <?= $row['Degree_Year']?>   <b>University:</b> <?= $row['Degree_College']?>
</br>
<b>Areas of Interest:</b> </br>
<?= $row['area_interest']?>
</br>
<b>Experience:</b> 
<?= $row['prior_work']?>
</br>
</p>

<form action="review.php" method="post">
 </br>
   <p> 
Recommendation Letters: (Worst =1, Best = 5) 
  </br> 
1. Rating:
<label> 
   <input type=  "text" name="rating1" size="10" maxlength="10"/>
   </label>
<input type="radio" name="generic1" value="Generic">Generic
<input type="radio" name="credible1" value="Credible">Credible
  From: <?= $row['affiliation']?>
   </br> 
<?php
$row=mysql_fetch_array($applicant);
?>
2. Rating:
<label> 
   <input type=  "text" name="rating2" size="10" maxlength="10"/>
   </label>
<input type="radio" name="generic2" value="Generic">Generic
<input type="radio" name="credible2" value="Credible">Credible
  From: <?= $row['affiliation']?>
   </br> 
<?php
$row=mysql_fetch_array($applicant);
?>
3. Rating:
<label> 
   <input type=  "text" name="rating3" size="10" maxlength="10"/>
   </label>
<input type="radio" name="generic3" value="Generic">Generic
<input type="radio" name="credible3" value="Credible">Credible
  From: <?= $row['affiliation']?>
   </br> 
</br>
Final Decision: 
</br>

<input type="radio" name="option" value="accept">Accept
<input type="radio" name="option" value="reject">Reject
</br>
</br>
Reasons for Reject:
<label> 
   <input type=  "text" name="reason_reject" size="1" maxlength="1"/>
   </label>
</br>
(A= Incomplete Record, B=Does not meet minimum requirements, 
C=Unspecified Area of Interest, D=Problems with Recommendation Letters, 
E= Not competitive enough, F = other reason) 
</br>
</br>
GAS Reviewer Comments:
</br>
<label> 
   <textarea  name="comments" rows="3" cols="40" >
	Reviewer Comments
	</textarea>
   </label>
</br>
</br>
Recommended Advisors: 
</br>
1.
<label> 
   <input type=  "text" name="advisors1" size="20" maxlength="20"/>
   </label> 
</br>
2. 
<label> 
   <input type=  "text" name="advisors2" size="20" maxlength="20"/>
   </label>
</br>
</br>
<input type="submit" name="decision" value="submit"/>
</p>
</form>
</br>

<?php
//echo $row['userID'];
$applicant_query="SELECT DISTINCT USERS.userID, USERS.*, APPLICATION.*, LETTER.* FROM USERS,APPLICATION,LETTER where ((USERS.userID = APPLICATION.applicantID) AND (USERS.userID = LETTER.applicantID) AND (USERS.Lname = '".$lastname."' OR USERS.mNumber = '".$mnumber."'))";
$applicant=mysql_query($applicant_query);
$row=mysql_fetch_array($applicant);
//echo $row['userID'];
$_SESSION['userIDD'] = $row['userID'];
//echo $_SESSION['userIDD'];
//if($_POST['decision']) {
	if($_POST['option']=="accept")
	{	$applicant_query="SELECT DISTINCT USERS.userID, USERS.*, APPLICATION.*, LETTER.* FROM USERS,APPLICATION,LETTER where ((USERS.userID = APPLICATION.applicantID) AND (USERS.userID = LETTER.applicantID) AND (USERS.Lname = '".$lastname."' OR USERS.mNumber = '".$mnumber."'))";
		$applicant=mysql_query($applicant_query);
		$rowz=mysql_fetch_array($applicant);
		$newID = $rowz['userID'];	
		$queryone = "UPDATE APPLICANT SET APPLICATION.accepted=TRUE WHERE APPLICATION.applicantID=74";
		//$app="UPDATE `APPLICANT` SET `APPLICANT`.'accepted'=true WHERE  `APPLICANT``applicantID` =55";
		//"UPDATE APPLICANT SET APPLICANT.accepted=TRUE WHERE APPLICANT.applicantID={$newID}")
		//"UPDATE APPLICANT SET APPLICANT.accepted=FALSE WHERE APPLICANT.applicantID = ".$_SESSION['userIDD']."";
		mysql_query($queryone);
		$update_reviewed="UPDATE APPLICATION set APPLICATION.Review_Status=TRUE WHERE APPLICATION.applicantID = 74";
		//{$newID}
		mysql_query($update_reviewed);
	}
	else if ($_POST['option']=="reject") {		
		//$update_rejected="UPDATE APPLICANT set APPLICANT.accepted = FALSE WHERE APPLICANT.applicantID = ".$rowz['userID']."";
		$update_rejected="UPDATE APPLICANT set APPLICANT.accepted = FALSE WHERE APPLICANT.applicantID = 74";
		mysql_query($update_rejected);
		//$update_reviewed="UPDATE APPLICATION set APPLICATION.Review_Status = TRUE WHERE APPLICATION.applicantID = ".$rowz['userID']."";
		$update_reviewed="UPDATE APPLICATION set APPLICATION.Review_Status = TRUE WHERE APPLICATION.applicantID = 74";
		mysql_query($update_reviewed);
	}
	
//}//end if decision
//}//end view review

?>
</br>


<?php
include("footer.php");
?>

