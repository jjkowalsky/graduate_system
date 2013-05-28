<?php include'header.php';

     echo '<ul id="user_list">';
     $user_query = $db->query("SELECT * FROM EMPLOYEE");
     while($user = $db->fetch_assoc($user_query))
     {
          echo '<li>
                        <h3>SSN: '.($user['Ssn']).'</h3>
                        <p>Salary: '.$user['Salary'].'</p>
                  </li>';
     }

include'footer.php';
?>
