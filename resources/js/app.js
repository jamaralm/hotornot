import './bootstrap';

// public/js/app.js

document.addEventListener('DOMContentLoaded', () => {
    // 1. Lógica para esconder a mensagem 'success' após alguns segundos
    const successMessage = document.querySelector('.alert-success');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000); // Esconde após 5 segundos
    }

    // 2. Animação de botão ao clicar (para a view create)
    const submitButton = document.querySelector('form button[type="submit"]');
    if (submitButton) {
        submitButton.addEventListener('click', function() {
            this.innerText = 'Processando...';
            this.style.backgroundColor = '#ffc107'; // Amarelo
            this.disabled = true;
        });
    }
});