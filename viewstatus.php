<?php
/*$query_application = "SELECT APPLICATION.applicationID FROM APPLICATION WHERE applicantID=".$applicant_id."";
	$next_application = mysql_query($query_application);
	*/
include("header.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}

include("include.php");
$applicantid=$_SESSION['id'];
echo'</br>';
echo'</br>';
$query="SELECT accepted FROM APPLICANT where applicationID=".$applicantid."";
$row=mysql_query($query);
if($row['accepted']==0)
{
	echo "We regret to inform you that your a loser and you can't come here";
}
else{
	echo $row;
	echo'</br>';	
	echo"If your reading this your query didn't work and you suck at life";
	}
?>
