
<?php
// Definir título da página
$titulo = "Contato";

// Processar formulário de contato
$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $assunto = isset($_POST['assunto']) ? trim($_POST['assunto']) : '';
    $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';
    
    // Validar campos
    if (empty($nome)) {
        $erro = "Por favor, informe seu nome.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Por favor, informe um e-mail válido.";
    } elseif (empty($mensagem)) {
        $erro = "Por favor, escreva sua mensagem.";
    } else {
        // Registrar contato no banco de dados
        try {
            $stmt = $conn->prepare("INSERT INTO contatos (nome, email, telefone, assunto, mensagem, ip) VALUES (?, ?, ?, ?, ?, ?)");
            $resultado = $stmt->execute([
                $nome,
                $email,
                $telefone,
                $assunto ?: 'Contato pelo site',
                $mensagem,
                $_SERVER['REMOTE_ADDR']
            ]);
            
            if ($resultado) {
                // Enviar e-mail de notificação (opcional)
                $config = obterConfiguracoes();
                $assunto_email = "Novo contato: " . ($assunto ?: 'Contato pelo site');
                $corpo_email = "Nome: $nome\n";
                $corpo_email .= "E-mail: $email\n";
                $corpo_email .= "Telefone: $telefone\n";
                $corpo_email .= "Mensagem: $mensagem\n";
                
                mail($config['email_contato'], $assunto_email, $corpo_email);
                
                $sucesso = "Mensagem enviada com sucesso! Em breve entraremos em contato.";
                
                // Limpar campos após envio
                $nome = $email = $telefone = $assunto = $mensagem = '';
            } else {
                $erro = "Houve um erro ao enviar sua mensagem. Por favor, tente novamente.";
            }
        } catch (PDOException $e) {
            $erro = "Erro de sistema. Por favor, tente novamente mais tarde.";
        }
    }
}

// Obter configurações para exibir informações de contato
$config = obterConfiguracoes();
?>

<!-- Banner da Página -->
<section class="page-banner bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="h1 mb-3">Entre em Contato</h1>
                <p class="lead">Estamos à disposição para esclarecer suas dúvidas e atender às suas necessidades</p>
            </div>
        </div>
    </div>
</section>

<!-- Informações de Contato e Formulário -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Coluna de Informações -->
            <div class="col-lg-4">
                <div class="contact-info p-4 bg-light rounded shadow-sm h-100">
                    <h3 class="h4 mb-4">Informações de Contato</h3>
                    
                    <div class="d-flex mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-map-marker-alt text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="h6">Endereço</h5>
                            <p class="mb-0">
                                <?php echo !empty($config['endereco']) ? nl2br($config['endereco']) : 'Entre em contato para saber nosso endereço'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-phone-alt text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="h6">Telefone</h5>
                            <p class="mb-0">
                                <?php echo !empty($config['telefone']) ? $config['telefone'] : 'Entre em contato por e-mail'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-envelope text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="h6">E-mail</h5>
                            <p class="mb-0">
                                <?php echo !empty($config['email_contato']) ? $config['email_contato'] : 'contato@novaalternativa.com.br'; ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="contact-icon me-3">
                            <i class="fas fa-clock text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="h6">Horário de Atendimento</h5>
                            <p class="mb-0">Segunda a Sexta: 8h às 18h<br>Sábado: 8h às 12h</p>
                        </div>
                    </div>
                    
                    <!-- Redes Sociais -->
                    <?php if (!empty($config['facebook_url']) || !empty($config['instagram_url']) || !empty($config['whatsapp'])): ?>
                        <div class="contact-social mt-4">
                            <h5 class="h6 mb-3">Siga-nos</h5>
                            <div class="d-flex">
                                <?php if (!empty($config['facebook_url'])): ?>
                                    <a href="<?php echo $config['facebook_url']; ?>" target="_blank" class="social-icon me-3">
                                        <i class="fab fa-facebook-f fa-lg text-primary"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (!empty($config['instagram_url'])): ?>
                                    <a href="<?php echo $config['instagram_url']; ?>" target="_blank" class="social-icon me-3">
                                        <i class="fab fa-instagram fa-lg text-primary"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (!empty($config['whatsapp'])): ?>
                                    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $config['whatsapp']); ?>" target="_blank" class="social-icon">
                                        <i class="fab fa-whatsapp fa-lg text-primary"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Coluna do Formulário -->
            <div class="col-lg-8">
                <div class="contact-form p-4 rounded shadow-sm h-100">
                    <h3 class="h4 mb-4">Envie sua Mensagem</h3>
                    
                    <?php if (!empty($erro)): ?>
                        <div class="alert alert-danger"><?php echo $erro; ?></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($sucesso)): ?>
                        <div class="alert alert-success"><?php echo $sucesso; ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome" class="form-label">Nome completo *</label>
                                    <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo isset($nome) ? htmlspecialchars($nome) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">E-mail *</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo isset($telefone) ? htmlspecialchars($telefone) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assunto" class="form-label">Assunto</label>
                                    <select class="form-select" id="assunto" name="assunto">
                                        <option value="" <?php echo !isset($assunto) || empty($assunto) ? 'selected' : ''; ?>>Selecione um assunto</option>
                                        <option value="Orçamento" <?php echo isset($assunto) && $assunto === 'Orçamento' ? 'selected' : ''; ?>>Orçamento</option>
                                        <option value="Informações" <?php echo isset($assunto) && $assunto === 'Informações' ? 'selected' : ''; ?>>Informações</option>
                                        <option value="Suporte" <?php echo isset($assunto) && $assunto === 'Suporte' ? 'selected' : ''; ?>>Suporte</option>
                                        <option value="Outro" <?php echo isset($assunto) && $assunto === 'Outro' ? 'selected' : ''; ?>>Outro</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mensagem" class="form-label">Mensagem *</label>
                                    <textarea class="form-control" id="mensagem" name="mensagem" rows="6" required><?php echo isset($mensagem) ? htmlspecialchars($mensagem) : ''; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mapa do Google (opcional) -->
<section class="map-section mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="map-container rounded shadow-sm">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.3565863402696!2d-43.178321!3d-22.906485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjLCsDA1JzI0LjQiUyA0M8KwMTAnMjUuOSJX!5e0!3m2!1spt-BR!2sbr!4v1622221616000!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção CTA -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 mb-4 mb-lg-0">
                <h2 class="mb-2">Quer receber informações sobre nossos serviços?</h2>
                <p class="lead mb-0">Inscreva-se para receber nossas novidades e dicas sobre gestão condominial.</p>
            </div>
            <div class="col-lg-3 text-lg-end">
                <a href="#" class="btn btn-light btn-lg">Inscrever-se</a>
            </div>
        </div>
    </div>
</section>
