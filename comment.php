<?php
				
	require_once('config.php');
			
	$student_id = $_GET['student_id'];		
	$comment = $_POST['comment'];
	
	$query = "INSERT INTO Comments (student_id, date, comment, comment_id) 
			  VALUES (?, CURDATE(), ?, NULL)";
	
	$stmt = @mysqli_prepare($dbc, $query);
	
	mysqli_stmt_bind_param($stmt, "ss", $student_id, $comment);
	
	mysqli_stmt_execute($stmt);
			
	mysqli_close($dbc);	

	header("Location: student.php?student_id=" . $student_id);
?>