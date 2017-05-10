<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Attendance</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="attendancetable.css">
		<script type="text/javascript" src="js/textsizer.js"></script>
		<script>
		//function to grab the element by the id
		function $(id){
			var element = document.getElementById(id);
			if( element == null )
			alert( "Programmer error: " + id + " does not exist." );
			return element;
		}
		function whichSort() {
			if($('sortType_0').checked && !$('sortType_1').checked) {
				sortAttendanceColour();
			}
			else {
				sortAttendanceClass();
			}
			var title = $('sortActivity').value;
			$('attendanceTitle').innerHTML = title.charAt(0).toUpperCase() + title.slice(1);
			arrivalDepartureTable();
		}
		function sortAttendanceClass() {
			var activity = $('sortActivity').value;
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
			xhttp.open("GET", "attendancetableclass.php?activity=" + activity + "&age=" + age, true);
			xhttp.send();
		}
		
		function sortAttendanceColour() {
			var activity = $('sortActivity').value;
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
			xhttp.open("GET", "attendancetablecolour.php?activity=" + activity + "&age=" + age, true);
			xhttp.send();
		}
		
		function arrivalDepartureTable() {
			if($('sortActivity').value == 'afternoon') {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						$('specialBody').innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "arrivaldeparturetable.php", true);
				xhttp.send();
			}
			else {
				$('specialBody').innerHTML = '';
			}
		}
		
		function checkAttendance(id) {
			var student_id = $(id).value;
			var activity = $('sortActivity').value;
			
			if($(id).checked) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						$('blank').innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "checkabsent.php?id=" + student_id + "&activity=" + activity, true);
				xhttp.send();
			}
			else {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						$('blank').innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "uncheckabsent.php?id=" + student_id + "&activity=" + activity, true);
				xhttp.send();
			}
		}
		
		function checkSpecial(id) {
			var student_id = $(id).value;
			
			if($(id).checked) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						$('blank').innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "checkspecial.php?id=" + student_id, true);
				xhttp.send();
			}
			else {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if(this.readyState == 4 && this.status == 200) {
						$('blank').innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "uncheckspecial.php?id=" + student_id, true);
				xhttp.send();
			}
		}
		</script>
	</head>
	<body onload="whichSort()">
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
					<div style="float: right;">
						<a href="javascript:ts('body',1)">[+]</a> | <a href="javascript:ts('body',-1)">[-]</a>
					</div>
					<h2>Attendance:</h2>
					<div id=sortSelect>
					<p>Activity:</p>
					<select name="sortActivity" id="sortActivity" onchange="whichSort()">
						<option value="morning">Morning</option>
						<option value="afternoon" selected="selected">Afternoon</option>
						<option value="evening">Evening</option>
					</select>
					<br>
					<p>Sort By:</p>
					<input type="radio" name="sortType" value="colour" checked="checked" id="sortType_0" onchange="whichSort()">
					<label for="sortType_0"><p>Colour</p></label>
					<input type="radio" name="sortType" value="class" id="sortType_1" onchange="whichSort()">
					<label for="sortType_1"><p>Class</p></label>
					<br>
					<p>Age Range:</p>
					<input type="radio" name="age" value="all" checked="checked" id="sortAge_0" onchange="whichSort()">
					<label for="sortAge_0"><p>All</p></label>
					<input type="radio" name="age" value="junior" id="sortAge_1" onchange="whichSort()">
					<label for="sortAge_1"><p>Junior</p></label>
					<input type="radio" name="age" value="senior" id="sortAge_2" onchange="whichSort()">
					<label for="sortAge_2"><p>Senior</p></label>
					</div>
				</div>
				<h1 align="center" id="attendanceTitle"></h1>
				</div>
				<div id="contentBody">
				</div>
				<div id="specialBody">
				</div>
				<div id="blank">
				</div>
			</div>
			<div id="footer">
			
			</div>
		</div>
	</body>
</html>