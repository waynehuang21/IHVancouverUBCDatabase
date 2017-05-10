<?php
				
	require_once('config.php');
			
	$student_id = $_GET['student_id'];		
	
	$query = "SELECT comment FROM Comments
			  WHERE date = CURDATE() && student_id = " . $student_id;
	
	$response = @mysqli_query($dbc, $query);
	
	if($response) {
					
		while($comment = mysqli_fetch_array($response)) {
			
		echo
			'<div class="comment">'
			.$comment['comment'].
			'</div>';						
		}
	}
	else {
					
		echo 'Could not issue database query.';
		echo mysqli_error($dbc);
	}			

	mysqli_close($dbc);	

?>