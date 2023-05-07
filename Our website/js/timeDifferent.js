// Обработчик событий, вызывающийся при выборе даты и времени
var dateTimePicker = document.getElementById('date-time-picker');
if (dateTimePicker) { 
  dateTimePicker.addEventListener("change", function() {
    var modal = new CustomDialog();
    var customerTime = document.getElementById("customer_time");
    customerTime.innerHTML = "Time of your recording: ";
    var timeDiffElement = document.getElementById("specialist_time");
    timeDiffElement.innerHTML = "Specialist time: ";
    var selectedDate = moment(dateTimePicker.value);

    // Получение текущей даты в часовом поясе Канкуна
    var currentDateTime = moment.tz("America/Cancun");

    // Сравнение выбранной даты с текущей датой в часовом поясе Канкуна
    if (selectedDate.isBefore(currentDateTime)) {
      // обработка ошибки, если выбранная дата меньше текущей даты
      modal.show('Error!', 'The selected date must be greater than the selected one!', 'error');
      // alert("The selected date must be greater than the selected one!");
      return;
    }

    // Преобразование выбранной даты в часовой пояс города специалиста (Канкун)
    var specialistCityTime = selectedDate.clone().tz("America/Cancun");

    // Форматирование даты и времени в нужный формат
    var formattedDateTime = specialistCityTime.format("YYYY-MM-DD HH:mm:ss");
    var formattedCustomerTime = selectedDate.format("YYYY-MM-DD HH:mm:ss");

    // Отображение даты и времени на странице
    timeDiffElement.innerHTML += "<span id='timeDifference'>"+formattedDateTime+"</span>";
    customerTime.innerHTML += "<span id='customerTime'>"+formattedCustomerTime+"</span>";    
  });
}
