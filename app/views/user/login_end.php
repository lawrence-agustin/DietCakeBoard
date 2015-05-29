

<?php if($_SESSION["alreadyLoggedIn"] == true): ?>
<p class="alert alert-success">
	<?php echo ucfirst($_SESSION["username"]);?>, you are already logged-in.
</p> 
<a href="<?php eh(url('thread/index')); ?>"> &larr; Proceed to thread list.</a> <br>

<?php else: ?>
<p class="alert alert-success">
    Thank you, <?php echo ucfirst($_SESSION["username"]);?>. <br>You have successfully logged in.
</p> 
<a href="<?php eh(url('thread/index')); ?>"> &larr; Proceed to thread list.</a> <br>
<? endif ?>


