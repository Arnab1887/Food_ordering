<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="css/signupcss.css">
</head>
<body>
	<div class="main-box">
		<h1>Sign Up</h1>
		<form action="helperSignup.php" method="POST">
			<p>User Name</p>
			<input type="text" name="name" placeholder="Enter User Name" required>
			<p>Email ID</p>
			<input type="email" name="email" placeholder="Enter Email ID" required>
			<p>Mobile Number</p>
			<input type="text" name="mobile" placeholder="Enter Mobile Number" required>
			<p>Address</p>
			<input type="text" name="address" placeholder="Enter address" required>
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password" required>
			<input type="submit" name="submit-btn" value="Sign Up">
		</form>
		
		<p style="text-align: center; padding-bottom: 8px; padding-top: 10px">Already registered?</p>
		<button><a href="login.php">Click here to Log In</a></button>
	</div>
</body>
</html>