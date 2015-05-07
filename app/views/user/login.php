<html>
<head>
<title>Login Form</title>
</head>
<body>

	<form method="post" ?>
		User Id: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="uid"><br>
		Password: &nbsp;<input type="password" name="pw"><br>
		<label>New user? Register <a href=<?php eh(url('user/registration'))?> >here</a></label>
		<input type="submit" value="Login">
	</form>
</body>
</html>