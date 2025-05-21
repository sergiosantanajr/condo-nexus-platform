
<?php
// Definir título da página
$titulo = "Início";
$paginaAtual = 'home';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="fade-in">Gestão de Condomínios Simplificada</h1>
                <p class="lead mb-4 fade-in">Solução completa para administrar seu condomínio com eficiência, transparência e facilidade de uso.</p>
                <div class="fade-in">
                    <a href="index.php?page=contato" class="btn btn-primary btn-lg me-2">Solicite uma Demonstração</a>
                    <a href="index.php?page=servicos" class="btn btn-light btn-lg">Conheça Nossos Serviços</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold">Por que escolher nossa solução?</h2>
                <p class="lead text-muted">Oferecemos ferramentas completas para facilitar a gestão do seu condomínio.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card card p-4 text-center h-100">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="h4 mb-3">Gestão Completa</h3>
                    <p class="card-text mb-0">Administre todos os aspectos do seu condomínio em uma única plataforma intuitiva e fácil de usar.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card card p-4 text-center h-100">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h3 class="h4 mb-3">Controle Financeiro</h3>
                    <p class="card-text mb-0">Controle de receitas, despesas, geração de boletos e relatórios financeiros detalhados.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card card p-4 text-center h-100">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="h4 mb-3">Comunicação Eficaz</h3>
                    <p class="card-text mb-0">Sistema de comunicação direta entre moradores, síndicos e administradora para resolver problemas rapidamente.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Condominiums Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold">Empreendimentos que confiam em nós</h2>
                <p class="lead">Condomínios de diferentes perfis utilizam nossa plataforma para otimizar sua gestão.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <img src="assets/img/condominio1.jpg" class="card-img-top" alt="Condomínio Residencial">
                    <div class="card-body">
                        <h3 class="h5 card-title">Residencial Villa Nova</h3>
                        <p class="card-text">Condomínio residencial vertical com 120 unidades que utiliza nosso sistema há mais de 3 anos.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <img src="assets/img/condominio2.jpg" class="card-img-top" alt="Condomínio Comercial">
                    <div class="card-body">
                        <h3 class="h5 card-title">Comercial Plaza Center</h3>
                        <p class="card-text">Condomínio comercial com 45 salas e 15 lojas, gerenciando reservas de espaços e controle de acesso.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <img src="assets/img/condominio3.jpg" class="card-img-top" alt="Condomínio Horizontal">
                    <div class="card-body">
                        <h3 class="h5 card-title">Casas do Lago</h3>
                        <p class="card-text">Condomínio horizontal com 65 casas, utilizando nossos recursos de segurança e área de lazer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold">O que dizem nossos clientes</h2>
                <p class="lead text-muted">Síndicos e moradores compartilham suas experiências com nossa solução.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="testimonial">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                        <h4 class="h5">Carlos Mendes</h4>
                        <p class="text-muted">Síndico - Residencial Villa Nova</p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="fst-italic">"A plataforma simplificou toda a gestão do nosso condomínio. O sistema de tickets e reservas é excelente e o controle financeiro nos ajudou a reduzir a inadimplência."</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testimonial">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                        <h4 class="h5">Maria Oliveira</h4>
                        <p class="text-muted">Moradora - Casas do Lago</p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="fst-italic">"O app é super fácil de usar. Consigo pagar meu condomínio, agendar uso das áreas comuns e reportar problemas, tudo pelo celular!"</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testimonial">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                        <h4 class="h5">Roberto Almeida</h4>
                        <p class="text-muted">Administrador - Plaza Center</p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="fst-italic">"O suporte da equipe é excepcional. Sempre respondem rapidamente e as atualizações constantes trazem melhorias que facilitam nosso trabalho diário."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold">Pronto para simplificar a gestão do seu condomínio?</h2>
                <p class="lead mb-0">Entre em contato conosco e descubra como podemos ajudar.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="index.php?page=contato" class="btn btn-light btn-lg">Fale Conosco</a>
            </div>
        </div>
    </div>
</section>
