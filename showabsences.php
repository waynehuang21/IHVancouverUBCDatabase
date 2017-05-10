<?php
				
	require_once('config.php');
			
	$student_id = $_GET['student_id'];		
	
	$query = "SELECT activity, date FROM Attendance
			  WHERE absent = 'yes' && student_id = " . $student_id;
	
	$response = @mysqli_query($dbc, $query);
	
	if($response) {
					
		while($row = mysqli_fetch_array($response)) {
			
		echo $row['date'].'    '.$row['activity'].
			'<br>';						
		}
	}
	else {
					
		echo 'Could not issue database query.';
		echo mysqli_error($dbc);
	}			

	mysqli_close($dbc);	

?>