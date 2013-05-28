<?php
include("header.php");
?>

<form action="list_users.php" method="post">
<input type="submit" name="list_users" value="List Users"></input>
<input type="submit" name="list_students" value="List Students"></input>
</form>

<?php
if(isset($_POST['list_users'])) {
  $query="SELECT * FROM USERS";
  $result= mysql_query($query) or die ("No result");
  // $users_row = mysql_fetch_array($result);

  echo "<ul>";
  while ($users_row = mysql_fetch_array($result))
  {
    echo "<li>{$users_row['username']} -- {$users_row['Password']}</li>";
  }
  echo "</ul>";
}
elseif (isset($_POST['list_students'])) {
  $query="SELECT * FROM STUDENT";
  $result= mysql_query($query) or die ("No result");
  // $students_row = mysql_fetch_array($result);

  echo "<ul>";
  while ($students_row = mysql_fetch_array($result))
  {
    echo "<li>{$students_row['userID']} -- {$students_row['mNumber']}</li>";
  }
  echo "</ul>";
}

?>