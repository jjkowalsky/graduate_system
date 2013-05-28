<?php
include("header.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}
?>
<pre>
ADD/DROP ALL USERS
ADD/DROP ALL COURSES AND SECTIONS

VIEW STUDENT DATA
VIEW APPLICANT DATA
UPDATE APPLICANT STATUS
MATRICULATE STUDENT
CLEAR STUDENT FOR GRADUATION
</pre>

<?php
include("footer.php");
?>
