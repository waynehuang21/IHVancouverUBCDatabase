<?php
				
	require_once('config.php');		
	
	$student_id = $_GET['student_id'];
	$colour = $_GET['colour'];

	$query = "INSERT INTO Students (student_id, colour) 
			  VALUES (?, ?)
			  ON DUPLICATE KEY UPDATE colour = VALUES(colour)";
	
	$stmt = @mysqli_prepare($dbc, $query);

	mysqli_stmt_bind_param($stmt, "is", $student_id, $colour);
	
	mysqli_stmt_execute($stmt);
			
	mysqli_close($dbc);	


?>