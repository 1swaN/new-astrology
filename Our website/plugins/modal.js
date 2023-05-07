const modalOpen = document.querySelector('.info__sign')
const form = document.querySelector('.modal-form')
const Alert = document.querySelector('.alert');
const closeAlert = document.querySelector('.close');
const showUserAlertBtn = document.querySelector('.form__btn');
const accordion = document.querySelector('.accordion')
const panel = document.querySelector('.panel')



// _- системная функция, которая должна быть private
function _createModal(options){
    const modal = document.createElement('div')
    modal.classList.add('modal')
    modal.insertAdjacentHTML('afterbegin',`
            <div class="modal-overlay" data-close="true">
            <div class="modal-window" data-close>
                <form class="modal-form" name="modal-form" onsubmit="validate()">
                    <p data-translate="form__info" class="modal__header">Информация о вас</p>
                    <div class="modal-top modal-separator">
                        <div class="modal-top__left">
                            <div class="fields centered-column">
                                <div class="fields-name">
                                    <label data-translate="customerNameField" class="field__name">Ваше имя</label>
                                    <input type="text" class="POST-name field" name="customerName" required="required" minlength="2">
                                </div>
                                <div class="field-surname">
                                    <label data-translate="customerSurnameField" class="field__name">Ваша фамилия</label>
                                    <input type="text" class="POST-surname field" name="customerSurname" required="required" minlength="3">
                                </div>
                            </div>
                        </div>
                        <div class="modal-top__right centered-column">
                            <div class="right-email">
                                <label data-translate="emailTitle" class="field__name">Ваш e-mail</label>
                                <input type="email" class="POST-email field" id="email-field" name="customerEmail" required="required">
                            </div>
                            <div class="datetime">
                                <label data-translate="datetime__title" class="datetime__title">Выберите удобные дату и время</label>
                                <input class="input-datetime field" type="datetime-local" name="date-time-picker" id="date-time-picker" required="required"> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-mid modal-separator">
                        <div class="modal-mid__left">
                            <p data-translate="services__title" class="services__title">Услуги</p>
                            <label class="services__lbl label" for="tarot">
                                <input class="label-splitter" type="checkbox" id="tarot" name="check[]">Гадание по картам Таро
                            </label><br>
                            <label class="services__lbl label" for="hand">
                                <input class="label-splitter" type="checkbox" id="hand" name="check[]">Гадание по руке
                            </label><br>
                            <label class="services__lbl label" for="prediction">
                                <input class="label-splitter" type="checkbox" id="prediction" name="check[]">Астрологический прогноз на будущее
                            </label><br>
                        </div>
                        <div class="modal-mid__right">
                            <p data-translate="languageOfTheSessionTitle" class="buttons__title">Язык сеанса</p>
                            <label class="radio__lbl label" for="eng">
                                <input type="radio" name="fav_language" id="eng" value="English" class="radio__btn label-splitter" required="required">English
                            </label><br>
                            <label class="radio__lbl label" for="esp">
                                <input type="radio" name="fav_language" id="esp" value="Español" class="radio__btn label-splitter" required="required">Español
                            </label><br>
                            <label class="radio__lbl label" for="rus">
                                <input type="radio" name="fav_language" id="rus" value="Русский" class="radio__btn label-splitter" required="required">Русский
                            </label><br>
                        </div>
                    </div>
                    <p data-translate="warningTitle" class="accordion">Предупреждение!</p>
                    <div class="panel">
                        <p data-translate="timeDifference" class="warning__text">Ваше время и время специалиста отличаются на: </p>
                        <p data-translate="customerTime" class="customer-time" id="customer_time">Время вашей записи: </p>
                        <p data-translate="specialistTime" class="specialist-time" id="specialist_time">Время специалиста: </p>

                        <label for="mailing">
                        <input data-translate="mailingCheck" type="checkbox" name="mailing" id="mailing"> Получить уведомление о записи на e-mail
                        </label>
                        

                        <label for="reminder">
                            <input data-translate="reminderCheck" type="checkbox" name="reminder" id="reminder"> Получить напоминание о сеансе за 12 часов
                        </label>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="submit" data-translate="submit_button" value="Отправить" id="submitButton" class="form__btn btn-skin">
                    </div>
                </form>
            </div>
        </div>
        `)
    document.body.appendChild(modal)
    return modal
}

// функционал модального окна через замыкание
$.modal = function(options) {
    const ANIMATION_SPEED = 400
    const $modal = _createModal(options)
    // защита от некорректного поведения при открытии/закрытии
    let closing = false
    let destroyed = false


    const modal = {
        open(){
            if(destroyed) {
                return console.log('modal is destroyed')
            }
            !closing && $modal.classList.add('open')
        },
        close(){
            closing = true
            $modal.classList.remove('open')
            $modal.classList.add('hide')           
            setTimeout(() => {
                $modal.classList.remove('hide')
                closing = false
            }, ANIMATION_SPEED)
        },
    }


    modalOpen.addEventListener('click', () => {
        modal.open()
    })


    const listener = ev => {
        if(ev.target.dataset.close){
            console.log(ev.target)
            document.querySelector('.modal-form').reset()
            modal.close()
        }
    }

    $modal.addEventListener('click', listener)


    // добавляем к объекту modal метод destroy (очищает события и убирает эл-т из DOM)
    return Object.assign(modal, {
        destroy(){
            $modal.parentNode.removeChild($modal)
            $modal.removeEventListener('click', listener)
            destroyed = true
        }
    })
}


