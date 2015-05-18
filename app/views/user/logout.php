<?php

    header("refresh:1;");
	if(!isset($_SESSION["username"])): ?>
	<h4> You have successfully logged out.</h4>
	<a href="<?php eh(url('user/login')); ?>">Go back to login page.</a>


<?php endif ?>
