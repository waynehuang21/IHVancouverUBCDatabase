<?php
	require_once('config.php');
	
	$student_id = $_GET['student_id'];
			
	$query = "SELECT name, english_name, age, room, colour, class, arrival_date, departure_date FROM Students WHERE student_id = ".$student_id;
					
	$response = mysqli_query($dbc, $query);
	$student = mysqli_fetch_array($response);	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Student Info</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="infotable.css">
		<script>
		function $(id){
			var element = document.getElementById(id);
			if( element == null )
			alert( "Programmer error: " + id + " does not exist." );
			return element;
		}
		function showComments() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					$('commentBody').innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "showcomment.php?student_id=" + <?php echo $student_id ?>, true);
			xhttp.send();
			
			showAbsences();
		}
		function showAbsences() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					$('absencesBody').innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "showabsences.php?student_id=" + <?php echo $student_id ?>, true);
			xhttp.send();
		}
		function edit() {
			var student_id = <?php echo $student_id ?>;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					$('studentTable').innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "editstudenttable.php?id="+student_id, true);
			xhttp.send();
			$('edit').innerHTML = '<input type="button" class="button" value="Cancel" onclick="cancel()"><input type="submit" form="editStudentTable" class="button" value="Submit">';
			showComments();
			showAbsences();
		}

		function cancel() {
			location.reload();
		}
		</script>
	</head>
	<body onload="showComments()">
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
					<li><a href="colourgroup.php">Colour Groups</a></li>
					<li><a href="classlist.php">Class List</a></li>
				</ul>
			</div>
			<div id="content">
				<div id="contentHeader">
					<div id="edit">
						<input type="button" value="Edit" class="button" onclick="edit()">
					</div>
					<h2>Student Info:</h2>
				</div>
				<div id="studentTable">
					<table id="infoTable">
						<tr>
							<th class="tableHeading" class="tableCell">Name:</th>
							<th class="tableHeading" class="tableCell">English Name:</th>
							<th class="tableHeading" class="tableCell">Age:</th>
						</tr>
						<tr>
							<td class="tableCell"><?php echo $student['name']; ?></td>
							<td class="tableCell"><?php echo $student['english_name']; ?></td>
							<td class="tableCell"><?php echo $student['age']; ?></td>
						</tr>
						<tr>
							<th class="tableHeading" class="tableCell">Room:</th>
							<th class="tableHeading" class="tableCell">Colour:</th>
							<th class="tableHeading" class="tableCell">Class:</th>
						</tr>
						<tr>
							<td class="tableCell"><?php echo $student['room']; ?></td>
							<td class="tableCell"><?php echo $student['colour']; ?></td>
							<td class="tableCell"><?php echo $student['class']; ?></td>
						</tr>
						<tr>
							<th colspan="2" class="tableHeading" class="tableCell">Comments:</th>
							<th class="tableHeading" class="tableCell">Absences</th>
						</tr>
						<tr>
							<td colspan="2" class="tableCell">
								<div id="commentBody">
								</div>
								<form id="formComment" action="comment.php?student_id=<?php echo $student_id ?>" method="post">
									<textarea rows="5" cols="50" name="comment"></textarea>
									<br>
									<input type="submit">
								</form>
							</td>
							<td class="tableCell">
								<div id="absencesBody">
								</div>
							</td>
						</tr>
						<tr>
							<th class="tableHeading" class="tableCell">Arrival Date:</th>
							<th class="tableHeading" class="tableCell">Departure Date:</th>
							<th class="tableHeading" class="tableCell"></th>
						</tr>
						<tr>
							<td class="tableCell"><?php echo $student['arrival_date']; ?></td>
							<td class="tableCell"><?php echo $student['departure_date']; ?></td>
							<td class="tableCell"></td>
						</tr>
					</table>
				</div>
			</div>
			<div id="footer">
			
			</div>
		</div>
	</body>
</html>
<?php
	mysqli_close($dbc);	
?>