<?php  
    // Подключаемся к базе данных
    $host = 'localhost';
    $dbname = 'site2';
    $username = 'root';
    $password = '';
    
    if (isset($_POST['selected_date'])) {
      $selected_date = $_POST['selected_date'];
      $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $selected_date . ' 00:00:00');
      if (!$datetime) {
          // Если выбранная дата имеет неправильный формат, выводим сообщение об ошибке и перенаправляем пользователя на страницу 2
          echo "<script type='text/javascript'>alert('Выбранная дата для переноса сеанса имеет неправильный формат!');</script>";
          echo "<script>location.href='page2.php';</script>";
          exit();
      }
      date_default_timezone_set("America/Cancun");
      $timeNow = new DateTime("now", new DateTimeZone("UTC"));
      $selectedTime = DateTime::createFromFormat('Y-m-d H:i:s', $selected_date, new DateTimeZone("America/Cancun"));
      if ($selectedTime < $timeNow) {
          // Если выбранная дата меньше текущей даты, выводим сообщение об ошибке и перенаправляем пользователя на страницу 2
          echo "<script type='text/javascript'>alert('Выбранная дата для переноса сеанса не может быть меньше текущей даты!');</script>";
          echo "<script>location.href='page2.php';</script>";
          exit();
      }
      else {
        try {
          $pdo = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
          // Начинаем транзакцию для выполнения нескольких запросов
          $pdo->beginTransaction();
  
          // Для каждого выбранного сеанса проверяем, что выбранная пользователем дата не вписывается в чужую запись
          if (isset($_POST['session_ids']) && is_array($_POST['session_ids']) && count($_POST['session_ids']) > 0) {
            $session_ids = $_POST['session_ids'];
            foreach ($session_ids as $session_id) {
                $startTime = $selectedTime->format('Y-m-d H:i:s');
                $endTime = (clone $selectedTime)->add(new DateInterval('PT90M'))->format('Y-m-d H:i:s');
                         
                $check_query = $pdo->prepare("SELECT * FROM sessions WHERE (:start_time BETWEEN start_time AND end_time OR :end_time BETWEEN start_time AND end_time) AND id != :id");
                $check_query->bindParam(':start_time', $startTime);
                $check_query->bindParam(':end_time', $endTime);
                $check_query->bindValue(':id', $session_id);
                $check_query->execute();
                $existing_session = $check_query->fetch(PDO::FETCH_ASSOC);
                if ($existing_session) {
                    // Если выбранная дата пересекается с записью другого сеанса, выводим сообщение об ошибке и откатываем транзакцию
                    echo "<script type='text/javascript'>alert('На выбранную дату и время уже имеется запись!');</script>";
                    echo "<script>location.href='page2.php';</script>";
                    $pdo->rollBack();
                    exit();
                }
                else {
                    foreach ($session_ids as $session_id) {
                        $update_query = $pdo->prepare("UPDATE sessions SET start_time = :start_time, end_time = :end_time WHERE id = :id");
                        $update_query->bindValue(':start_time', $selected_date);
                        $update_query->bindValue(':end_time', $endTime);
                        $update_query->bindValue(':id', $session_id);
                        $update_query->execute();
                    }
                    // Если все прошло успешно, коммитим транзакцию и перенаправляем пользователя на страницу 2 с сообщением об успехе
                    $pdo->commit();
                    echo "<script type='text/javascript'>alert('Сеансы успешно перенесены на выбранную дату!');</script>";
                    echo "<script>location.href='page2.php';</script>";
                    exit();
                }
            }
          }        
          else {
              // Если не выбрано ни одного сеанса, выводим сообщение об ошибке и перенаправляем пользователя на страницу 2
              echo "<script type='text/javascript'>alert('Вы не выбрали ни одну запись для переноса!');</script>";
              echo "<script>location.href='page2.php';</script>";
              $pdo->rollBack();
              exit();
          }
        } 
        catch(PDOException $e) {
          // Если произошла ошибка при работе с базой данных, выводим сообщение об ошибке и откатываем транзакцию
          echo "<script type='text/javascript'>alert('Произошла ошибка при переносе сеансов: " . $e->getMessage() . "');</script>";
          echo "<script>location.href='page2.php';</script>";
          $pdo->rollBack();
          exit();
        }
      }
    }
      
?>