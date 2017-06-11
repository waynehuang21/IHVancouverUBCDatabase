<?php
				
	require_once('config.php');		
	
	$student_id = $_GET['student_id'];
	$class = $_GET['class'];

	$query = "INSERT INTO Students (student_id, class) 
			  VALUES (?, ?)
			  ON DUPLICATE KEY UPDATE class = VALUES(class)";
	
	$stmt = @mysqli_prepare($dbc, $query);

	mysqli_stmt_bind_param($stmt, "is", $student_id, $class);
	
	mysqli_stmt_execute($stmt);
			
	mysqli_close($dbc);	


?>