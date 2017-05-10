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
			'<form id="editTable" action="updatestudents.php" method="POST"><table id="studentsTable">
			<tr>
				<th colspan="2">Name</td>
				<th>Colour</td>
				<th style="text-align:center">Room</td>
				<th>Class</td>
			</tr>';
					
		while($row = mysqli_fetch_array($response)) {
			
		echo
			'<tr>
				<td><input name="name_'.$row['student_id'].'" type"text" value="'.$row['name'].'"></td>
				<td><input name="english_name_'.$row['student_id'].'" type"text" value="'.$row['english_name'].'"></td>
				<td><input name="colour_'.$row['student_id'].'" type"text" value="'.$row['colour'].'"></td>
				<td><input name="room_'.$row['student_id'].'" type"text" value="'.$row['room'].'"></td>							
				<td><input name="class_'.$row['student_id'].'" type"text" value="'.$row['class'].'"></td>
			</tr>';						
		}
		
		echo	
			'</table></form>';				
	}
	else {
					
		echo 'Could not issue database query.';
		echo mysqli_error($dbc);
	}			

	mysqli_close($dbc);	

?>