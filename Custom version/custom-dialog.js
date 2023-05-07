class CustomDialog extends HTMLElement {
	constructor() {
	  super();
  
	  // Создаем кастомное диалоговое окно
	  const dialog = document.createElement('div');
	  dialog.classList.add('custom-dialog');
  
	  // Создаем содержимое окна
	  const content = document.createElement('div');
	  content.classList.add('custom-dialog-content');
	  dialog.appendChild(content);
  
	  // Создаем заголовок окна
	  const title = document.createElement('h2');
	  title.innerText = 'Заголовок окна';
	  content.appendChild(title);
  
	  // Создаем текст сообщения
	  this.messageElement = document.createElement('p');
	  this.messageElement.classList.add('custom-dialog-message');
	  content.appendChild(this.messageElement);
  
	  // Создаем кнопку закрытия окна
	  this.closeButton = document.createElement('button');
	  this.closeButton.classList.add('custom-dialog-close');
	  this.closeButton.innerText = 'OK';
	  this.closeButton.addEventListener('click', () => {
		dialog.remove();
	  });
	  content.appendChild(this.closeButton);
  
	  // Добавляем окно на страницу
	  document.body.appendChild(dialog);
  
	  this.dialog = dialog;
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
  
	show(message) {
	  this.messageElement.textContent = message;
	  this.dialog.style.display = 'flex';
	  this.dispatchEvent(new CustomEvent('show'));
	}
  }
  customElements.define('custom-dialog', CustomDialog);
  
//   document.addEventListener('DOMContentLoaded', () => {
// 	const customDialog = document.querySelector('custom-dialog');
// 	const dialogButton = document.querySelector('#custom-dialog-button');
// 	dialogButton.addEventListener('click', () => {
// 	  customDialog.show('Hello, world!');
// 	});
//   });
  
  