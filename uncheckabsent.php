<?php
				
	require_once('config.php');
			
	$student_id = $_GET['id'];		
	$activity = $_GET['activity'];
	
	$query = "INSERT IGNORE INTO Attendance (student_id, date, activity, absent, special) 
			  VALUES (?, CURDATE(), ?, 'no', NULL)
			  ON DUPLICATE KEY UPDATE absent = 'no'";
	
	$stmt = @mysqli_prepare($dbc, $query);
	
	mysqli_stmt_bind_param($stmt, "is", $student_id, $activity);
	
	mysqli_stmt_execute($stmt);
			
	mysqli_close($dbc);	

?>