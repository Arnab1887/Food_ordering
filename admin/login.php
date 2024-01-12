<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/logincss.css">
</head>
<body>
	<div class="login-box">
		<h1>Log in</h1>
		<form action="helperLogin.php" method="POST">
			<p>Email</p>
			<input type="text" name="email" placeholder="Enter Email ID">
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password">
			<input type="submit" name="login" value="Log In">
		</form>
		<button><a href="signup.php">Create New Account</a></button>
	</div>
</body>
</html>