<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Absentees</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="absenttable.css">
		<script>
		//function to grab the element by the id
		function $(id){
			var element = document.getElementById(id);
			if( element == null )
			alert( "Programmer error: " + id + " does not exist." );
			return element;
		}
		
		function sortTable() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					$('contentBody').innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "absenttable.php", true);
			xhttp.send();
		}
		</script>
	</head>
	<body onload="sortTable()">
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
				<div id="contentHeader">
					<h2>Absentees:</h2>
				</div>
				<div id="contentBody">
				</div>
			</div>
			<div id="footer">
			
			</div>
		</div>
	</body>
</html>