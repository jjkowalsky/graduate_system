<?php
// include("header.php");
include("include.php");
?>

<html xmlns = "http://www.w3.org/1999/xhtml"> 
<head><title> Graduate Application </title>
</head>
<body>
  <h1>Graduate Application</h1>
  <p>Your Username and Password will be emailed to you after you submit your application.</p>
<form action="application.php" method="post">
  <fieldset><legend>User Information</legend>
    <label>Username</label>
    <input type="text" name="username" size="10" maxlength="10"/>
    </br> 

    <label>Password</label>
    <input type="password" name="password" size="8" maxlength="8" />
    Password will be provided when left blank.
    </br>

    <label>Firstname</label>
    <input type="text" name="firstname" size="20" maxlength="20"/>
      
    <label>M.I.</label> 
    <input type="text" name="M.I." size="1" maxlength="1"/>

    <label>Lastname</label>
    <input type="text" name="lastname" size="20" maxlength="20" />
    </br>
    </br>

    <label>Birth Date</label>
    <input type="text" name="birthdate" size="10" maxlength="10" />
       
    <label>Gender</label>
    <input type="text" name="gender" size="1" maxlength="1" />
    </br> 
    </br>

    <label>Social Security #</label>
    <input type="password" name="SSN" size="9" maxlength="9"/>
    
    <label>Student #</label>
    <input type="text" name="studentnumber" size="9" maxlength="9" />
    </br>

    <label>Address</label>
    <input type="text" name="street" size="20" maxlength="30"/>

    <label>City</label>
    <input type="text" name="city" size="15" maxlength="30"/>
      
    <label>State</label>
    <input type="text" name="state" size="2" maxlength="2" />
     
    <label>Zipcode</label> 
    <input type="text" name="zipcode" size="9" maxlength="9" />
    </br>
    </br>
   
    <label>Home Phone</label>
    <input type="text" name="phone_home" size="10" maxlength="10" />
    </br>
   
    <label>Cell Phone</label>
    <input type="text" name="phone_cell" size="10" maxlength="10" />
    </br>

    <label>Email</label>
    <input type="email" name="email" size="15" maxlength="30"/>
  </fieldset>
    </br>    

<fieldset><legend>School &amp; Work Experience</legend>

  <label>Previous Degree</label>
  <input type="text" name="degreename" size="15" maxlength="30"/>
    
  <label>Degree Year</label>
  <input type="text" name="degreeyear" size="4" maxlength="4" />
 
  <label>GPA</label>
  <input type="text" name="gpa" size="3" maxlength="3" />

  <label>University</label>
  <input type="text" name="schoolname" size="15" maxlength="30"/>
  </br>
  </br>

  GRE Scores
  </br> 
  <label>Verbal</label>
  <input type="number" name="verbal" size="4" maxlength="4"/>
    
  <label>Analytical</label>
  <input type="number" name="analytical" size="4" maxlength="4" />

  <label>Quantitative</label>
  <input type="number" name="quantitative" size="4" maxlength="4" />
  <br>
  </br>

  <label>Subject</label>
  <input type="number" name="subject" size="4" maxlength="4" />
  <br></br>
  
  <label>Total</label>
  <input type="number" name="total" size="4" maxlength="4" />
  </br>
  </br>

  <label>Prior Work Experience</label>
  </br>
  <textarea  name="priorwork" rows="3" cols="40" >
  Enter your prior work experience here.
  </textarea>
  </br>

  <label>Expected Graduation Date</label>
  <select name="semester">
  <option> Spring </option>
  <option> Summer </option>
  <option> Fall </option>
  </select>

  <label>Year</label>
  <input type="text" name="expectedyear" size="4" maxlength="4" />
  </br>
  </br>

  Application Date:&nbsp; 
  <?php
    $date_submitted = date(DATE_ATOM);
    echo $date_submitted;
  ?>
  </br>
  </br>
  
  <label>Area of Interest</label>
  <br>
  <textarea name="areaofinterest" rows="3" cols="40" >
  Area of Interest
  </textarea>
</fieldset>

  <br>

  <fieldset>
  <legend>Recommendation Letters</legend>
  <label>Name</label>
  <input type="text" name="letter1name" size="20" maxlength="40" />

  <label>Email</label>
  <input type="email" name="letter1email" size="20" maxlength="30"/>

  <label>Title</label>
  <input type="text" name="letter1title" size="20" maxlength="30"/>

  <label>Affiliation</label>
  <input type="text" name="letter1Affil" size="20" maxlength="30"/>
  <br></br>

  <label>Name</label>
  <input type="text" name="letter2name" size="20" maxlength="40" />

  <label>Email</label>
  <input type="email" name="letter2email" size="20" maxlength="30"/>

  <label>Title</label>
  <input type="text" name="letter2title" size="20" maxlength="30"/>

  <label>Affiliation</label>
  <input type="text" name="letter2Affil" size="20" maxlength="30"/>
  <br></br>

  <label>Name</label>
  <input type="text" name="letter3name" size="20" maxlength="40" />

  <label>Email</label>
  <input type="email" name="letter3email" size="20" maxlength="30"/>

  <label>Title</label>
  <input type="text" name="letter3title" size="20" maxlength="30"/>

  <label>Affiliation</label>
  <input type="text" name="letter3Affil" size="20" maxlength="30"/>
  <br>
  </fieldset>

  <br>
  <input type="submit" name="submit_app" value="submit" />

    </form> 
  </body>
</html> 

<?php
function generateRandomString($length = 10)
{
	return substr(str_shuffle("0123456789abcdefghijklomnpqrstuvwxyzABCDEFGHIJKLOMNPQRSTUVWXYZ"),0,$length);
}

if(isset($_POST['submit_app'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	if ($_POST['password']=="" || $_POST['password']==NULL) {
		//echo "password not valid";
		$password = generateRandomString();
	}

	$firstname=$_POST['firstname'];
	$minit=$_POST['M.I.'];
	$lastname=$_POST['lastname'];
	$SSN=$_POST['SSN'];
	$SEX=$_POST['gender'];
	$studentnumber=$_POST['studentnumber'];
	$street=$_POST['street'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zipcode=$_POST['zipcode'];
	$homephone=$_POST['phone_home'];
	$cellphone=$_POST['phone_cell'];
	$email=$_POST['email'];
	$degreename=$_POST['degreename'];
	$degreeyear=$_POST['degreeyear'];
	$gpa=$_POST['gpa'];
	$schoolname=$_POST['schoolname'];
	$verbal=$_POST['verbal'];
	$analytical=$_POST['analytical'];
	$quantitative=$_POST['quantitative'];
	$subject=$_POST['subject'];
	$total=$_POST['total'];
	$priorwork=$_POST['priorwork'];
	$semester=$_POST['semester'];
	$expectedyear=$_POST['expectedyear'];
	$areaofinterest=$_POST['areaofinterest'];
	// $date_submitted = date(DATE_ATOM);


	//insert new applicant into user table
	$user_insert = "INSERT INTO USERS (userId, mNumber, Ssn, Password, BDate, Sex, Fname, Minit, Lname, Address, Phone_Home, Phone_Cell, Email, username ) VALUES
	('','".$studentnumber."','".$SSN."','".$password."','".$_POST['birthdate']."','".$SEX."','".$firstname."','".$minit."','".$lastname."','".$street." ".$city.", ".$state." ".$zipcode."','".$homephone."','".$cellphone."','".$email."','".$username."');";
	mysql_query($user_insert);

	//set up query to get id of newly created applicant
	$query_applicant="SELECT USERS.userID FROM USERS WHERE Password='".$password."'";
	$new_applicant=mysql_query($query_applicant);
	$applicant=mysql_fetch_assoc($new_applicant); //get first new applicant
	$applicant_id=$applicant['userID'];
	$_SESSION['id']=$applicant_id;
	
	//set up query
	$application_insert="INSERT INTO APPLICATION (applicationID, applicantID, Date_Received, Prior_Degree, Degree_Year, Degree_GPA, Degree_College, Total_GRE, Verbal_GRE, Analytical_GRE, Quantitative_GRE, Subject_GRE, Review_Status, letters_rcvd, transcript_rcvd, complete, admission_year, admission_sem, prior_work, area_interest) VALUES 
	('',".$applicant_id.",'".$date_submitted."','".$degreename."','".$degreeyear."',".$gpa.",'".$schoolname."',".$total.",".$verbal.",".$analytical.",".$quantitative.",".$subject.",false,0,false,false,'".$expectedyear."','".$semester."','".$priorwork."','".$areaofinterest."');";
	//insert into application table
	mysql_query($application_insert);
	
	//get application id based on new applicant
	$query_application = "SELECT APPLICATION.applicationID FROM APPLICATION WHERE applicantID=".$applicant_id."";
	$next_application = mysql_query($query_application);
	$application = mysql_fetch_assoc($next_application); //get first new applicant

	$application_id = $application['applicationID'];
	//insert into applicant table
	$applicant_insert = "INSERT INTO APPLICANT (applicantID, applicationID, matriculated, accepted) VALUES 
	(".$applicant_id.",".$application_id.",false,false);";
	mysql_query($applicant_insert);
	
	//
	$letter_query="INSERT INTO LETTER (received, name, affiliation, title, email, rating, status, applicantID) VALUES 
	(FALSE,'".$_POST['letter1name']."','".$_POST['letter1Affil']."','".$_POST['letter1title']."','".$_POST['letter1email']."',0,'N','".$applicant_id."');";
	//insert letters into letter table
	mysql_query($letter_query);
	$letter_query="INSERT INTO LETTER (received, name, affiliation, title, email, rating, status, applicantID) VALUES 
	(FALSE,'".$_POST['letter2name']."','".$_POST['letter2Affil']."','".$_POST['letter2title']."','".$_POST['letter2email']."',0,'N','".$applicant_id."');";
	//insert letters into letter table
	mysql_query($letter_query);
	$letter_query="INSERT INTO LETTER (received, name, affiliation, title, email, rating, status, applicantID) VALUES 
	(FALSE,'".$_POST['letter3name']."','".$_POST['letter3Affil']."','".$_POST['letter3title']."','".$_POST['letter3email']."',0,'N','".$applicant_id."');";
	//insert letters into letter table
	mysql_query($letter_query);
	
	
	
	$to      = 'jjkowalsky@gmail.com';
	$subject = 'Username and Password from MTSU';
	$message = "Username and Password from MTSU
	{$username}
	{$password}";
	$headers = 'From: webmaster@mtsu.edu' . "\r\n" .
		'Reply-To: webmaster@mtsu.edu' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
	
	
	
	
	
	
	header("Location: applicant_main.php");
}




	
?>

<?php
include("footer.php");
?>
