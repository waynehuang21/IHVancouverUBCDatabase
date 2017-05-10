<?php
	require_once('config.php');
	
	$student_id = $_GET['id'];
			
	$query = "SELECT name, english_name, age, room, colour, class, arrival_date, departure_date FROM Students WHERE student_id = ".$student_id;
					
	$response = mysqli_query($dbc, $query);
	$student = mysqli_fetch_array($response);	

	echo
		'<form id="editStudentTable" method="POST" action="updatestudenttable.php?id='.$student_id.'" ><table id="infoTable">
			<tr>
				<th class="tableHeading" class="tableCell">Name:</th>
				<th class="tableHeading" class="tableCell">English Name:</th>
				<th class="tableHeading" class="tableCell">Age:</th>
			</tr>
			<tr>
				<td class="tableCell"><input name="name" type="text" value="'.$student['name'].'"></td>
				<td class="tableCell"><input name="english_name" type="text" value="'.$student['english_name'].'"></td>
				<td class="tableCell"><input name="age" type="text" value="'.$student['age'].'"></td>
			</tr>
			<tr>
				<th class="tableHeading" class="tableCell">Room:</th>
				<th class="tableHeading" class="tableCell">Colour:</th>
				<th class="tableHeading" class="tableCell">Class:</th>
			</tr>
			<tr>
				<td class="tableCell"><input name="room" type="text" value="'.$student['room'].'"></td>
				<td class="tableCell"><input name="colour" type="text" value="'.$student['colour'].'"></td>
				<td class="tableCell"><input name="class" type="text" value="'.$student['class'].'"></td>
			</tr>
			<tr>
				<th colspan="2" class="tableHeading" class="tableCell">Comments:</th>
				<th class="tableHeading" class="tableCell">Absences</th>
			</tr>
			<tr>
				<td colspan="2" class="tableCell">
					<div id="commentBody">
					</div>
					<form id="formComment" action="comment.php?student_id=<?php echo $student_id ?>" method="post">
						<textarea rows="5" cols="50" name="comment"></textarea>
						<br>
						<input type="submit">
					</form>
				</td>
				<td class="tableCell">
					<div id="absencesBody">
					</div>
				</td>
			</tr>
			<tr>
				<th class="tableHeading" class="tableCell">Arrival Date:</th>
				<th class="tableHeading" class="tableCell">Departure Date:</th>
				<th class="tableHeading" class="tableCell"></th>
			</tr>
			<tr>
				<td class="tableCell"><input name="arrival_date" type="text" value="'.$student['arrival_date'].'"></td>
				<td class="tableCell"><input name="departure_date" type="text" value="'.$student['departure_date'].'"></td>
				<td class="tableCell"></td>
			</tr>
		</table></form>';
			
	mysqli_close($dbc);	

	

?>