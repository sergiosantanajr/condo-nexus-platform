
<?php
// Definir título da página
$titulo = "Login - Portal do Cliente";

// Verificar se já está logado
if (usuarioLogado()) {
    header('Location: index.php?page=portal&secao=dashboard');
    exit();
}

// Processar formulário de login
$erro = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    
    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Tentar fazer login
        $usuario_id = validarLoginUsuario($email, $senha);
        
        if ($usuario_id) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario_id;
            header('Location: index.php?page=portal&secao=dashboard');
            exit();
        } else {
            $erro = "E-mail ou senha incorretos.";
        }
    }
}
?>

<section class="portal-login py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="h3 mb-3 fw-normal">Portal do Cliente</h1>
                            <p class="text-muted">Faça login para acessar o portal</p>
                        </div>
                        
                        <?php if (!empty($erro)): ?>
                            <div class="alert alert-danger"><?php echo $erro; ?></div>
                        <?php endif; ?>
                        
                        <form method="post" action="">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" value="<?php echo htmlspecialchars($email); ?>" required>
                                <label for="email">E-mail</label>
                            </div>
                            
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                                <label for="senha">Senha</label>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="lembrar">
                                    <label class="form-check-label" for="lembrar">
                                        Lembrar-me
                                    </label>
                                </div>
                                <a href="#" class="text-decoration-none small">Esqueceu a senha?</a>
                            </div>
                            
                            <button class="w-100 btn btn-primary btn-lg" type="submit">Entrar</button>
                            
                            <div class="text-center mt-4">
                                <p class="mb-0">Não tem uma conta? <a href="index.php?page=portal&secao=cadastro" class="text-decoration-none">Cadastre-se</a></p>
                            </div>
                        </form>
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
