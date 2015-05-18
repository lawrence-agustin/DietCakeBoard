<?php
	session_start();
	//$_SESSION["username"] = $_POST["username"];
?>

<p class="alert alert-success">
    Thank you, <?php echo ucfirst($_SESSION["username"]);?>. <br>You have successfully logged in.
</p> 
<a href="<?php eh(url('thread/index')); ?>"> &larr; Go to thread list.</a>

