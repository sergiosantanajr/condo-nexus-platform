
<?php
// Definir título da página
$titulo = "Contato";
$paginaAtual = 'contato';

// Processar formulário de contato
$erro = "";
$sucesso = "";
$nome = $email = $telefone = $mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';
    $captcha = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';
    
    // Validar campos
    if (empty($nome)) {
        $erro = "Por favor, informe seu nome.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Por favor, informe um e-mail válido.";
    } elseif (empty($mensagem)) {
        $erro = "Por favor, escreva sua mensagem.";
    } elseif (empty($captcha)) {
        $erro = "Por favor, preencha o código de verificação.";
    } elseif (!isset($_SESSION['captcha']) || strtoupper($captcha) !== $_SESSION['captcha']) {
        $erro = "Código de verificação incorreto. Por favor, tente novamente.";
    } else {
        // Simular envio de mensagem
        $sucesso = "Sua mensagem foi enviada com sucesso! Em breve entraremos em contato.";
        $nome = $email = $telefone = $mensagem = "";
        unset($_SESSION['captcha']);
    }
}
?>

<!-- Hero Section -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="fw-bold mb-4">Entre em contato conosco</h1>
                <p class="lead mb-4">Estamos prontos para atender suas necessidades e esclarecer todas as suas dúvidas sobre nossos serviços de gestão condominial.</p>
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3 text-primary">
                        <i class="fas fa-phone fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Telefone</h5>
                        <p class="mb-0"><?php echo $config['telefone']; ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3 text-primary">
                        <i class="fas fa-envelope fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">E-mail</h5>
                        <p class="mb-0"><?php echo $config['email_contato']; ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="me-3 text-primary">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Endereço</h5>
                        <p class="mb-0"><?php echo nl2br($config['endereco']); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <h2 class="h4 mb-4">Envie-nos uma mensagem</h2>
                        
                        <?php if (!empty($erro)): ?>
                            <div class="alert alert-danger"><?php echo $erro; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($sucesso)): ?>
                            <div class="alert alert-success"><?php echo $sucesso; ?></div>
                        <?php else: ?>
                        
                        <form method="post" action="" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome completo *</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail *</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" placeholder="(00) 00000-0000">
                            </div>
                            
                            <div class="mb-3">
                                <label for="mensagem" class="form-label">Mensagem *</label>
                                <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required><?php echo htmlspecialchars($mensagem); ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="captcha" class="form-label">Código de verificação *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="captcha" name="captcha" required>
                                    <span class="input-group-text p-0">
                                        <img src="includes/captcha.php" id="captcha-image" alt="CAPTCHA" height="40" class="rounded-end">
                                    </span>
                                    <button type="button" class="btn btn-outline-secondary" onclick="recarregarCaptcha()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="form-text">Digite os caracteres que você vê na imagem acima.</div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                            </div>
                        </form>
                        
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow overflow-hidden">
                    <div class="ratio ratio-21x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.0976701344906!2d-46.65390548502195!3d-23.56509288468113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59c8da0aa315%3A0xd59f9431f2c9776a!2sAv.%20Paulista%2C%20S%C3%A3o%20Paulo%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1610000000000!5m2!1spt-BR!2sbr" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold">Perguntas Frequentes</h2>
                <p class="lead text-muted">Encontre respostas para as dúvidas mais comuns sobre nossos serviços.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Como funciona o sistema de gestão de condomínios?
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Nosso sistema é uma plataforma online completa que integra todas as necessidades de gestão condominial. Os síndicos e administradores têm acesso a recursos para gerenciar finanças, comunicação, reservas de áreas comuns, documentos e muito mais. Os condôminos também possuem uma área própria para acessar boletos, fazer solicitações e se comunicar com a administração.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h3 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Quanto custa implementar o sistema no meu condomínio?
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Oferecemos diferentes planos para atender condomínios de todos os portes. O valor é calculado com base no número de unidades e nos módulos contratados. Entre em contato conosco para uma avaliação personalizada e um orçamento detalhado para o seu condomínio.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h3 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                É necessário instalar algum software para usar o sistema?
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Não é necessário instalar nenhum software específico. Nosso sistema é baseado em nuvem (cloud) e pode ser acessado de qualquer dispositivo com conexão à internet, seja computador, tablet ou smartphone, através de um navegador web moderno.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border mb-3 shadow-sm">
                        <h3 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Vocês oferecem suporte técnico e treinamento?
                            </button>
                        </h3>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sim, oferecemos suporte técnico completo e treinamento para todos os usuários. No início da implementação, realizamos sessões de treinamento para administradores e condôminos. Além disso, disponibilizamos tutoriais, manuais e um canal de suporte para esclarecer dúvidas a qualquer momento.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
