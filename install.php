
<?php
// Verificar se o sistema já foi instalado
if (file_exists('config/database.php')) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';

// Processar formulário de instalação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos
    if (
        empty($_POST['db_host']) || 
        empty($_POST['db_name']) || 
        empty($_POST['db_user']) || 
        empty($_POST['admin_email']) || 
        empty($_POST['admin_senha']) ||
        empty($_POST['site_nome'])
    ) {
        $error = 'Todos os campos são obrigatórios.';
    } else {
        $db_host = $_POST['db_host'];
        $db_name = $_POST['db_name'];
        $db_user = $_POST['db_user'];
        $db_pass = $_POST['db_pass'];
        $admin_email = $_POST['admin_email'];
        $admin_senha = password_hash($_POST['admin_senha'], PASSWORD_DEFAULT);
        $site_nome = $_POST['site_nome'];
        
        // Testar conexão com o banco
        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Criar estrutura do banco de dados
            $sql_file = file_get_contents('config/schema.sql');
            $conn->exec($sql_file);
            
            // Inserir administrador
            $stmt = $conn->prepare("INSERT INTO administradores (email, senha, nome) VALUES (?, ?, 'Administrador')");
            $stmt->execute([$admin_email, $admin_senha]);
            
            // Inserir configurações do site
            $stmt = $conn->prepare("INSERT INTO configuracoes (nome_site, email_contato) VALUES (?, ?)");
            $stmt->execute([$site_nome, $admin_email]);
            
            // Criar arquivo de configuração
            if (!is_dir('config')) {
                mkdir('config', 0755, true);
            }
            
            $config_content = "<?php\n";
            $config_content .= "// Configurações do Banco de Dados\n";
            $config_content .= "define('DB_HOST', '$db_host');\n";
            $config_content .= "define('DB_NAME', '$db_name');\n";
            $config_content .= "define('DB_USER', '$db_user');\n";
            $config_content .= "define('DB_PASS', '$db_pass');\n\n";
            $config_content .= "// Configurações do Site\n";
            $config_content .= "define('SITE_NOME', '$site_nome');\n";
            $config_content .= "define('DATA_INSTALACAO', date('Y-m-d H:i:s'));\n\n";
            $config_content .= "// Conexão com o Banco de Dados\n";
            $config_content .= "try {\n";
            $config_content .= "    \$conn = new PDO(\"mysql:host=\" . DB_HOST . \";dbname=\" . DB_NAME, DB_USER, DB_PASS);\n";
            $config_content .= "    \$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n";
            $config_content .= "    \$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);\n";
            $config_content .= "} catch (PDOException \$e) {\n";
            $config_content .= "    die('Erro na conexão com o banco de dados: ' . \$e->getMessage());\n";
            $config_content .= "}\n";
            $config_content .= "?>";
            
            file_put_contents('config/database.php', $config_content);
            
            $success = 'Sistema instalado com sucesso! <a href="index.php" class="alert-link">Clique aqui</a> para acessar o site.';
        } catch (PDOException $e) {
            $error = 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação - Nova Alternativa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="install-page">
    <div class="container">
        <div class="install-container">
            <div class="install-header">
                <div class="mb-4">
                    <i class="fas fa-cogs fa-3x text-primary"></i>
                </div>
                <h1>Nova Alternativa</h1>
                <p class="lead">Assistente de Instalação do Sistema</p>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                </div>
            <?php else: ?>
            
            <form method="post" action="">
                <div class="install-section">
                    <h3><i class="fas fa-database me-2"></i>Configurações do Banco de Dados</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="db_host">Servidor MySQL:</label>
                                <input type="text" class="form-control" id="db_host" name="db_host" value="localhost" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="db_name">Nome do Banco de Dados:</label>
                                <input type="text" class="form-control" id="db_name" name="db_name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="db_user">Usuário MySQL:</label>
                                <input type="text" class="form-control" id="db_user" name="db_user" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="db_pass">Senha MySQL:</label>
                                <input type="password" class="form-control" id="db_pass" name="db_pass">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="install-section">
                    <h3><i class="fas fa-globe me-2"></i>Configurações do Site</h3>
                    <div class="form-group">
                        <label for="site_nome">Nome do Site:</label>
                        <input type="text" class="form-control" id="site_nome" name="site_nome" value="Nova Alternativa" required>
                    </div>
                </div>
                
                <div class="install-section">
                    <h3><i class="fas fa-user-shield me-2"></i>Conta de Administrador</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_email">E-mail do Administrador:</label>
                                <input type="email" class="form-control" id="admin_email" name="admin_email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_senha">Senha do Administrador:</label>
                                <input type="password" class="form-control" id="admin_senha" name="admin_senha" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-check me-2"></i>Instalar Sistema
                    </button>
                </div>
            </form>
            
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-4 text-white">
            <p>&copy; <?php echo date('Y'); ?> Nova Alternativa. Todos os direitos reservados.</p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
