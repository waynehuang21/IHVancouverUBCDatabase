<?php
				
	require_once('config.php');		
	
	$query = "INSERT INTO Students (student_id, name, english_name, colour, room, class) 
			  VALUES (?, ?, ?, ?, ?, ?)
			  ON DUPLICATE KEY UPDATE name = VALUES(name), english_name = VALUES(english_name), colour = VALUES(colour), room = VALUES(room), class = VALUES(class)";
	
	$stmt = @mysqli_prepare($dbc, $query);

	for($x = 0; $x < 400; $x++) {

		if(isset($_POST['name_'.$x])) {
			$student_id = $x;
			$name  = $_POST['name_'.$x];
			$english_name  = $_POST['english_name_'.$x];
			$colour  = $_POST['colour_'.$x];
			$room  = $_POST['room_'.$x];
			$class  = $_POST['class_'.$x];

			mysqli_stmt_bind_param($stmt, "isssss", $student_id, $name, $english_name, $colour, $room, $class);
			
			mysqli_stmt_execute($stmt);

		}
	}
			
	mysqli_close($dbc);	

	header("Location: index.php");

?>