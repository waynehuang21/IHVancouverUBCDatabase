<?php
				
	require_once('config.php');
				
	$activity = $_GET['activity'];
	$age = $_GET['age'];
	
	if($age == 0){
		$query = "SELECT DISTINCT class FROM Students WHERE CURDATE() > arrival_date && CURDATE() < departure_date";
	}
	else if($age == 1){
		$query = "SELECT DISTINCT class FROM Students WHERE CURDATE() > arrival_date && CURDATE() < departure_date && age <= 13";
	}
	else if($age == 2){
		$query = "SELECT DISTINCT class FROM Students WHERE CURDATE() > arrival_date && CURDATE() < departure_date && age > 13";
	}
	else {
		$query = "SELECT DISTINCT class FROM Students WHERE CURDATE() > arrival_date && CURDATE() < departure_date";
	}
	
	$response = @mysqli_query($dbc, $query);
			
	if($response) {
		
		while($row = mysqli_fetch_array($response)) {
			echo 
				'<table id="studentsTable">
				<tr>
					<th colspan="4" style="text-align:center">' . $row['class'] . '</th>
				</tr>
				<tr>
					<th colspan="2">Name</th>
					<th style="text-align:center">Room</th>
					<th style="text-align:center">Absent</th>
				</tr>';
						
				if($age == 0){
					$query2 = "SELECT name, english_name, student_id, room FROM Students WHERE class = \"" . $row['class']. "\" && 
						      CURDATE() > arrival_date && CURDATE() < departure_date";
				}
				else if($age == 1){
					$query2 = "SELECT name, english_name, student_id, room FROM Students WHERE class = \"" . $row['class']. "\" && 
						      CURDATE() > arrival_date && CURDATE() < departure_date && age <= 13";
				}
				else if($age == 2){
					$query2 = "SELECT name, english_name, student_id, room FROM Students WHERE class = \"" . $row['class']. "\" && 
					    	  CURDATE() > arrival_date && CURDATE() < departure_date && age > 13";
				}
				else {
					$query2 = "SELECT name, english_name, student_id, room FROM Students WHERE class = \"" . $row['class']. "\" && 
						       CURDATE() > arrival_date && CURDATE() < departure_date";
				}
				
				$response2 = @mysqli_query($dbc, $query2);
				
			while($row2 = mysqli_fetch_array($response2)) {
				
				$query3 = "SELECT absent FROM Attendance WHERE date = CURDATE() && student_id = " . $row2['student_id'] . " && activity = '" . $activity . "'";
				$response3 = @mysqli_query($dbc, $query3);
				$row3 = mysqli_fetch_array($response3);
				
			echo
				'<tr>
					<td><a href="student.php?student_id='.$row2['student_id'].'">'.$row2['name'].'</a></td>
					<td>'.$row2['english_name'].'</td>
					<td align="center">'.$row2['room'].'</td>							
					<td align="center">
						<label for="checkbox_' . $row2['student_id'] . '" class="checkLabel">
							<input type="checkbox" id="checkbox_' . $row2['student_id'] . '" 
								   value="' . $row2['student_id'] . '" onchange="checkAttendance(';
			echo				   "'checkbox_" . $row2['student_id']. "'";  
			echo			   ')"';
			
			$absent = $row3['absent'];
			
			if(strcasecmp($absent, 'yes') == 0) {
				echo 'checked="checked"';
			}
			
			echo					'>
						</label>
					</td>
				</tr>';						
			}
			
			echo	
				'</table>';
		}
	}
	else {
					
		echo 'Could not issue database query.';
		echo mysqli_error($dbc);
	}			

	mysqli_close($dbc);	

?>