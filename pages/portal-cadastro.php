
<?php
// Definir título da página
$titulo = "Cadastro - Portal do Cliente";

// Verificar se já está logado
if (usuarioLogado()) {
    header('Location: index.php?page=portal&secao=dashboard');
    exit();
}

// Processar formulário de cadastro
$erro = "";
$sucesso = "";
$nome = $email = $telefone = $cpf = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $confirmar_senha = isset($_POST['confirmar_senha']) ? $_POST['confirmar_senha'] : '';
    
    // Validar campos
    if (empty($nome)) {
        $erro = "Por favor, informe seu nome completo.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Por favor, informe um e-mail válido.";
    } elseif (empty($senha)) {
        $erro = "Por favor, crie uma senha.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } elseif ($senha !== $confirmar_senha) {
        $erro = "As senhas não conferem.";
    } else {
        // Cadastrar usuário
        $resultado = cadastrarUsuario([
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'cpf' => $cpf,
            'senha' => $senha
        ]);
        
        if (is_numeric($resultado)) {
            $sucesso = "Cadastro realizado com sucesso! Aguarde a aprovação da administração para acessar o portal.";
            $nome = $email = $telefone = $cpf = "";
        } else {
            $erro = $resultado;
        }
    }
}
?>

<section class="portal-cadastro py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="h3 mb-3 fw-normal">Cadastro de Condômino</h1>
                            <p class="text-muted">Crie sua conta para acessar o portal</p>
                        </div>
                        
                        <?php if (!empty($erro)): ?>
                            <div class="alert alert-danger"><?php echo $erro; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($sucesso)): ?>
                            <div class="alert alert-success"><?php echo $sucesso; ?></div>
                            <div class="text-center mt-4">
                                <a href="index.php?page=portal" class="btn btn-primary">Ir para o Login</a>
                            </div>
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
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" placeholder="(00) 00000-0000">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" placeholder="000.000.000-00">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="senha" class="form-label">Senha *</label>
                                    <input type="password" class="form-control" id="senha" name="senha" required>
                                    <div class="form-text">Mínimo de 6 caracteres</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="confirmar_senha" class="form-label">Confirmar Senha *</label>
                                    <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="termos" required>
                                    <label class="form-check-label" for="termos">
                                        Concordo com os <a href="#" target="_blank">Termos de Uso</a> e <a href="#" target="_blank">Política de Privacidade</a>
                                    </label>
                                </div>
                            </div>
                            
                            <button class="w-100 btn btn-primary btn-lg" type="submit">Cadastrar</button>
                            
                            <div class="text-center mt-4">
                                <p class="mb-0">Já possui uma conta? <a href="index.php?page=portal" class="text-decoration-none">Faça login</a></p>
                            </div>
                        </form>
                        
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-link text-decoration-none">
                        <i class="fas fa-arrow-left me-2"></i> Voltar para o site
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
