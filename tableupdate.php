<?php
				
	require_once('config.php');
			
	$type = $_GET['type'];		
	$age = $_GET['age'];
	
	if($age == 0){
		$query = "SELECT student_id, name, english_name, age, room, colour, class, arrival_date, departure_date FROM Students
				 WHERE CURDATE() > arrival_date && CURDATE() < departure_date ORDER by " . $type;
	}
	else if($age == 1){
		$query = "SELECT student_id, name, english_name, age, room, colour, class, arrival_date, departure_date FROM Students
				 WHERE CURDATE() > arrival_date && CURDATE() < departure_date && age <= 13 ORDER by " . $type;
	}
	else if($age == 2){
		$query = "SELECT student_id, name, english_name, age, room, colour, class, arrival_date, departure_date FROM Students
				 WHERE CURDATE() > arrival_date && CURDATE() < departure_date && age > 13 ORDER by " . $type;
	}
	else {
		$query = "SELECT student_id, name, english_name, age, room, colour, class, arrival_date, departure_date FROM Students
				 WHERE CURDATE() > arrival_date && CURDATE() < departure_date ORDER by " . $type;
	}
	
	$response = @mysqli_query($dbc, $query);
			
	if($response) {
		
		echo 
			'<table id="studentsTable">
			<tr>
				<th colspan="2">Name</td>
				<th>Colour</td>
				<th style="text-align:center">Room</td>
				<th>Class</td>
			</tr>';
					
		while($row = mysqli_fetch_array($response)) {
			
		echo
			'<tr>
				<td><a href="student.php?student_id='.$row['student_id'].'">'.$row['name'].'</a></td>
				<td>'.$row['english_name'].'</td>
				<td>'.$row['colour'].'</td>
				<td align="center">'.$row['room'].'</td>							
				<td>'.$row['class'].'</td>
			</tr>';						
		}
		
		echo	
			'</table>';				
	}
	else {
					
		echo 'Could not issue database query.';
		echo mysqli_error($dbc);
	}			

	mysqli_close($dbc);	

?>