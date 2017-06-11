<?php
    $user = 'ihvan';
    $pass = 'jpubc';
	
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        
        if (($_COOKIE['username'] != $user) || ($_COOKIE['password'] != md5($pass))) {    
            header('Location: loginform.php');
        } 
        
    } else {
        header('Location: loginform.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Student Database</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="studentstable.css">
		<script>
		//function to grab the element by the id
		function $(id){
			var element = document.getElementById(id);
			if( element == null )
			alert( "Programmer error: " + id + " does not exist." );
			return element;
		}
		
		function sortTable() {
			var type = $('sortType').value;
			var age = 0;
			if($('sortAge_0').checked) {
				age = 0;
			}
			else if($('sortAge_1').checked) {
				age = 1;
			}
			else if($('sortAge_2').checked) {
				age = 2;
			}
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					$('contentBody').innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "tableupdate.php?type=" + type + "&age=" + age, true);
			xhttp.send();
		}

		function edit() {
			var type = $('sortType').value;
			var age = 0;
			if($('sortAge_0').checked) {
				age = 0;
			}
			else if($('sortAge_1').checked) {
				age = 1;
			}
			else if($('sortAge_2').checked) {
				age = 2;
			}
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					$('contentBody').innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "tableedit.php?type=" + type + "&age=" + age, true);
			xhttp.send();
			$('edit').innerHTML = '<input type="button" class="button" value="Cancel" onclick="cancel()"><input type="submit" form="editTable" class="button" value="Submit">';
		}

		function cancel() {
			var type = $('sortType').value;
			var age = 0;
			if($('sortAge_0').checked) {
				age = 0;
			}
			else if($('sortAge_1').checked) {
				age = 1;
			}
			else if($('sortAge_2').checked) {
				age = 2;
			}
			sortTable();
			$('edit').innerHTML = '<input type="button" value="Edit" class="button" onclick="edit()">';
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
					<div id="edit">
						<input type="button" value="Edit" class="button" onclick="edit()">
					</div>
					<h2>Students:</h2>
					<div id=sortSelect>
					<p>Sort By:</p>
					<select id="sortType" onchange="sortTable()">
						<option value="student_id">Default</option>
						<option value="colour">Colour</option>
						<option value="room">Room</option>
						<option value="class">Class</option>
					</select>
					<br>
					<p>Age Range:</p>
					<input type="radio" name="age" value="all" checked="checked" id="sortAge_0" onchange="sortTable()">
					<label for="sortAge_0"><p>All</p></label>
					<input type="radio" name="age" value="junior" id="sortAge_1" onchange="sortTable()">
					<label for="sortAge_1"><p>Junior</p></label>
					<input type="radio" name="age" value="senior" id="sortAge_2" onchange="sortTable()">
					<label for="sortAge_2"><p>Senior</p></label>
					</div>
				</div>
				<div id="contentBody">
				</div>
			</div>
			<div id="footer">
			
			</div>
		</div>
	</body>
</html>