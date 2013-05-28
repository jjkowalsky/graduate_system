<?php
session_start();
ob_start();
?>

<html xmlns="http://www.w3.org/1999/xhtml"> 
<head><title> Login </title>
	<body>
		<h1>MTSU Graduate Student Administration and Enrollment System</h1>
		<h3>Please login to begin.  New Graduate Applicants may apply <a href="/projects/mtsu_grad/application.php">here</a>.</h3>
		<form name="input" action="public.php" method="post">

			<label>Username</label>
		  <input type="text" name="username" size="10" maxlength="10"/>
		    
		  <br/> 
		  <label>Password</label>
		  <input type="password" name="password" size="8" maxlength="8" />
		  <input type="submit" name="login" value="login" />
		      
		  </form> 
		  <br>
		<form>
		<input type='submit' name='show_users' value="Show Users">
		<input type='submit' name='hide_users' value="Hide Users">
		</form>

<?php
include("include.php");
include("user.class.php");

if (isset($_GET['show_users'])) {
	$query="SELECT * FROM USERS";
	$result= mysql_query($query) or die ("No result");
	$users_row = mysql_fetch_array($result);
	while ($users_row)
	{
		echo "<ul>";
		echo "<li>{$users_row['username']} {$users_row['Password']}</li>";
		echo "</ul>";
		$users_row = mysql_fetch_array($result);
	}
}

if (isset($_POST['login'])) {
	$username = isset($_POST['username']) ? $_POST['username'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';

	$next_query="SELECT * FROM USERS WHERE username='".$username."' AND Password='".$password."'";
	$result= mysql_query($next_query); 
	// $row_result = mysql_fetch_array($result);

	if(!empty($result))
	// if(mysql_num_rows($result)==1)
	{
		$row_result = mysql_fetch_array($result);
		$_SESSION['id'] = $row_result['userID'];
		$_SESSION['username'] = $row_result['username'];
		$_SESSION['logged_in'] = true;
		$user_id=$_SESSION['id'];
		echo "Your Credentials have been verified";
		echo "<p>{$row_result['username']} {$row_result['Password']}</p>";
		echo "<p>Transferring you to your home page...</p>";
		if(mysql_num_rows(checkUserId($user_id,"CHAIR"))==1) {
			header("Location: review.php");
		}
		elseif (mysql_num_rows(checkUserId($user_id,"FACULTY"))==1) {
			header("Location: faculty_main.php");
		}
		elseif (mysql_num_rows(checkUserId($user_id,"STUDENT"))==1) {
			header("Location: student_main.php");
		}
		elseif (mysql_num_rows(checkUserId($user_id,"GRAD_SECT"))==1) {
			header("Location: GS_main.php");
		}
		elseif (mysql_num_rows(checkUserId($user_id,"APPLICANT"))==1) {
			header("Location: applicant_main.php");
		}
		elseif (mysql_num_rows(checkUserId($user_id,"ALUMNI"))==1) {
			header("Location: alumni_main.php");
		}
		else {
			echo "Hello problem</br>";
			header("Location: public.php");
		}

	}
	else {
		echo "Credentials not verified!";
	}
}//end if login
?>
</body>
</html>

	<?php
ob_flush();
?>

