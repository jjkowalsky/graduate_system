<?php
include("header.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html xmlns = "http://www.w3.org/1999/xhtml">
<head><title>ANOTHER BUTTWEASEL!!!</title></head>
<?php
include("include.php");
$dbhandle = mysql_connect($dbhost,$dbuser,$dbpass) or die ("Couldn't connect to SQL Server on $dbname");
$applicantid=$_SESSION['id'];
mysql_select_db($dbname);
$query="SELECT * FROM STUDENT,USERS where USERS.userID='".$applicantid."'";
$result= mysql_query($query) or die (mysql_error()); 
$id=$applicantid;





echo'</br>';
echo'</br>';
while( $row=mysql_fetch_array($result))
{

$name=$row['Fname'];
$lname=$row['Lname'];
}




echo'<form action="register.php" method="post">';
echo'Choose a semster';
echo'<select name="semster">';
echo'<option value="1"> Spring 2013 </option>';
echo'<option value="2"> Summer 2013 </option>';
echo'<option value="3"> Fall 2013 </option>';
echo'</select>';
echo'<input type="submit" value="view">';
echo'</form>'; 
if($_POST['semster']=="1")
	{
	echo"CSCI 5360 Intelligent Robot Systems   \n";
	echo" ";
	echo"\n";
	echo'</br>';	
	echo"CSCI 5410 Web Technologies   \n";
	echo'</br>';
	echo"CSCI 5600 Indepedent Study \n";
	echo'</br>';
	echo"CSCI 5700 Software Engineering\n";
	echo'</br>';
	echo"CSCI 6050 Computer Systems Fundamentals\n";
	echo'</br>';
	echo"CSCI 6430 Selected Topics in Parallel Processing: Design of Parallel Software\n";
	echo'</br>';
	echo"CSCI 6450 Operating System Design\n";
	echo'</br>';
	echo"CSCI 6560 Selected Topics in Database";
	echo'</br>';
	echo"CSCI 6620 Research Methods in Computer Science\n";
	}
else if($_POST['semster']=="2")
	{
	echo"CSCI 5900 Selected Topics Computer Science: 3D Games in Virtual Worlds";
	echo'</br>';
	echo"CSCI 6600 Selected Topics in Computer Science: Game Engine Architecture";
	}
else if($_POST['semster']=="3")
	{
	echo"CSCI 5250 Computer Graphics\n";
	echo'</br>';
	echo"CSCI 5300 Data Communication and Networks\n";
	echo'</br>';
	echo"CSCI 5350 Introduction to Artificial Intelligence\n";
	echo'</br>';
	echo"CSCI 5560 Database Management Systems\n";
	echo'</br>';
	echo"CSCI 5700 Software Engineering\n";
	echo'</br>';
	echo"CSCI 6020 Data Abstraction and Programming Fundamentals\n";
	echo'</br>';
	echo"CSCI 6100 Analysis of Algorithms\n";
	echo'</br>';
	echo"CSCI 6180 Software Design and Development\n";
	echo'</br>';
	echo"CSCI 6250 Advanced Operating Systems\n";
	echo'</br>';
	echo"CSCI 6330 Parallel Processing Concepts\n";
	echo'</br>';
	echo"CSCI 6640 Thesis Research\n";
	echo'</br>';
	echo"CSCI 7300 Scientific Visualization & Databases\n";
	echo'</br>';
	}
echo'<style type="text/css">';
echo'td,th { border-left: solid 1px black;}';
echo'tr{border-bottom: solid 1px black;}';
echo'table{border-collapse: collapse;}';
echo'</style>';
echo'<table border=0>';
echo'<caption>Register for  Courses </caption>';
echo'<tr><th></th><th></th> <td></td><td></td></tr>';
echo'<tr>';
echo'<th> col1 </th>';
echo'<th> col2 </th>';
echo'<th></th>';
echo'<th></th>';
echo'</tr>';
echo'<tr>';
echo'<td>Name(Last,First) </td>';
echo'<td>'.$lname .'</td>';
echo'<td>'.$name.'</td>';
echo'<td></td>';
echo'</tr>';
echo'<tr>';
echo'<td>GW ID </td>';
echo'<td>'.$id .' </td>';
echo'<td></td>';
echo'<td></td>';
echo'</tr>';
echo'<tr>';
echo'<td>Courses </td>';
echo'<td>SectID </td>';
echo'<td>   </td>';
echo'<td></td>';
echo'<td></td>';
echo'</tr>';
echo'</table>';


echo '<form action="register.php" method="post">';

echo"1 ";
echo '<input type=  "text" name="course1" size="9" maxlength="9"/>';
echo '<input type= "text" name="sect1" size="2" maxlength="2"/>';
echo' </br>';

echo"2 ";
echo '<input type=  "text" name="course2" size="9" maxlength="9"/>';

echo '<input type= "text" name="sect2" size="2" maxlength="2"/>';
echo'</br>';
echo"3 ";
echo '<input type=  "text" name="course3" size="9" maxlength="9"/>';
echo '<input type= "text" name="sect3" size="2" maxlength="2"/>';
echo'</br>';
echo"4 ";
echo '<input type=  "text" name="course4" size="9" maxlength="9"/>';

echo '<input type= "text" name="sect4" size="2" maxlength="2"/>';

echo'</br>';
echo'<input type ="submit" name="submit1" value="submit">';
echo'</form>';


if($_POST['submit1']) {
	$sectID=$_POST['sect1'];
	$course=$_POST['course1'];
	echo'</br>';
	echo'</br>';
	/*$query="SELECT DISTINCT sectID,courseNumber FROM SECTIONS  WHERE SECTIONS.sectID = '".$sectID."' AND SECTIONS.courseNumber = '".$course."' ";
	*/
	$query="SELECT DISTINCT mNumber FROM STUDENT where STUDENT.userID='".$id."'";
	
	$result= mysql_query($query) or die (mysql_error()); 
	$mnumber=$result['mnumber'];
	
	while( $row=mysql_fetch_array($result))
	{
	$mnumber=$row['mNumber'];
	}
	$query="INSERT into ENROLL (mNumber,sectID,grade)  VALUES('".$mnumber."','".$sectID."','IP')";
	$result= mysql_query($query) or die (mysql_error()); 
	
}

?>

