<?php
				
					require_once('config.php');
					
					$query = "SELECT DISTINCT class FROM Students WHERE CURDATE() > arrival_date && CURDATE() < departure_date";
					
					$response = @mysqli_query($dbc, $query);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Class List</title>
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
					<h2>Class List:</h2>					
				</div>
				<div id="contentBody">
				<?php
					
					if($response) {
						
						while ($row = mysqli_fetch_array($response)) {
							
							$class = $row['class'];
							$total = 0;
							
							echo 
							'<table class="listTable">
								<tr>
									<th colspan="2" class="listHeading">'.$class.'</td>
								</tr>';
							
							$query2 = "SELECT name, english_name FROM Students WHERE class = \"" . $class . "\" && 
									  CURDATE() > arrival_date && CURDATE() < departure_date";
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
									'<tr>
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