<?php
				
	require_once('config.php');
	
	$query = "SELECT student_id, name, english_name, room FROM Students WHERE arrival_date = CURDATE()";
	$query2 = "SELECT student_id, name, english_name, room FROM Students WHERE departure_date = CURDATE()";
	$query3 = "SELECT COUNT(*) FROM Students WHERE arrival_date = CURDATE()";
	$query4 = "SELECT COUNT(*) FROM Students WHERE departure_date = CURDATE()";
	
	$response = @mysqli_query($dbc, $query);
	$response2 = @mysqli_query($dbc, $query2);
	$response3 = @mysqli_query($dbc, $query3);
	$response4 = @mysqli_query($dbc, $query4);
	
	$row3 = mysqli_fetch_array($response3);
	$row4 = mysqli_fetch_array($response4);
			
	if($row3[0] > 0 || $row4[0] > 0) {

		echo '<h1 align="center">Arrivals/Departures</h1>';
	
	}
	
	if($response && $row3[0] > 0) {
		echo 
				'<table id="studentsTable">
				<tr>
					<th colspan="4" style="text-align:center">Arrivals</th>
				</tr>
				<tr>
					<th colspan="2">Name</th>
					<th style="text-align:center">Room</th>
					<th style="text-align:center">Attending</th>
				</tr>';
		
		while($row = mysqli_fetch_array($response)) {
				
			$query3 = "SELECT special FROM Attendance WHERE date = CURDATE() && student_id = " . $row['student_id'] . " && activity = 'afternoon' ";
			$response3 = @mysqli_query($dbc, $query3);
			$row3 = mysqli_fetch_array($response3);	
				
			echo
				'<tr>
					<td><a href="student.php?student_id='.$row['student_id'].'">'.$row['name'].'</a></td>
					<td>'.$row['english_name'].'</td>
					<td align="center">'.$row['room'].'</td>							
					<td align="center">
						<label for="checkbox_' . $row['student_id'] . '" class="checkLabel">
							<input type="checkbox" id="checkbox_' . $row['student_id'] . '" 
								   value="' . $row['student_id'] . '" onchange="checkSpecial(';
			echo				   "'checkbox_" . $row['student_id']. "'";  
			echo			   ')"';
			
			$special = $row3['special'];
			
			if(strcasecmp($special, 'yes') == 0) {
				echo 'checked="checked"';
			}
			
			echo					'>
						</label>
					</td>
				</tr>';						
		}
			
		echo '</table>';
	}		

	if($response2 && $row4[0] > 0) {
		echo 
				'<table id="studentsTable">
				<tr>
					<th colspan="4" style="text-align:center">Departures</th>
				</tr>
				<tr>
					<th colspan="2">Name</th>
					<th style="text-align:center">Room</th>
					<th style="text-align:center">Attending</th>
				</tr>';
		
		while($row2 = mysqli_fetch_array($response2)) {
				
			$query3 = "SELECT special FROM Attendance WHERE date = CURDATE() && student_id = " . $row2['student_id'] . " && activity = 'afternoon' ";
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
								   value="' . $row2['student_id'] . '" onchange="checkSpecial(';
			echo				   "'checkbox_" . $row2['student_id']. "'";  
			echo			   ')"';
			
			$special = $row3['special'];
			
			if(strcasecmp($special, 'yes') == 0) {
				echo 'checked="checked"';
			}
			
			echo					'>
						</label>
					</td>
				</tr>';						
		}
			
		echo '</table>';
	}		
	
	mysqli_close($dbc);	

?>