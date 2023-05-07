<?php
	// $link = mysqli_connect('localhost', 'root', '', 'test_db');
	// mysqli_set_charset($link, 'utf8');
	// var_dump($_POST);
	// $customer_Name = $_POST['customerName'];
	// $customer_Surname = $_POST['customerSurname'];
	// $customer_FIO = $customer_Name.' '.$customer_Surname;
	// $customer_Email = $_POST['customerEmail'];
	// $dateOfSession = $_POST['date-time-picker'];
	// $convertedDate = date('Y-m-d H:i:s', strtotime($dateOfSession));
	// $choosenLanguage = $_POST['fav_language'];
	
	// $field = array_fill(0, 3, 0);
	// foreach ($_POST['check'] as $index) {
	// 	$field[$index] = 1;
	// }
	// $stringOfChecks = implode(',', $field);
	// echo $stringOfChecks;
	// if (isset($_POST['specialistTime'])) {
    //     $specialistTime = $_POST['specialistTime'];
    //     $limitedSpecialistTime = DateTime::createFromFormat('Y-m-d\TH:i:s', $specialistTime, new DateTimeZone('UTC'));
    //     echo $limitedSpecialistTime->format('Y-m-d H:i:s');
    // }
	// $limitedSpecialistTime = DateTime::createFromFormat('Y-m-d\H:i:s', $specialistTime, new DateTimeZone('UTC'));
	// echo $limitedSpecialistTime;
	// $startTime = DateTime::createFromFormat('H:i', '07:30', new DateTimeZone('UTC'));
	// $endTime = DateTime::createFromFormat('H:i', '19:30', new DateTimeZone('UTC'));
	// if ($limitedSpecialistTime >= $startTime && $limitedSpecialistTime <= $endTime) {
	// 	$query2 = "INSERT INTO customers (Email, Full_Name, selected_services, language) VALUES ('$customer_Email', '$customer_FIO', '$stringOfChecks', '$choosenLanguage');";
	// 	$query3 = "INSERT INTO sessions (customer_id, start_time, status)
	// 	VALUES ((SELECT id FROM customers WHERE Email = '$customer_Email' LIMIT 1),
	// 	'$convertedDate',
	// 	'Open')";	
	// 	mysqli_query($link, $query2);
	// 	mysqli_query($link, $query3);
	// 	mysqli_close($link);	
	// 	echo "<script type='text/javascript'>alert('Запись была успешно произведена!');</script>";
	// }
	// else {
	// 	echo "<script type='text/javascript'>alert('Ошибка записи! Специалист не сможет принять Вас в такое время');</script>";		
	// }
?>
