
/**
 * Scripts principais do site Nova Alternativa
 */

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips e popovers do Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Adicionar classe 'active' ao item de menu atual
    highlightCurrentNavItem();
    
    // Inicializar mascaras para campos
    setupInputMasks();
    
    // Validação de formulários
    setupFormValidation();
    
    // Efeitos de scroll
    setupScrollEffects();
});

/**
 * Destaca o item de menu atual com base na URL
 */
function highlightCurrentNavItem() {
    const currentPath = window.location.pathname;
    const searchParams = new URLSearchParams(window.location.search);
    const currentPage = searchParams.get('page') || 'home';
    
    document.querySelectorAll('.navbar-nav .nav-link').forEach(function(link) {
        // Remove active class from all links
        link.classList.remove('active');
        
        // Get the href value
        const href = link.getAttribute('href');
        if (!href) return;
        
        // Check if the current page matches the link
        if (href.includes('page=' + currentPage)) {
            link.classList.add('active');
        } else if (currentPage === 'home' && (href === 'index.php' || href === './')) {
            link.classList.add('active');
        }
    });
}

/**
 * Configura mascaras para campos de formulário
 */
function setupInputMasks() {
    // Telefone
    const telefoneInputs = document.querySelectorAll('input[name="telefone"]');
    if (telefoneInputs.length > 0) {
        telefoneInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);
                
                if (value.length > 6) {
                    value = `(${value.substring(0, 2)}) ${value.substring(2, 7)}-${value.substring(7)}`;
                } else if (value.length > 2) {
                    value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
                }
                
                e.target.value = value;
            });
        });
    }
    
    // CPF
    const cpfInputs = document.querySelectorAll('input[name="cpf"]');
    if (cpfInputs.length > 0) {
        cpfInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);
                
                if (value.length > 9) {
                    value = `${value.substring(0, 3)}.${value.substring(3, 6)}.${value.substring(6, 9)}-${value.substring(9)}`;
                } else if (value.length > 6) {
                    value = `${value.substring(0, 3)}.${value.substring(3, 6)}.${value.substring(6)}`;
                } else if (value.length > 3) {
                    value = `${value.substring(0, 3)}.${value.substring(3)}`;
                }
                
                e.target.value = value;
            });
        });
    }
    
    // CEP
    const cepInputs = document.querySelectorAll('input[name="cep"]');
    if (cepInputs.length > 0) {
        cepInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 8) value = value.substring(0, 8);
                
                if (value.length > 5) {
                    value = `${value.substring(0, 5)}-${value.substring(5)}`;
                }
                
                e.target.value = value;
            });
        });
    }
}

/**
 * Configura validação de formulários
 */
function setupFormValidation() {
    const forms = document.querySelectorAll('.needs-validation');
    
    if (forms.length > 0) {
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    }
}

/**
 * Configura efeitos de scroll
 */
function setupScrollEffects() {
    // Navbar fixa com detecção de scroll
    const navbar = document.querySelector('.header');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    }
    
    // Botão de voltar ao topo
    const backToTopButton = document.querySelector('.back-to-top');
    if (backToTopButton) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
        
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

/**
 * Exibe uma mensagem de alerta personalizada
 */
function showAlert(message, type = 'info') {
    const alertBox = document.createElement('div');
    alertBox.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
    alertBox.setAttribute('role', 'alert');
    alertBox.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    `;
    
    document.body.appendChild(alertBox);
    
    setTimeout(() => {
        const bsAlert = new bootstrap.Alert(alertBox);
        bsAlert.close();
    }, 5000);
}

/**
 * Utilitários para formulários
 */
const FormUtils = {
    /**
     * Valida um email
     */
    validateEmail: function(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    },
    
    /**
     * Valida um CPF
     */
    validateCPF: function(cpf) {
        cpf = cpf.replace(/[^\d]/g, '');
        if (cpf.length !== 11) return false;
        
        // Verifica se todos os dígitos são iguais
        if (/^(\d)\1{10}$/.test(cpf)) return false;
        
        let sum = 0;
        let remainder;
        
        // Primeiro dígito verificador
        for (let i = 1; i <= 9; i++) {
            sum += parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }
        
        remainder = (sum * 10) % 11;
        if (remainder === 10 || remainder === 11) remainder = 0;
        if (remainder !== parseInt(cpf.substring(9, 10))) return false;
        
        // Segundo dígito verificador
        sum = 0;
        for (let i = 1; i <= 10; i++) {
            sum += parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }
        
        remainder = (sum * 10) % 11;
        if (remainder === 10 || remainder === 11) remainder = 0;
        if (remainder !== parseInt(cpf.substring(10, 11))) return false;
        
        return true;
    },
    
    /**
     * Valida uma data no formato dd/mm/yyyy
     */
    validateDate: function(date) {
        const pattern = /^(\d{2})\/(\d{2})\/(\d{4})$/;
        if (!pattern.test(date)) return false;
        
        const parts = date.split('/');
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10);
        const year = parseInt(parts[2], 10);
        
        if (year < 1900 || year > 3000 || month === 0 || month > 12) return false;
        
        const monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        
        // Ajuste para anos bissextos
        if (year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0)) {
            monthLength[1] = 29;
        }
        
        return day > 0 && day <= monthLength[month - 1];
    }
};
