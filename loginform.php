<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Student Database-Login</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="studentstable.css">
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<img src="logo.svg" alt="International House Logo">
				<h1>International House UBC <br> Student Database</h1>
			</div>
			<div id="navbar">
				<ul>
					<li><a href="index.php">Students</a></li>
					<li><a href="attendance.php">Attendance</a></li>
					<li><a href="absent.php">Absentees</a></li>
					<li><a href="dailylist.php">Daily List</a></li>
					<li><a href="colourgroup.php">Colour Groups</a></li>
					<li><a href="classlist.php">Class List</a></li>
				</ul>
			</div>
			<div id="content">
				<form name="login" method="post" action="login.php" style="text-align:center;margin-top: 100px;">
					<p style="display:inline-block;">Username:</p> <input type="text" name="username"><br>
					<p style="display:inline-block;padding-right:3px;">Password:</p> <input type="password" name="password"><br>
					<input type="submit" name="submit" value="Login">
				</form>
			</div>
			<div id="footer">
			
			</div>
		</div>
	</body>
</html>