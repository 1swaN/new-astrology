<?php

//session_start();
require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";
require "./PHPMailer/src/Exception.php";
header ("Content-Type:text/html; charset=UTF-8", false);

// запрет кэширования
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0", false);
header("Cache-Control: max-age=0", false);
header("Pragma: no-cache");

mb_internal_encoding("UTF-8");
error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

function sendMail($emailTo, $customer_fio, $selectedDate, $selectedLanguage, $SelectedServices)
{
  $to = $emailTo;
  switch ($selectedLanguage) {
    case "Русский":
      $subject = 'Запись к специалисту по астрологии';
      $mail = new PHPMailer\PHPMailer\PHPMailer();
      // настройки для отправки сообщений через SMTP
      $mail->isSMTP();
      $mail->CharSet = 'UTF-8';
      $mail->SMTPDebug = 2;
      $mail->Debugoutput = 'html';
      $smtp_server = $mail->Host = "ssl://smtp.mail.ru";
      $mail->SMTPAuth = true;
      $username = $mail->Username = "dmitriy.kuznecov.99@list.ru";
      $password = $mail->Password = "i5r2VBzARy9K1LP7nQjK";
      $mail->SMTPSecure = 'SSL';
      $smtp_port = $mail->Port = 465;
      $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
      // $smtp_conn = fsockopen($smtp_server, $smtp_port, $errno, $errstr, 30);
      // if (!$smtp_conn) {
      //   echo "Ошибка соединения с SMTP-сервером: $errstr ($errno)\n";
      // } else {
      //   $response = fgets($smtp_conn, 515);
      //   echo $response;

      //   fputs($smtp_conn, "EHLO $smtp_server\r\n");
      //   $response = fgets($smtp_conn, 515);
      //   echo $response;
  
      //   fputs($smtp_conn, "AUTH LOGIN\r\n");
      //   $response = fgets($smtp_conn, 515);
      //   echo $response;
  
      //   fputs($smtp_conn, base64_encode("$username") . "\r\n");
      //   $response = fgets($smtp_conn, 515);
      //   echo $response;
  
      //   fputs($smtp_conn, base64_encode("$password") . "\r\n");
      //   $response = fgets($smtp_conn, 515);
      //   echo $response;
  
      //   fputs($smtp_conn, "QUIT\r\n");
      //   fclose($smtp_conn);
      // }

      // устанавливаем параметры сообщения
      $mail->SetFrom('dmitriy.kuznecov.99@list.ru', 'Dmitriy');
      $mail->isHTML(true);
      $mail->Subject = "Сеанс по астрологии";
      $mail->Body = 
      "<html>
      <head>
        <link
          rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
        />
        <title>Ваша запись на сеанс</title>
      </head>
    <body style='font-family: Verdana, Geneva, sans-serif;'>
      <table>
        <tr>
          <td style='background: -webkit-linear-gradient(90deg, #040d2c,#462a8b,#8d05d6);background: linear-gradient(90deg, #040d2c,#462a8b,#8d05d6);'>
          <div style='margin: 100px auto;width: 650px;padding: 50px;background-color: #fff;border-radius: 15px;'>
          <p style='font-size: 1.3em;'>Дорогой $customer_fio, мы благодарны Вам за запись на сеанс:</p>
          <p style='text-align: center;font-size: 1.5em;margin-bottom: 15px;'>Детали записи на сеанс</p>
          <div style='margin: auto;width: 550px;border-bottom: 1px solid #e5e9f2;border-top: 1px solid #e5e9f2;padding: 15px 0;'>
            <table style='display: block;border-radius: 10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;-khtml-border-radius: 10px;border: 1px solid #59178f;border-collapse: collapse;'>
              <tbody>
              <tr style=' border-bottom: 1px solid #59178f;'>
              <th
                style='border-top-left-radius: 9px;padding: 15px;border-right: 1px solid #59178f;background-color: #8c52bb;color: #fff;text-align: left;width: 250px;'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' style='width:22px; height:22px; padding-right:5px; color:#ffffff'><path d='M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z'/></svg>Email заказчика
              </th>
              <td style='padding: 15px;text-align: center;width: 326px;'>$emailTo</td>
            </tr>
            <tr style=' border-bottom: 1px solid #59178f;'>
              <th style='padding: 15px;border-right: 1px solid #59178f;background-color: #8c52bb;color: #ffffff;text-align: left;width: 250px;'>
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' style='width:22px; height:22px; padding-right:5px; color:#ffffff'><path d='M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z'/></svg>День и дата записи
              </th>
              <td style='padding: 15px;text-align: center;width: 326px;'>$selectedDate</td>
            </tr>
            <tr style=' border-bottom: 1px solid #59178f;'>
              <th style='padding: 15px;border-right: 1px solid #59178f;background-color: #8c52bb;color: #ffffff;text-align: left;width: 250px;'>
<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512' style='width:22px; height:22px; padding-right:5px; color:#ffffff'><path d='M0 128C0 92.7 28.7 64 64 64H256h48 16H576c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H320 304 256 64c-35.3 0-64-28.7-64-64V128zm320 0V384H576V128H320zM178.3 175.9c-3.2-7.2-10.4-11.9-18.3-11.9s-15.1 4.7-18.3 11.9l-64 144c-4.5 10.1 .1 21.9 10.2 26.4s21.9-.1 26.4-10.2l8.9-20.1h73.6l8.9 20.1c4.5 10.1 16.3 14.6 26.4 10.2s14.6-16.3 10.2-26.4l-64-144zM160 233.2L179 276H141l19-42.8zM448 164c11 0 20 9 20 20v4h44 16c11 0 20 9 20 20s-9 20-20 20h-2l-1.6 4.5c-8.9 24.4-22.4 46.6-39.6 65.4c.9 .6 1.8 1.1 2.7 1.6l18.9 11.3c9.5 5.7 12.5 18 6.9 27.4s-18 12.5-27.4 6.9l-18.9-11.3c-4.5-2.7-8.8-5.5-13.1-8.5c-10.6 7.5-21.9 14-34 19.4l-3.6 1.6c-10.1 4.5-21.9-.1-26.4-10.2s.1-21.9 10.2-26.4l3.6-1.6c6.4-2.9 12.6-6.1 18.5-9.8l-12.2-12.2c-7.8-7.8-7.8-20.5 0-28.3s20.5-7.8 28.3 0l14.6 14.6 .5 .5c12.4-13.1 22.5-28.3 29.8-45H448 376c-11 0-20-9-20-20s9-20 20-20h52v-4c0-11 9-20 20-20z'/></svg>Язык сеанса
              </th>
              <td style='padding: 15px;text-align: center;width: 326px;'>$selectedLanguage</td>
            </tr>
            <tr>
              <th
                style='border-bottom-left-radius: 9px; padding: 15px;border-right: 1px solid #59178f;background-color: #8c52bb;color: #ffffff;text-align: left;width: 250px;'
              >
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' style='width:20px; height:20px; padding-right:5px; color:#ffffff'><path d='M216 64c-13.3 0-24 10.7-24 24s10.7 24 24 24h16v33.3C119.6 157.2 32 252.4 32 368H480c0-115.6-87.6-210.8-200-222.7V112h16c13.3 0 24-10.7 24-24s-10.7-24-24-24H256 216zM24 400c-13.3 0-24 10.7-24 24s10.7 24 24 24H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H24z'/></svg>Выбранные услуги
              </th>
              <td style='padding: 15px;text-align: center;width: 326px;'>$SelectedServices</td>
            </tr>
              </tbody>
            </table>
          </div>
          <p style='font-size: 1.3em;'>
            С наилучшими пожеланиями, <br />
            Елена!
          </p>
        </div>
          </td>
        </tr>
      </table>
    </body>
</html>;";
      
      // добавляем получателей
      $mail->addAddress($to);
      try {
        // отправляем сообщение
        $mail->Send();
        echo "<script type='text/javascript'>alert('Сообщение со всеми подробностями о записи на сеанс было отправлено Вам на почту!');</script>";
      } catch (Exception $e) {
        echo "<script type='text/javascript'>alert('Сообщение не отправлено ');</script>".$mail->ErrorInfo;
      }
      exit;
  }
}


class AjaxController
{ 
  function reminder() {
    while (true) {
      // Подключаемся к базе данных
      $db = new mysqli("localhost", "root", "", "site2");

      // Получаем текущую дату и время
      $current_time = time();

      // Получаем дату и время начала сеанса
      $result = $db->query("SELECT start_time, Email, language FROM sessions WHERE reminder = 1");
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $start_time = strtotime($row["start_time"]);
          $email = $row["email"];
          $customer_Language = $row["language"];
          
          // Проверяем, что сеанс начинается через 12 часов
          if (($start_time - $current_time) == (12 * 60 * 60)) {
            
            // Отправляем email-напоминание
            $to = $email;
            switch ($customer_Language) {
              case "Русский":
                $subject = 'Запись к специалисту по астрологии';
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                // настройки для отправки сообщений через SMTP
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 2;
                $mail->Debugoutput = 'html';
                $smtp_server = $mail->Host = "ssl://smtp.mail.ru";
                $mail->SMTPAuth = true;
                $username = $mail->Username = "dmitriy.kuznecov.99@list.ru";
                $password = $mail->Password = "i5r2VBzARy9K1LP7nQjK";
                $mail->SMTPSecure = 'SSL';
                $smtp_port = $mail->Port = 465;
                $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
                // $smtp_conn = fsockopen($smtp_server, $smtp_port, $errno, $errstr, 30);
                // if (!$smtp_conn) {
                //   echo "Ошибка соединения с SMTP-сервером: $errstr ($errno)\n";
                // } else {
                //   $response = fgets($smtp_conn, 515);
                //   echo $response;
          
                //   fputs($smtp_conn, "EHLO $smtp_server\r\n");
                //   $response = fgets($smtp_conn, 515);
                //   echo $response;
            
                //   fputs($smtp_conn, "AUTH LOGIN\r\n");
                //   $response = fgets($smtp_conn, 515);
                //   echo $response;
            
                //   fputs($smtp_conn, base64_encode("$username") . "\r\n");
                //   $response = fgets($smtp_conn, 515);
                //   echo $response;
            
                //   fputs($smtp_conn, base64_encode("$password") . "\r\n");
                //   $response = fgets($smtp_conn, 515);
                //   echo $response;
            
                //   fputs($smtp_conn, "QUIT\r\n");
                //   fclose($smtp_conn);
                // }
          
                // устанавливаем параметры сообщения
                $mail->SetFrom('dmitriy.kuznecov.99@list.ru', 'Dmitriy');
                $mail->isHTML(true);
                $mail->Subject = "Сеанс по астрологии";
                $mail->Body = 
                "<html>
                    <head>
                      <link rel='preconnect' href='https://fonts.googleapis.com'/>
                      <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
                      <link
                        href='https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;700&display=swap'
                        rel='stylesheet'
                      />
                      <link
                        rel='stylesheet'
                        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'
                      />
                      <link rel='stylesheet' href='./css/letterStyle.css' />
                      <title>Ваша запись на сеанс</title>
                    </head>
                  <body style='font-family: 'El Messiri', sans-serif'; background-image: url(https://drive.google.com/file/d/1PenLkEl0Da95c16YT3KPYJSZJhaAvWYa/view?usp=share_link);>
                    <div class='letter' style='margin: 100px auto; width: 650px; padding: 50px;background-color: #fff; border-radius: 15px;'>
                      <p class='additional_text' style='font-size: 1.3em;'>Дорогой $customer_fio, мы напоминаем Вам, что через 12 часов у Вас начнется астрологический сеанс!:</p>
                      <p class='notification-header' style='text-align: center; font-size: 1.5em; margin-bottom: 15px;'>Детали записи на сеанс</p>
                      <div class='table-container' style='margin: auto; width: 550px; border-bottom: 1px solid #e5e9f2; border-top: 1px solid #e5e9f2; padding: 15px 0; '>
                        <table class='table' style='display: block; border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px; border: 1px solid #59178f; border-collapse: collapse;'>
                          <tbody>
                            <tr style='border-bottom: 1px solid #59178f;'>
                              <th style='border-top-left-radius: 9px'; text-align: left; width: 200px;>
                                <i class='fa-regular fa-envelope' style='width: 22px; height: 22px; padding-right: 5px; color: #fff'></i>Email заказчика
                              </th>
                              <td style='text-align: center; width: 326px;'>$emailTo</td>
                            </tr>
                            <tr style='border-bottom: 1px solid #59178f;'>
                              <th style='border-top-left-radius: 9px'; text-align: left; width: 200px;>
                                <i class='fa-solid fa-calendar-days' style='width: 22px; height: 22px; padding-right: 5px; color: #fff'></i>День и дата записи
                              </th>
                              <td style='text-align: center; width: 326px;>$selectedDate</td>
                            </tr>
                            <tr style='border-bottom: 1px solid #59178f;'>
                              <th style='border-top-left-radius: 9px'; text-align: left; width: 200px;>
                                <i class='fa-solid fa-language' style='width: 22px; height: 22px; padding-right: 5px; color: #fff'></i>Язык сеанса
                              </th>
                              <td style='text-align: center; width: 326px;>$selectedLanguage</td>
                            </tr>
                            <tr>
                              <th style='border-top-left-radius: 9px'; text-align: left; width: 200px;>
                                <i class='fa-solid fa-bell-concierge' style='width: 22px; height: 22px; padding-right: 5px; color: #fff'></i>Выбранные услуги
                              </th>
                              <td class='table-cell'>$SelectedServices</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <p class='additional_text'>
                        С наилучшими пожеланиями, <br />
                        Елена!
                      </p>
                    </div>
                  </body>
              </html>";
                
                // добавляем получателей
                $mail->addAddress($to);
                try {
                  // отправляем сообщение
                  $mail->Send();
                  echo "<script type='text/javascript'>alert('Сообщение со всеми подробностями о записи на сеанс было отправлено Вам на почту!');</script>";
                } catch (Exception $e) {
                  echo "<script type='text/javascript'>alert('Сообщение не отправлено ');</script>".$mail->ErrorInfo;
                }
                exit;
            }
            // Обновляем флажок напоминания
            $db->query("UPDATE sessions SET reminder = 0 WHERE start_time = '{$row['start_time']}'");
          }
        }
      }
      // Закрываем соединение с базой данных
      $db->close();
        // Задержка на 5 минут
        sleep(5 * 60);
      }
      reminder();
    }
  function __construct()
  {
    $xml      = simplexml_load_file(__DIR__.'/config/db_conf.xml');
    $host     = $xml->host[0];
    $dbname   = $xml->dbname[0];
    $user     = $xml->user[0];
    $password = $xml->password[0];
    $email    = $xml->email[0];
    $db       = $this->db = new \PDO('mysql: host='.$host.'; dbname='. $dbname, $user, $password);

    $db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
    $db->exec("SET NAMES 'utf8'");
    $db->exec("SET CHARACTER SET 'utf8'");
    $db->exec("SET SESSION collation_connection = 'utf8_general_ci'");
  }

  function setZakaz()
  {
    $customer_Name    = $this->escapeStr($_POST['customerName']);
    $customer_Surname = $this->escapeStr($_POST['customerSurname']);
    $customer_FIO     = $customer_Name.' '.$customer_Surname;
    $customer_Email   = $this->escapeStr($_POST['customerEmail']);
    $dateOfSession    = $this->escapeStr($_POST['date-time-picker']);
    $convertedDate    = date('Y-m-d H:i:s', strtotime($dateOfSession));
    $selectedServices = $this->escapeStr($_POST['gadanie']);
    $choosenLanguage  = $this->escapeStr2($_POST['fav_language']);
    $mailing          = ''; 
    $reminder         = '';
    // $server_timezone = date_default_timezone_get();
    // echo $server_timezone;
    if (isset($_POST['mailing'])) {
      $mailing = $this->escapeStr($_POST['mailing']);
    }
    if (isset($_POST['reminder'])) {
      $reminder = $this->escapeStr($_POST['reminder']);
    }
    // дата, выбранная пользователем
    $customerTime = $this->escapeStr($_POST['customerTime']);
    // Дата и время специалиста, находящегося в другом часовом поясе (Канкун)
    $timeDifference = $this->escapeStr($_POST['timeDifference']);
    if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $timeDifference)) {
      die('Некорректный формат даты');
    }
  
    //Преобразуем дату в UTC, чтобы можно было делать сравнение введенной даты и времени в дальнейшем с началом и концом рабочего дня специалиста
    $limitedDate = DateTime::createFromFormat('Y-m-d H:i:s', $timeDifference, new DateTimeZone('UTC')); 
    // echo $limitedDate->format('Y-m-d H:i:s').'</br>';
    if (!$limitedDate) {
      die('Некорректный формат даты');
    } else {
      // Делим дату на часы и дату, чтобы взять только время и прикрепить к нему выбранную пользователем дату для дальнейшего условия
      $limitedDateStr = $limitedDate->format('Y-m-d'); // Переменная для даты
      $limitedTimeStr = $limitedDate->format('H:i:s'); // Переменная для времени
      // echo 'Дата: '.$limitedDateStr.' '.'Время: '.$limitedTimeStr;
      // Клонирование даты, чтобы прибавить к ней полтора часа для добавления записи в базу данных. start_time в бд - начало сеанса, end_time - окончание сеанса спустя полтора часа после его начала
      $limitedEndTime = clone $limitedDate;
      $limitedEndTime->modify('+90 minutes');
      if (!$limitedEndTime) {
        die('Ошибка при создании даты окончания');
      }
      else {
        // описание переменных, отвечающих за начало и конец рабочего дня специалиста в часовом поясе UTC
        $startTime = DateTime::createFromFormat('Y-m-d H:i:s', $limitedDateStr . ' 07:30:00', new DateTimeZone('UTC')); // Переменная начала рабочего дня
        $endTime   = DateTime::createFromFormat('Y-m-d H:i:s', $limitedDateStr . ' 19:30:00', new DateTimeZone('UTC')); // Переменная конца рабочего дня
        // date_default_timezone_set("America/Cancun");

        // $timeDifference2 = -5; // разница в часах между Cancun и вашим часовым поясом
        // $timeNow = new DateTime("now", new DateTimeZone("UTC"));
        // $timeNow->modify($timeDifference2 . " hours");
        // $selectedTime = new DateTime($convertedDate, new DateTimeZone("America/Cancun"));
        // echo "Переменная dateOfSession: ".$dateOfSession."</br>";
        // echo "Переменная convertedDate: ".$convertedDate."</br>";
        // echo "Переменная customerTime: ".$customerTime."</br>";
        // echo "Переменная timeDifference: ".$timeDifference."</br>";
        // echo "Переменная limitedDate: ".$limitedDate->format("Y-m-d H:i:s")."</br>";
        // echo "Переменная limitedDateStr: ".$limitedDateStr."</br>";
        // echo "Переменная limitedTimeStr: ".$limitedTimeStr."</br>";
        // echo "Переменная limitedEndTime: ".$limitedEndTime->format("Y-m-d H:i:s")."</br>";
        // echo "Переменная startTime: ".$startTime->format("Y-m-d H:i:s")."</br>";
        // echo "Переменная endTime: ".$endTime->format("Y-m-d H:i:s")."</br>";
        // echo "Переменная timeNow: ".$timeNow->format("Y-m-d H:i:s")."</br>";
        // echo "Переменная selectedTime: ".$selectedTime->format("Y-m-d H:i:s")."</br>";    
       
          // проверка на то, что выбранная пользователем дата вписывается в нужные временные рамки
          if ((($limitedDate <= $startTime) && ($limitedDate >= $endTime)) || (($limitedDate <= $startTime) && ($limitedDate <= $endTime)) || (($limitedDate >= $startTime) && ($limitedDate >= $endTime))) {
            echo "<script>
            var dialog = new CustomDialog();
            dialog.show('Error', 'Специалист не сможет принять Вас в такое время!', 'error');
          </script>";
          }
          else {
            // запрос для получения имеющихся дат и времени в базе данных
            $sql = "SELECT * FROM sessions WHERE start_time <= :end_time AND end_time >= :start_time";
            // выполнение запроса с привязкой значений в этом же запросе
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(
                ':start_time' => $limitedDate->format('Y-m-d H:i:s'),
                ':end_time' => $limitedEndTime->format('Y-m-d H:i:s'),
            ));
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // проверяем, есть ли какие-то записи, которые пересекаются с выбранным пользователем временем
            if (count($rows) > 0) {
                echo "<script type='text/javascript'>alert('Ошибка записи! Время уже занято!');</script>";
            } 
            else {
              // запись данных в случае успешного прохождения всех условий
              $insert1 = $this->query(
                "INSERT INTO `customers` (`Email`, `Full_Name`, `selected_services`, `language`, `mailing`, `reminder`) 
                VALUES (?, ?, ?, ?, ?, ?)", 
                array($customer_Email, $customer_FIO, $selectedServices, $choosenLanguage, $mailing, $reminder), 1);
                $customer_id = $this->db->lastInsertId();
                $insert2 = $this->query(
              "INSERT INTO `sessions` (`customer_id`, `start_time`, `end_time`, `status`) 
              VALUES (?, ?, ?, ?)", 
              array($customer_id, $limitedDate->format('Y-m-d H:i:s'), $limitedEndTime->format('Y-m-d H:i:s'), 'Open'));
              // проверка на выполнение обоих запросов
              if ($insert1 !== false && $insert2 !== false) {
                if (!empty($mailing)) {
                  sendMail($customer_Email, $customer_FIO, $convertedDate, $choosenLanguage, $selectedServices);
                  exit;
                }
                else {
                  echo "<script type='text/javascript'>alert('Запись была успешно произведена!');</script>";
                }
              }
              else {
                echo "<script type='text/javascript'>alert('Ошибка записи в базу данных!');</script>";
              }
            } 
          }
        }        
      }  
    }
  
  // если передаёшь парам то возвращает количество затронутых строк? парам2 вернёт айдишник вставленной строки 
  public function query($query, array $values = array(), $param = false, $param2 = false)
  {
    try
    {
        $stmt = $this->db->prepare($query);
        $values_len = count($values);

        for ($i = 0; $i < $values_len; $i++) {
            $value = trim($values[$i]);
            if (preg_match('/^\d+$/', $value)) {
                $stmt->bindValue($i + 1, $value, \PDO::PARAM_INT);
            } else {
                $stmt->bindValue($i + 1, $value, \PDO::PARAM_STR);
            }
        }
        $stmt->execute($values);
        if (!$param) {
            return $stmt; // возвращаем объект PDOStatement
        } else {
            if ($param2) {
                return $this->db->lastInsertId();
            } else {
                return $stmt->rowCount();
            }
        }
    } catch (\PDOException $err) {
        echo 'Ошибка при выборке из БД ' . $err->getMessage() . '<br>
      в файле ' . $err->getFile() . ", строка " . $err->getLine() . "<br><br>Стэк вызовов: " . preg_replace('/#\d+/', '<br>$0', $err->getTraceAsString());
        exit;
    }
  }


  public function escapeStr2($str, $size = 0)
  {
    $str = trim($str);
    $str = preg_replace('/[`\'\"\(\)\[\]]/', '', $str);
    if($size)$str = mb_substr($str, 0, $size, "UTF-8");
    return $str;
  }

  public function escapeStr($str, $size = 0)
  {
    $str = trim($str);
    $str = preg_replace('/[`\'\"\(\)\[\]]/', '', $str);
    $str = htmlentities($str, ENT_QUOTES, "UTF-8");
    if($size)$str = mb_substr($str, 0, $size, "UTF-8");
    return $str;
  }


}

if(isset($_REQUEST['func'])){
  $func   = $_REQUEST['func'];
  $worker = new AjaxController;
  $worker->$func();
}
?>