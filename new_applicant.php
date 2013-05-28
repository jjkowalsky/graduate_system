<?php
include("header.php");

?>
<pre>
CREATE ACCOUNT, ON APPLICATION PAGE
FILL OUT APPLICATION



</pre>

<form action="new_applicant.php" method="post">
 </br>
   <p> 
Firstname
<label> 
   <input type=  "text" name="firstname" size="20" maxlength="20"/>
   </label> 
    
   <label>
M.I.
<label> 
   <input type=  "text" name="M.I." size="1" maxlength="1"/>
   </label> 
    
   <label>


Lastname 
   <input type = "text" name="lastname" size="20" maxlength="20" />
   </label>  
</br> 
</br>
<label> 
Social Security #

   <input type=  "password" name="SSN" size="9" maxlength="9"/>
   </label> 
    
 
 
 
Student # 
   <input type = "text" name="studentnumber" size="14" maxlength="14" />
   </label>  
</br>
</br>
Address
<label> 
   <input type=  "text" name="street" size="20" maxlength="30"/>
   </label> 
    
   <label>
City
<label> 
   <input type=  "text" name="city" size="15" maxlength="30"/>
   </label> 
    
   <label>


State
   <input type = "text" name="state" size="2" maxlength="2" />
   </label>
 
Zipcode

   <input type = "text" name="zipcode" size="9" maxlength="9" />
   </label> 
</br>
</br>
 
 Telephone
     <input type=  "text" name="areacode" size="3" maxlength="3"/>
   </label> 
    
 
   <input type = "text" name="phone" size="10" maxlength="10" />
 
 
   <input type = "text" name="phone2" size="10" maxlength="10" />
  
Email
<label> 
   <input type=  "email" name="email" size="15" maxlength="30"/>
   </label> 
</br>
</br> 
Username
<label> 
   <input type=  "text" name="username" size="10" maxlength="10"/>
   </label> 
   </br> 
   <label>
Password 
   <input type = "password" name="password" size="8" maxlength="8" />
   </label>  
<br></br> 
   <input type = "submit" value="submit" />
</p> 
   </form> 



<?php
include("footer.php");
?>
