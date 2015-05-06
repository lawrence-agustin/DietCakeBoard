<html>
<head>
<title>Login Form</title>
</head>
<body>
	<h2><?php //eh($a);?></h2>
	<form method="post" ?>
		User Id: <input type="text" name="uid"><br>
		Password: <input type="password" name="pw"><br>
		<label>New user? Register <a href=<?php eh(url('user/registration'))?> >here</a></label>
		<input type="submit" value="Login">
	</form>
</body>
</html>