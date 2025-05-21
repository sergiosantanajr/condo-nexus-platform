
<?php
// Definir título da página
$titulo = "Início";

// Obter serviços e depoimentos
$servicos = obterServicos();
$depoimentos = obterDepoimentos(3);
?>

<!-- Banner Principal -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Gestão de Condomínios com Excelência</h1>
                <p class="lead mb-4">Soluções completas para administração de condomínios, tornando a gestão mais eficiente e transparente.</p>
                <div class="d-flex gap-3">
                    <a href="index.php?page=servicos" class="btn btn-primary btn-lg">Conheça Nossos Serviços</a>
                    <a href="index.php?page=contato" class="btn btn-outline-secondary btn-lg">Solicite um Orçamento</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="assets/img/hero-image.jpg" alt="Gestão de Condomínios" class="img-fluid rounded shadow-lg mt-5 mt-lg-0">
            </div>
        </div>
    </div>
</section>

<!-- Seção de Serviços -->
<section class="services-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="h1 mb-3">Nossos Serviços</h2>
            <p class="lead">Oferecemos soluções completas para a gestão eficiente do seu condomínio</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($servicos as $servico): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="service-icon mb-4">
                                <i class="fas fa-<?php echo $servico['icone']; ?> fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title"><?php echo $servico['nome']; ?></h5>
                            <p class="card-text"><?php echo limitarTexto($servico['descricao'], 100); ?></p>
                            <a href="index.php?page=servicos" class="btn btn-sm btn-outline-primary mt-3">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="index.php?page=servicos" class="btn btn-primary">Ver Todos os Serviços</a>
        </div>
    </div>
</section>

<!-- Seção Por que Escolher -->
<section class="why-choose-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="assets/img/why-choose-us.jpg" alt="Por que nos escolher" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6">
                <div class="section-header mb-4">
                    <h2 class="h1 mb-3">Por que escolher a Nova Alternativa?</h2>
                    <p class="lead">Nossa empresa oferece um serviço diferenciado com foco na qualidade e atendimento personalizado.</p>
                </div>
                
                <div class="feature-item d-flex mb-4">
                    <div class="feature-icon me-3">
                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                    </div>
                    <div>
                        <h5>Transparência</h5>
                        <p>Prestação de contas claras e detalhadas, garantindo total transparência na gestão financeira.</p>
                    </div>
                </div>
                
                <div class="feature-item d-flex mb-4">
                    <div class="feature-icon me-3">
                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                    </div>
                    <div>
                        <h5>Equipe Especializada</h5>
                        <p>Profissionais com experiência e conhecimento específico em administração condominial.</p>
                    </div>
                </div>
                
                <div class="feature-item d-flex mb-4">
                    <div class="feature-icon me-3">
                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                    </div>
                    <div>
                        <h5>Atendimento Personalizado</h5>
                        <p>Cada condomínio tem suas particularidades, por isso oferecemos um atendimento personalizado.</p>
                    </div>
                </div>
                
                <div class="feature-item d-flex">
                    <div class="feature-icon me-3">
                        <i class="fas fa-check-circle text-primary fa-2x"></i>
                    </div>
                    <div>
                        <h5>Tecnologia</h5>
                        <p>Utilizamos tecnologia de ponta para facilitar a comunicação e o acesso às informações.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção Depoimentos -->
<?php if (!empty($depoimentos)): ?>
<section class="testimonials-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="h1 mb-3">O que dizem nossos clientes</h2>
            <p class="lead">Veja os depoimentos de síndicos e condôminos que já utilizam nossos serviços</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($depoimentos as $depoimento): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="testimonial-rating mb-3">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $depoimento['avaliacao'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="card-text mb-4">"<?php echo $depoimento['texto']; ?>"</p>
                            <div class="d-flex align-items-center">
                                <?php if (!empty($depoimento['avatar'])): ?>
                                    <img src="<?php echo $depoimento['avatar']; ?>" alt="<?php echo $depoimento['nome']; ?>" class="rounded-circle me-3" width="50">
                                <?php else: ?>
                                    <div class="testimonial-avatar me-3">
                                        <i class="fas fa-user-circle fa-3x text-secondary"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h6 class="mb-1"><?php echo $depoimento['nome']; ?></h6>
                                    <small class="text-muted"><?php echo $depoimento['cargo']; ?><?php echo !empty($depoimento['empresa']) ? ', ' . $depoimento['empresa'] : ''; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Seção de Contato Rápido -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 mb-4 mb-lg-0">
                <h2 class="mb-2">Pronto para melhorar a gestão do seu condomínio?</h2>
                <p class="lead mb-0">Entre em contato conosco hoje mesmo e solicite um orçamento sem compromisso.</p>
            </div>
            <div class="col-lg-3 text-lg-end">
                <a href="index.php?page=contato" class="btn btn-light btn-lg">Fale Conosco</a>
            </div>
        </div>
    </div>
</section>

<!-- Posts Recentes do Blog -->
<?php
$posts_recentes = obterPosts(3);
if (!empty($posts_recentes)):
?>
<section class="blog-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="h1 mb-3">Blog</h2>
            <p class="lead">Artigos e novidades sobre gestão condominial</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($posts_recentes as $post): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <?php if (!empty($post['imagem_capa'])): ?>
                            <img src="<?php echo $post['imagem_capa']; ?>" class="card-img-top" alt="<?php echo $post['titulo']; ?>">
                        <?php endif; ?>
                        <div class="card-body p-4">
                            <h5 class="card-title"><?php echo $post['titulo']; ?></h5>
                            <div class="mb-3 text-muted small">
                                <i class="fas fa-user me-1"></i> <?php echo $post['autor_nome']; ?> 
                                <i class="fas fa-calendar ms-3 me-1"></i> <?php echo formatarData($post['data_publicacao']); ?>
                            </div>
                            <p class="card-text"><?php echo limitarTexto($post['resumo'] ?? $post['conteudo'], 120); ?></p>
                            <a href="index.php?page=blog&id=<?php echo $post['id']; ?>" class="btn btn-sm btn-outline-primary mt-2">Ler mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="index.php?page=blog" class="btn btn-primary">Ver Todos os Artigos</a>
        </div>
    </div>
</section>
<?php endif; ?>
