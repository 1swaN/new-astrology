<?php
	$link = mysqli_connect('localhost', 'root', '', 'test_db');
	mysqli_set_charset($link, 'utf8');
	if (empty($_POST['customerName'])) {
		echo "<script type='text/javascript'>alert('You didn't write a name!');</script>";
		exit();
	}
	else if (empty($_POST['customerSurname'])) {
		echo "<script type='text/javascript'>alert('You didn't write a surname!');</script>";
		exit();
	}
		else if (empty($_POST['customerEmail'])) {
		echo "<script type='text/javascript'>alert('You didn't write an email address!');</script>";
		exit();
	}
	else if (empty($_POST['datetime'])) {
		echo "<script type='text/javascript'>alert('You have not chosen a date!');</script>";
		exit();
	}
	else if (empty($_POST['fav_language'])) {
		echo "<script type='text/javascript'>alert('You have not chosen a language!');</script>";
		exit();
	}
	else {
		$customer_Name = $_POST['customerName'];
		$customer_Surname = $_POST['customerSurname'];
		$customer_FIO = $customer_Name.' '.$customer_Surname;
		echo $customer_Name;
		$customer_Email = $_POST['customerEmail'];
		$dateOfSession = $_POST['datetime'];
		$convertedDate = date('Y-m-d H:i', strtotime($dateOfSession));
		$choosenLanguage = $_POST['fav_language'];
		$field = array_fill(0, 3, 0);
		foreach ($_POST['checkbox'] as $index) {
			$field[$index] = 1;
		}
		$stringOfChecks = implode(', ', $field);
		// Check if the previous session ended at least 1.5 hours before the current session starts
		$query2 = mysqli_query($link, "SELECT MAX(start_time) AS last_session FROM `sessions`");
		$row = mysqli_fetch_assoc($query2);
		$lastSession = $row['last_session'];
		if ($lastSession !== null && strtotime("$lastSession +1.5 hours") > strtotime($convertedDate)) {
		echo "<script type='text/javascript'>alert('You can only sign up for a session every 1.5 hours after the start of the previous session!');</script>";
		//exit
		}
		else {
			$query3 = "INSERT INTO `customers` (FIO, Date, Email, Language, Services) VALUES ('$customer_FIO', '$convertedDate', '$customer_Email', '$choosenLanguage', '$stringOfChecks')";
			mysqli_query($link, $query3);
			mysqli_close($link);
			echo "<script type='text/javascript'>alert('The recording was made successfully!');</script>";
		}
	}
	// Check if the date is already booked
	// $query1 = mysqli_query($link, "SELECT Date FROM `usersrecords`");
	// while ($result = mysqli_fetch_array($query1)) {
		// if (strtotime($result['Date']) == strtotime($convertedDate)) {
			// echo "<script type='text/javascript'>alert('This date is already booked!');</script>";
			// //exit
		// }
	// }
?>
