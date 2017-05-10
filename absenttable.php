<?php
				
	require_once('config.php');
	
	$query = "SELECT DISTINCT Students.student_id, name, english_name FROM Students JOIN Attendance ON Students.student_id = Attendance.student_id
			  WHERE CURDATE() > arrival_date && CURDATE() < departure_date && absent = 'yes'";

	$response = @mysqli_query($dbc, $query);
			
	if($response) {
		
		echo 
			'<table id="absenceTable">
			<tr>
				<th colspan="3">Name</td>
				<th>Morn.</td>
				<th>Aft.</td>
				<th>Eve.</td>
				<th colspan="5">Comments</td>
			</tr>';
					
		while($row = mysqli_fetch_array($response)) {
			
			$query2 = "SELECT COUNT(*) FROM Attendance WHERE absent = 'yes' && activity = 'morning' && student_id = ".$row['student_id'];
			$query3 = "SELECT COUNT(*) FROM Attendance WHERE absent = 'yes' && activity = 'afternoon' && student_id = ".$row['student_id'];
			$query4 = "SELECT COUNT(*) FROM Attendance WHERE absent = 'yes' && activity = 'evening' && student_id = ".$row['student_id'];
			
			$response2 = @mysqli_query($dbc, $query2);
			$response3 = @mysqli_query($dbc, $query3);
			$response4 = @mysqli_query($dbc, $query4);
			
			$row2 = mysqli_fetch_array($response2);
			$row3 = mysqli_fetch_array($response3);
			$row4 = mysqli_fetch_array($response4);
			
			$query5 = "SELECT comment, date FROM Comments WHERE student_id = ".$row['student_id'];
			$response5 = @mysqli_query($dbc, $query5);
			
			echo
				'<tr>
					<td colspan="2"><a href="student.php?student_id='.$row['student_id'].'">'.$row['name'].'</a></td>
					<td>'.$row['english_name'].'</td>
					<td class="abscat">'.$row2[0].'</td>
					<td class="abscat">'.$row3[0].'</td>							
					<td class="abscat">'.$row4[0].'</td>
					<td colspan="5">';
					
			while($row5 = mysqli_fetch_array($response5)) {

				echo '<p>('.$row5['date'].')</p><p>'.$row5['comment'].'</p><br>';
			
			}
					
			echo '</tr>';						
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