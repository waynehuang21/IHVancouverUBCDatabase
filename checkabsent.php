<?php
				
	require_once('config.php');
			
	$student_id = $_GET['id'];		
	$activity = $_GET['activity'];
	
	$query = "INSERT INTO Attendance (student_id, date, activity, absent, special) 
			  VALUES (?, CURDATE(), ?, 'yes', NULL)
			  ON DUPLICATE KEY UPDATE absent = 'yes'";
	
	$stmt = @mysqli_prepare($dbc, $query);
	
	mysqli_stmt_bind_param($stmt, "is", $student_id, $activity);
	
	mysqli_stmt_execute($stmt);
			
	mysqli_close($dbc);	

?>