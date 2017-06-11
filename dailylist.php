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

					require_once('config.php');
					
					$query = "SELECT DISTINCT colour FROM Students";
					
					$response = @mysqli_query($dbc, $query);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Daily List</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="listtable.css">
		<script>
		//function to grab the element by the id
		function $(id){
			var element = document.getElementById(id);
			if( element == null )
			alert( "Programmer error: " + id + " does not exist." );
			return element;
		}
		</script>
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
				<div id="contentHeader">
					<h2>Daily List:</h2>					
				</div>
				<div id="contentBody">
				<?php
						
					if($response) {
						
						while ($row = mysqli_fetch_array($response)) {
							
							$colour = $row['colour'];
							$total = 0;
							
							echo 
							'<table class="listTable">
								<tr>
									<th colspan="2" class="listHeading">'.$colour.'</td>
								</tr>';
							
							$query2 = "SELECT student_id, name, english_name FROM Students 
									   WHERE colour = \"" . $colour . "\" && CURDATE() > arrival_date && CURDATE() < departure_date";
							$response2 = @mysqli_query($dbc, $query2);
							$query4 = "SELECT student_id, name, english_name FROM Students 
									   WHERE colour = \"" . $colour . "\" && (arrival_date = CURDATE() || departure_date = CURDATE())";
							$response4 = @mysqli_query($dbc, $query4);
							
							if($response2){
								
								while($student = mysqli_fetch_array($response2)) {
									
									$query3 = "SELECT absent FROM Attendance
											   WHERE activity = 'afternoon' && date = CURDATE() && student_id = " . $student['student_id'];
									$response3 = @mysqli_query($dbc, $query3);
									$row3 = mysqli_fetch_array($response3);
									
									if(strcasecmp($row3['absent'], 'yes') == 0) {
										
									}
									else {
										if($student['english_name'] != "") {
											$english_name = '('.$student['english_name'].')';
										}
										else {
											$english_name = "";
										}
										echo
										'<tr>
										<td class="listCell">'.$english_name.'</td>
										<td class="listCell">'.$student['name'].'</td>
										</tr>';		
										
										$total++;
									}
								}
								while($row4 = mysqli_fetch_array($response4)) {
									$query5 = "SELECT special FROM Attendance
											   WHERE activity = 'afternoon' && date = CURDATE() && student_id = " . $row4['student_id'];
									$response5 = @mysqli_query($dbc, $query5);
									$row5 = mysqli_fetch_array($response5);
									
									if(strcasecmp($row5['special'], 'yes') == 0) {
										echo
										'<tr>
										<td class="listCell">'.$row4['english_name'].'</td>
										<td class="listCell">'.$row4['name'].'</td>
										</tr>';		
										
										$total++;
									}
									else {
						
									}
								}
							}
							else {
					
								echo 'Could not issue database query.';
								echo mysqli_error($dbc);
							}
							echo
							'<tr>
								<td colspan="2" id="total">'.$total.'</td>
							</tr>
							</table>';		
						}
					}
					else {
					
						echo 'Could not issue database query. 1';
						echo mysqli_error($dbc);
					}			
				?>
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