
// Scripts para o sistema de gestão de condomínios

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips do Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    
    // Inicializar popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });
    
    // Animação de fade-in para elementos com classe .fade-in
    document.querySelectorAll('.fade-in').forEach(function(element) {
        element.style.opacity = '0';
        setTimeout(function() {
            element.style.opacity = '1';
            element.style.transition = 'opacity 0.6s ease-in';
        }, 100);
    });
    
    // Adicionar classe 'active' ao link de navegação atual
    var currentLocation = window.location.href;
    document.querySelectorAll('.navbar-nav .nav-link').forEach(function(link) {
        if (link.href === currentLocation) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page');
        }
    });
    
    // Máscaras para campos específicos
    var telefoneInputs = document.querySelectorAll('input[name="telefone"]');
    if (telefoneInputs.length > 0) {
        telefoneInputs.forEach(function(input) {
            input.addEventListener('input', function(e) {
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
                e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            });
        });
    }
    
    var cpfInputs = document.querySelectorAll('input[name="cpf"]');
    if (cpfInputs.length > 0) {
        cpfInputs.forEach(function(input) {
            input.addEventListener('input', function(e) {
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
                e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' + x[3] : '') + (x[4] ? '-' + x[4] : '');
            });
        });
    }
    
    // Validação de formulários
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
    
    // Função para alternar visibilidade de senha
    var togglePasswordBtns = document.querySelectorAll('.toggle-password');
    if (togglePasswordBtns.length > 0) {
        togglePasswordBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.querySelector(btn.getAttribute('data-target'));
                if (input.type === 'password') {
                    input.type = 'text';
                    btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    btn.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    }
});

// Manipulação de visualização de tickets
function expandTicket(id) {
    var content = document.getElementById('ticket-content-' + id);
    if (content) {
        content.classList.toggle('d-none');
    }
}

// Confirmação de exclusão
function confirmarExclusao(message, callback) {
    if (confirm(message)) {
        callback();
    }
}

// Recarregar captcha
function recarregarCaptcha() {
    document.getElementById('captcha-image').src = 'includes/captcha.php?' + new Date().getTime();
}
