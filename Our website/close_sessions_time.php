<?php
    // Connect to database
    $host = 'localhost';
    $dbname = 'test_db';
    $username = 'root';
    $password = '';
  
    if (isset($_POST['close_all_sessions_Time'])) 
    {
        $selected_time = $_POST['close_all_sessions_Time'];
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // Close the session only if it is not already closed
            $today = date('Y-m-d');
        
            $end_time = $today.' '.date('H:i:s', strtotime("23:59:59"));
            //echo "Конечное время: ".$end_time."</br>";
            
            $final_selected_time = date('H:i', strtotime($selected_time));   
            $got_Date = $today.' '.$final_selected_time; 
            //echo "Выбранная дата и время: ".$got_Date."</br>";
            $stmt = $pdo->prepare("DELETE FROM sessions WHERE start_time >= ? AND end_time < ?");
            $stmt->bindValue("ss", $got_Date, $end_time);
            // Execute the query
            $stmt->execute();
            // Close the statement and the database connection
            if (!$stmt->execute()) {
                echo "Ошибка выполнения команды: " . $stmt->error;
            } else {
                echo "<script type='text/javascript'>alert('Все сеансы после выбранного времени успешно закрыты!');</script>";
                // Redirect back to main page
                echo "<script>location.href='page2.php';</script>";
                exit();
                $stmt->close();
                $pdo->close();
            }
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }  
?>
