<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/adminStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<title>Customer Sessions</title>
</head>
<body>
	<div class="container">
			<h1 class="page-header">Customer Sessions</h1>
			<form action="reschedule_session.php" method="post">
				<div class="controller">
					<div class="controller__left">
						<label for="selected_date">Selected Date and Time:</label>
						<input class="datetime" type="datetime-local" id="selected_date" name="selected_date">
					</div>
					<div class="controller__center">
						<label for="Close_all_sessions">Time:</label>
						<input class="Close_all_sessions_Time" type="time" id="close_all_sessions_Time" name="close_all_sessions_Time">
						<button class="func-button close" type="submit" name="close_all_sessions" formaction="close_sessions_time.php" formmethod="post">Close all the sessions</button>
					</div>
					<div class="controller__right">
						<button class="func-button close" type="submit" name="close_sessions" formaction="close_session.php" formmethod="post">Close Sessions</button>
						<button class="func-button reschedule" type="submit" name="reschedule_sessions" formaction="reschedule_session.php" formmethod="post">Reschedule Sessions</button>    
					</div>
				</div>
			<?php
				// Connect to the database
				$host = 'localhost';
				$dbname = 'site2';
				$username = 'root';
				$password = '';
				$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
				// Fetch the data from the database, grouped by date of session
				$sql = "SELECT DATE_FORMAT(s.start_time, '%Y-%m-%d') AS session_date, s.id, c.email, c.selected_services, c.full_name, c.language, s.start_time, s.end_time, s.status
						FROM sessions s
						INNER JOIN customers c ON s.customer_id = c.id
						ORDER BY s.start_time DESC";
				$result = $conn->query($sql);

				// Create a variable to store the current session date
				$current_date = null;

				echo '<table class="outer-table">';
					echo '<thead class="table-headers">';
						echo '<tr class="table-headers__row">';
							echo '<th class="empty"></th>';
							echo '<th class="table-header">Дата и время начала сеанса</th>';	
							echo '<th class="table-header">Дата и время конца сеанса</th>';	
							echo '<th class="table-header">Email</th>';
							echo '<th class="table-header">Полное имя заказчика</th>';
							echo '<th class="table-header">Язык сеанса</th>';
							echo '<th class="table-header">Статус сеанса</th>';
							echo '<th class="table-header">Выбранные услуги</th>';
						echo '</tr>';
				echo '<tbody class="table-info">';
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					if ($row['session_date'] !== $current_date) {
						$current_date = $row['session_date'];
						echo "<tr><td style='text-align: left' colspan='2'><strong>$current_date</strong></td></tr>";
					}
					echo '<tr class="table-info__row">';
					echo "<td><input type='checkbox' name='session_ids[]' value='" . $row['id'] . "'></td>";
					echo "<input type='hidden' name='session_id[" . $row['id'] . "]' value='" . $row['id'] . "'>";
					echo "<td>" . $row['start_time'] . "</td>";
					echo "<td>" . $row['end_time'] . "</td>";
					echo "<td>" . $row['email'] . "</td>";
					echo "<td>" . $row['full_name'] . "</td>";
					echo "<td>" . $row['language'] . "</td>";
					echo "<td>" . $row['status'] . "</td>";
					echo "<td>" . $row['selected_services'] . "</td>";
					echo "</tr>";
				}
				// Close the database connection
				$conn = null;
			?>
	</form>
</body>
</html>