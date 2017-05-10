<?php
				
	require_once('config.php');
			
	$student_id = $_GET['id'];		
	
	$query = "INSERT INTO Attendance (student_id, date, activity, absent, special) 
			  VALUES (?, CURDATE(), 'afternoon', NULL, 'no')
			  ON DUPLICATE KEY UPDATE special = 'no'";
	
	$stmt = @mysqli_prepare($dbc, $query);
	
	mysqli_stmt_bind_param($stmt, "i", $student_id);
	
	mysqli_stmt_execute($stmt);
			
	mysqli_close($dbc);	

?>