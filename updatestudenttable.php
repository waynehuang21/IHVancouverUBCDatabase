<?php
				
	require_once('config.php');		
	
	$student_id = $_GET['id'];

	$query = "INSERT INTO Students (student_id, name, english_name, age, colour, room, class, arrival_date, departure_date) 
			  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
			  ON DUPLICATE KEY UPDATE name = VALUES(name), english_name = VALUES(english_name), age = VALUES(age)
			  						  , colour = VALUES(colour), room = VALUES(room), class = VALUES(class)
									  , arrival_date = VALUES(arrival_date), departure_date = VALUES(departure_date)";
	
	$stmt = @mysqli_prepare($dbc, $query);

	$name  = $_POST['name'];
	$english_name  = $_POST['english_name'];
	$colour  = $_POST['colour'];
	$age = $_POST['age'];
	$room  = $_POST['room'];
	$class  = $_POST['class'];
	$arrival_date = $_POST['arrival_date'];
	$departure_date = $_POST['departure_date'];

	mysqli_stmt_bind_param($stmt, "ississsss", $student_id, $name, $english_name, $age, $colour, $room, $class, $arrival_date, $departure_date);
	
	mysqli_stmt_execute($stmt);
			
	mysqli_close($dbc);	

	header("Location: student.php?student_id=".$student_id);

?>