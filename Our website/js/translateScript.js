const languageSelect = document.getElementById('language-select');
const translate = () => {
  const elements = document.querySelectorAll('[data-translate]');
  elements.forEach(element => {
    const key = element.getAttribute('data-translate');
    element.innerHTML = translations[currentLanguage][key];
  });
};

const translations = {
  en: {
    info__title: 'Astrology specialist - Helena',
    description: 'Higher-level considerations and further development of various forms of activity require us to systematically analyze the existing financial and administrative conditions.',
    info__sign: 'Sign up for a session',
    footer__rights: 'All rights reserved © 2023',
    customerNameField: 'Your name',
    customerSurnameField: 'Your surname',
    form__info: 'Information about you',
    datetime__title: 'Choose a convenient date and time',
    services__title: 'Choose all the services you want',
    languageOfTheSessionTitle: 'Choose the language for the session',
    emailTitle: 'Your e-mail',
    signButton: 'Sign up for a session',
    submit_button: 'Submit',
    warningTitle: 'Warning!',
    timeDifference: 'Your time and the specialists time differ by:',
    customerTime: 'Time of your recording',
    specialistTime: 'Specialist time',
    mailingCheck: 'Get a notification about an appointment by e-mail',
    reminderCheck: 'Get a session reminder 12 hours in advance'
  },
  esp: {
    info__title: 'Especialista en astrología - Helena',
    description: 'Las consideraciones de nivel superior y el desarrollo adicional de diversas formas de actividad nos obligan a analizar sistemáticamente las condiciones financieras y administrativas existentes.',
    info__sign: 'Regístrese para una sesión',
    footer__rights: 'Todos los derechos reservados © 2023',
    customerNameField: 'Tu nombre',
    customerSurnameField: 'Tu apellido',
    form__info: 'Información sobre ti',
    datetime__title: 'Elija una fecha y hora conveniente',
    services__title: 'Seleccione servicios',
    languageOfTheSessionTitle: 'Elija el idioma de la sesión',
    emailTitle: 'Tu Email',
    signButton: 'Regístrese para una sesión',
    submit_button: 'Presentar',
    warningTitle: '¡Advertencia!',
    timeDifference: 'Su tiempo y el tiempo del especialista difieren en:',
    customerTime: 'Tiempo de su grabación',
    specialistTime: 'Tiempo del especialista',
    mailingCheck: 'Recibir notificación de registro por correo electrónico',
    reminderCheck: 'Reciba un recordatorio de sesión 12 horas antes de la sesión'
  },
  rus: {
    info__title: 'Специалист по астрологии - Елена',
    description: 'Соображения высшего порядка, а также дальнейшее развитие различных форм деятельности требует от нас системного анализа существующих финансовых и административных условий.',
    info__sign: 'Записаться на сеанс',
    footer__rights: 'Все права защищены © 2023',
    customerNameField: 'Ваше имя',
    customerSurnameField: 'Ваша фамилия',
    form__info: 'Информация о вас',
    datetime__title: 'Выберите удобные дату и время',
    services__title: 'Выберите услуги',
    languageOfTheSessionTitle: 'Выберите язык',
    emailTitle: 'Ваш e-mail',
    signButton: 'Записаться на сеанс',
    submit_button: 'Подтвердить',
    warningTitle: 'Предупреждение!',
    timeDifference: 'Ваше время и время специалиста отличаются на:',
    customerTime: 'Время вашей записи',
    specialistTime: 'Время специалиста',
    mailingCheck: 'Получить уведомление о записи на e-mail',
    reminderCheck: 'Получить напоминание о сеансе за 12 часов'
  }
};

let currentLanguage = 'en';
translate();
languageSelect.addEventListener('click', (event) => {
  if (event.target && event.target.matches('.content__link')) {
    currentLanguage = event.target.getAttribute('data-lang');
    translate();
  }
});
