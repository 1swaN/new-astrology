<?php
// Подключение к бд
$host = 'localhost';
$dbname = 'site2';
$username = 'root';
$password = '';

if (isset($_POST['session_ids'])) {
    $session_ids = $_POST['session_ids'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();
        foreach ($session_ids as $id) {
            // Проверка статуса сессии
            $query = $pdo->prepare("SELECT status FROM sessions WHERE id = :id");
            $query->bindValue(':id', $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $status = $result['status'];

            // Закрытие сессии, если изначально она была открыта
            if ($status != 'Closed') {
                $stmt = $pdo->prepare("DELETE FROM sessions WHERE id = :id");
                $stmt->bindValue(':id', $id);
                if ($stmt->execute()) {
                    echo "<script type='text/javascript'>alert('Сеанс успешно закрыт!');</script>";
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }
            } 
        }
        $pdo->commit();
        // Возвращение на страницу с админкой после всей действий
        echo "<script>location.href='page2.php';</script>";
        exit();
    } catch (PDOException $e) {
        $pdo->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<script type='text/javascript'>alert('Вы не выбрали ни одной записи для закрытия сеанса!');</script>";
    echo "<script>location.href='page2.php';</script>";
}
?>
