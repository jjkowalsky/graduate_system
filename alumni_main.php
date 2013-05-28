<?php
include("header.php");
if (!$_SESSION['logged_in']) {
	header("Location: public.php");
}
?>
<pre>
VIEW TRANSCRIPT
EDIT PERSONAL INFO
</pre>

<?php
include("footer.php");
?>
