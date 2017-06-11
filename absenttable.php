<?php
				
	require_once('config.php');

	$query6 = "SELECT name, english_name, room FROM Students JOIN Attendance ON Students.student_id = Attendance.student_id
			   WHERE Attendance.date = CURDATE() && absent = 'yes' && activity = 'morning'";
	$response6 = @mysqli_query($dbc, $query6);

	echo '<h1>Morning</h1>';

	echo 
			'<table id="morningAbsenceTable">
			<tr>
				<th colspan="2">Name</th>
				<th>Room</th>
			</tr>';

	while($row6 = mysqli_fetch_array($response6)) {
		echo '<tr>
			      <td>'.$row6['name'].'</td>	  
				  <td>'.$row6['english_name'].'</td>	  
				  <td>'.$row6['room'].'</td>
			  </tr>';
	}

	echo '</table>';

	$query7 = "SELECT name, english_name, room FROM Students JOIN Attendance ON Students.student_id = Attendance.student_id
			   WHERE Attendance.date = CURDATE() && absent = 'yes' && activity = 'afternoon'";
	$response7 = @mysqli_query($dbc, $query7);

	echo '<h1>Afternoon</h1>';

	echo 
			'<table id="afternoonAbsenceTable">
			<tr>
				<th colspan="2">Name</th>
				<th>Room</th>
			</tr>';

	while($row7 = mysqli_fetch_array($response7)) {
		echo '<tr>
			      <td>'.$row7['name'].'</td>	  
				  <td>'.$row7['english_name'].'</td>	  
				  <td>'.$row7['room'].'</td>
			  </tr>';
	}

	echo '</table>';

	$query8 = "SELECT name, english_name, room FROM Students JOIN Attendance ON Students.student_id = Attendance.student_id
			   WHERE Attendance.date = CURDATE() && absent = 'yes' && activity = 'evening'";
	$response8 = @mysqli_query($dbc, $query8);

	echo '<h1>Evening</h1>';

	echo 
			'<table id="eveningAbsenceTable">
			<tr>
				<th colspan="2">Name</th>
				<th>Room</th>
			</tr>';

	while($row8 = mysqli_fetch_array($response8)) {
		echo '<tr>
			      <td>'.$row8['name'].'</td>	  
				  <td>'.$row8['english_name'].'</td>	  
				  <td>'.$row8['room'].'</td>
			  </tr>';
	}

	echo '</table>';

	$query = "SELECT DISTINCT Students.student_id, name, english_name FROM Students JOIN Attendance ON Students.student_id = Attendance.student_id
			  WHERE CURDATE() > arrival_date && CURDATE() < departure_date && absent = 'yes'";

	$response = @mysqli_query($dbc, $query);
			
	if($response) {
		echo '<h1>Total Absences</h1>';

		echo 
			'<table id="absenceTable">
			<tr>
				<th colspan="3">Name</th>
				<th>Morn.</th>
				<th>Aft.</th>
				<th>Eve.</th>
				<th colspan="5">Comments</th>
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