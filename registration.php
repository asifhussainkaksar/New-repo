<!DOCTYPE html>
<html>
<head>
<h2>REGISTRATION</h2>
</head>
<body>
<form  method="POST" action="register.php">
<label for='first_name'>First Name</label>
<input type='text' id='first_name' name='first_name' required><br><br>
<label for='last_name'>Last Name</label>
<input type='text' id='last_name' name='last_name' required><br><br>
<label for='email'>Email</label>
<input type='email' id='email' name='email' required><br><br>
<label for='password'>Password</label>
<input type='password' id='password' name='password' required><br><br>
<label for=confirm_password>Confirm Password</label>
<input type='password' id=confirm_password name='confirm_password' required><br><br>
<button type='submit'>Register</button>
</form>
</body>
</html>