<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tasks: Forms</title>
	<style type="text/css">
		li { padding: 5px;  list-style: none;}
	</style>
</head>
<body>
	<h2>Register</h2>
	<form action="user_data.php" method="post">
		<ul>
			<li>
				<label for="name">Name</label>
				<input type="text" name="name" id="name">
			</li>	
			<li>
				<label for="email">Email</label>
				<input type="email" name="email" id="email">
			</li>
			<li>
				<label for="dob">Date of Birth</label>
				<input type="Date" name="dob" id="dob">
			</li>
			<li>
				<label for="gender">Gender</label>
				<select name="gender" id="gender">
					<option value="">---Please choose Gender---</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</li>
			<li>
				<label for="country">Country</label>
				<input type="text" name="country" id="country">
			</li>
				<input type="submit" name="submit" value="Register">
		</ul>
	</form>
</body>
</html>