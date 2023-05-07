class CustomDialog extends HTMLElement {
    constructor() {
      super();
  
      // Создаем кастомное диалоговое окно
      const dialog = document.createElement('div');
      dialog.classList.add('custom-dialog');
      dialog.style.zIndex = '9999'; // добавляем стиль z-index
  
      // Создаем содержимое окна
      const content = document.createElement('div');
      content.classList.add('custom-dialog-content');
      dialog.appendChild(content);
  
      // Создаем заголовок окна
      const title = document.createElement('h2');
      title.classList.add('custom-dialog-title');
      content.appendChild(title);
  
      // Создаем текст сообщения
      const messageElement = document.createElement('p');
      messageElement.classList.add('custom-dialog-message');
      content.appendChild(messageElement);
  
      // Создаем кнопку закрытия окна
      const closeButton = document.createElement('button');
      closeButton.classList.add('custom-dialog-close');
      closeButton.innerText = 'OK';
      closeButton.addEventListener('click', () => {
        this.close();
      });
      content.appendChild(closeButton);
  
      // Добавляем окно на страницу
      document.body.appendChild(dialog);
  
      this.dialog = dialog;
      this.titleElement = title;
      this.messageElement = messageElement;
      this.closeButton = closeButton;
      this.show = this.show.bind(this);
      this.close = this.close.bind(this);
    }
  
    connectedCallback() {
      this.closeButton.addEventListener('click', this.close);
      this.dispatchEvent(new CustomEvent('ready'));
    }
  
    disconnectedCallback() {
      this.closeButton.removeEventListener('click', this.close);
    }
  
    close() {
      this.dialog.style.display = 'none';
      this.dispatchEvent(new CustomEvent('close'));
    }
  
    show(title, message, type) {
        // Задаем заголовок окна и стиль в зависимости от типа сообщения
        this.titleElement.textContent = title;
        if (type === 'error') {
            this.dialog.classList.add('error');
        } else if (type === 'success') {
            this.dialog.classList.add('success');
        } else {
            this.dialog.classList.remove('error', 'success');
        }
        
        // Задаем текст сообщения
        this.messageElement.textContent = message;
        
        // Показываем окно
        this.dialog.style.display = 'flex';
        this.dispatchEvent(new CustomEvent('show'));
    }    
  }
  
  customElements.define('custom-dialog', CustomDialog);
  