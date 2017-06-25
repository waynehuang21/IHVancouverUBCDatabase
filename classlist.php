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
					
					$query = "SELECT DISTINCT class FROM Students WHERE CURDATE() >= arrival_date && CURDATE() <= departure_date";
					
					$response = @mysqli_query($dbc, $query);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Class List</title>
		<link rel="stylesheet" href="main.css">
		<link rel="stylesheet" href="listtable.css">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="draggableclass.js"></script>
		<script>
			function edit() {
				document.getElementById('edit').innerHTML = '<input type="submit" onclick="location.reload()" class="button" value="Submit">';
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
					<div id="edit">
						<input type="button" value="Edit" class="button" onclick="edit()" id="editbutton">
					</div>
					<h2>Class List:</h2>					
				</div>
				<div id="contentBody">
				<?php
					
					if($response) {
						
						while ($row = mysqli_fetch_array($response)) {
							
							$class = $row['class'];
							$total = 0;
							
							echo 
							'<table class="listTable" id="'.$class.'">
								<tbody class="connectedSortable">
								<tr>
									<th colspan="2" class="listHeading">'.$class.'</td>
								</tr>';
							
							$query2 = "SELECT student_id, name, english_name, arrival_date FROM Students WHERE class = \"" . $class . "\" && 
									  CURDATE() >= arrival_date && CURDATE() <= departure_date";
							$response2 = @mysqli_query($dbc, $query2);
							
							if($response2){
								
								while($student = mysqli_fetch_array($response2)) {
									if($student['english_name'] != "") {
										$english_name = '('.$student['english_name'].')';
									}
									else {
										$english_name = "";
									}
									echo
									'<tr id="'.$student['student_id'].'"';
									
									if(strtotime(date("Y/m/d")) - strtotime($student['arrival_date']) < 518400) {
										echo
										'style="background-color:#FFE738"';
									}

									echo
									'>
									<td class="listCell">'.$english_name.'</td>
									<td class="listCell">'.$student['name'].'</td>
									</tr>';	
									
									$total++;
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
							</tbody>
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