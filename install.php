
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$config_file = 'config/database.php';
$installed = file_exists($config_file);

// Se já estiver instalado, redirecionar para a home
if ($installed && !isset($_GET['force'])) {
    header('Location: index.php');
    exit();
}

// Definir caminho do arquivo de configuração
$config_dir = dirname($config_file);
if (!is_dir($config_dir)) {
    mkdir($config_dir, 0755, true);
}

// Verificar permissões de escrita
$writableErrors = [];
$checkPaths = [
    $config_dir,
    'uploads',
    'uploads/profiles',
    'uploads/blog'
];

foreach ($checkPaths as $path) {
    if (!is_dir($path)) {
        if (!mkdir($path, 0755, true)) {
            $writableErrors[] = $path;
        }
    } elseif (!is_writable($path)) {
        $writableErrors[] = $path;
    }
}

// Processar formulário
$step = isset($_GET['step']) ? intval($_GET['step']) : 1;
$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === 1) {
        // Validação do formulário de banco de dados
        $db_host = trim($_POST['db_host'] ?? '');
        $db_name = trim($_POST['db_name'] ?? '');
        $db_user = trim($_POST['db_user'] ?? '');
        $db_pass = $_POST['db_pass'] ?? '';
        $db_prefix = trim($_POST['db_prefix'] ?? 'na_');
        
        if (empty($db_host) || empty($db_name) || empty($db_user)) {
            $error = 'Por favor, preencha todos os campos obrigatórios.';
        } else {
            // Tentar conectar ao banco
            try {
                $conn = new PDO("mysql:host=$db_host;charset=utf8mb4", $db_user, $db_pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Verificar se o banco de dados existe
                $stmt = $conn->query("SHOW DATABASES LIKE '$db_name'");
                $dbExists = $stmt->rowCount() > 0;
                
                if (!$dbExists) {
                    // Criar banco de dados
                    $conn->exec("CREATE DATABASE `$db_name` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                }
                
                // Selecionar o banco de dados
                $conn->exec("USE `$db_name`");
                
                // Salvar configurações na sessão
                $_SESSION['install'] = [
                    'db_host' => $db_host,
                    'db_name' => $db_name,
                    'db_user' => $db_user,
                    'db_pass' => $db_pass,
                    'db_prefix' => $db_prefix
                ];
                
                // Avançar para o próximo passo
                header('Location: install.php?step=2');
                exit();
                
            } catch (PDOException $e) {
                $error = 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
            }
        }
    } elseif ($step === 2) {
        // Validação do formulário de site e administrador
        $site_name = trim($_POST['site_name'] ?? '');
        $admin_name = trim($_POST['admin_name'] ?? '');
        $admin_email = trim($_POST['admin_email'] ?? '');
        $admin_password = $_POST['admin_password'] ?? '';
        $admin_password_confirm = $_POST['admin_password_confirm'] ?? '';
        
        if (empty($site_name) || empty($admin_name) || empty($admin_email) || empty($admin_password)) {
            $error = 'Por favor, preencha todos os campos obrigatórios.';
        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Por favor, insira um e-mail válido.';
        } elseif (strlen($admin_password) < 6) {
            $error = 'A senha deve ter pelo menos 6 caracteres.';
        } elseif ($admin_password !== $admin_password_confirm) {
            $error = 'As senhas não conferem.';
        } else {
            // Recuperar configurações da sessão
            $db_config = $_SESSION['install'] ?? null;
            
            if (!$db_config) {
                header('Location: install.php');
                exit();
            }
            
            try {
                // Conectar ao banco de dados
                $conn = new PDO("mysql:host={$db_config['db_host']};dbname={$db_config['db_name']};charset=utf8mb4", $db_config['db_user'], $db_config['db_pass']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Criar arquivo de configuração
                $config_content = "<?php\n";
                $config_content .= "// Configurações de Banco de Dados\n";
                $config_content .= "\$db_host = '{$db_config['db_host']}';\n";
                $config_content .= "\$db_name = '{$db_config['db_name']}';\n";
                $config_content .= "\$db_user = '{$db_config['db_user']}';\n";
                $config_content .= "\$db_pass = '{$db_config['db_pass']}';\n";
                $config_content .= "\$db_prefix = '{$db_config['db_prefix']}';\n\n";
                $config_content .= "// Conexão com o banco de dados\n";
                $config_content .= "try {\n";
                $config_content .= "    \$conn = new PDO(\"mysql:host={\$db_host};dbname={\$db_name};charset=utf8mb4\", \$db_user, \$db_pass);\n";
                $config_content .= "    \$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n";
                $config_content .= "} catch (PDOException \$e) {\n";
                $config_content .= "    // Erro de conexão será tratado quando necessário\n";
                $config_content .= "    \$conn = null;\n";
                $config_content .= "}\n";
                
                // Escrever arquivo de configuração
                file_put_contents($config_file, $config_content);
                
                // Criar tabelas
                // Tabela de Administradores
                $conn->exec("
                    CREATE TABLE IF NOT EXISTS `{$db_config['db_prefix']}administradores` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `nome` varchar(100) NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `senha` varchar(255) NOT NULL,
                        `cargo` varchar(50) DEFAULT NULL,
                        `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
                        `data_cadastro` datetime NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `email` (`email`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                ");
                
                // Tabela de Usuários
                $conn->exec("
                    CREATE TABLE IF NOT EXISTS `{$db_config['db_prefix']}usuarios` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `nome` varchar(100) NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `senha` varchar(255) NOT NULL,
                        `telefone` varchar(20) DEFAULT NULL,
                        `cpf` varchar(14) DEFAULT NULL,
                        `status` enum('ativo','pendente','inativo') NOT NULL DEFAULT 'pendente',
                        `data_cadastro` datetime NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `email` (`email`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                ");
                
                // Tabela de Configurações
                $conn->exec("
                    CREATE TABLE IF NOT EXISTS `{$db_config['db_prefix']}configuracoes` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `nome_site` varchar(100) NOT NULL,
                        `logo_url` varchar(255) DEFAULT NULL,
                        `whatsapp` varchar(20) DEFAULT NULL,
                        `telefone` varchar(20) DEFAULT NULL,
                        `email_contato` varchar(100) DEFAULT NULL,
                        `endereco` text DEFAULT NULL,
                        `facebook_url` varchar(255) DEFAULT NULL,
                        `instagram_url` varchar(255) DEFAULT NULL,
                        `descricao_site` text DEFAULT NULL,
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
                ");
                
                // Inserir configurações iniciais
                $stmt = $conn->prepare("INSERT INTO `{$db_config['db_prefix']}configuracoes` 
                    (nome_site, logo_url, email_contato, descricao_site) VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $site_name,
                    'assets/img/logo.png',
                    $admin_email,
                    'Sistema profissional de gestão de condomínios'
                ]);
                
                // Inserir administrador inicial
                $admin_password_hash = password_hash($admin_password, PASSWORD_DEFAULT);
                
                $stmt = $conn->prepare("INSERT INTO `{$db_config['db_prefix']}administradores` 
                    (nome, email, senha, cargo, status, data_cadastro) VALUES (?, ?, ?, 'Administrador Geral', 'ativo', NOW())");
                $stmt->execute([
                    $admin_name,
                    $admin_email,
                    $admin_password_hash
                ]);
                
                // Limpar sessão de instalação
                unset($_SESSION['install']);
                
                // Redirecionar para o passo final
                header('Location: install.php?step=3');
                exit();
                
            } catch (PDOException $e) {
                $error = 'Erro durante a instalação: ' . $e->getMessage();
            }
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
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .install-container {
            max-width: 700px;
            margin: 50px auto;
        }
        .install-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .install-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step-item {
            flex: 1;
            text-align: center;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            margin: 0 5px;
            position: relative;
        }
        .step-item:not(:last-child):after {
            content: '';
            position: absolute;
            top: 50%;
            right: -10px;
            width: 20px;
            height: 2px;
            background-color: #ced4da;
        }
        .step-item.active {
            background-color: #3498db;
            color: white;
        }
        .step-item.completed {
            background-color: #2ecc71;
            color: white;
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="install-header">
            <h1 class="mb-3">Nova Alternativa</h1>
            <h2 class="h4 text-muted">Sistema de Gestão de Condomínios</h2>
        </div>
        
        <div class="install-steps">
            <div class="step-item <?php echo $step >= 1 ? 'active' : ''; ?> <?php echo $step > 1 ? 'completed' : ''; ?>">
                <i class="fas fa-database"></i>
                <div>Banco de Dados</div>
            </div>
            <div class="step-item <?php echo $step >= 2 ? 'active' : ''; ?> <?php echo $step > 2 ? 'completed' : ''; ?>">
                <i class="fas fa-cog"></i>
                <div>Configuração</div>
            </div>
            <div class="step-item <?php echo $step >= 3 ? 'active' : ''; ?>">
                <i class="fas fa-check-circle"></i>
                <div>Conclusão</div>
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if (!empty($writableErrors)): ?>
                    <div class="alert alert-warning">
                        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Atenção!</h5>
                        <p>Os seguintes diretórios não possuem permissão de escrita:</p>
                        <ul>
                            <?php foreach ($writableErrors as $path): ?>
                                <li><?php echo $path; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <p class="mb-0">Por favor, configure as permissões adequadas (chmod 755 ou 777) antes de prosseguir.</p>
                    </div>
                <?php endif; ?>
                
                <?php if ($step === 1): ?>
                    <!-- Passo 1: Configuração do Banco de Dados -->
                    <h3 class="card-title mb-4">Configuração do Banco de Dados</h3>
                    
                    <form method="post" action="install.php?step=1">
                        <div class="mb-3">
                            <label for="db_host" class="form-label">Servidor MySQL *</label>
                            <input type="text" class="form-control" id="db_host" name="db_host" value="localhost" required>
                            <div class="form-text">Geralmente é "localhost" ou o endereço IP do seu servidor de banco de dados.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="db_name" class="form-label">Nome do Banco de Dados *</label>
                            <input type="text" class="form-control" id="db_name" name="db_name" required>
                            <div class="form-text">Se o banco de dados não existir, tentaremos criá-lo.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="db_user" class="form-label">Usuário MySQL *</label>
                            <input type="text" class="form-control" id="db_user" name="db_user" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="db_pass" class="form-label">Senha MySQL</label>
                            <input type="password" class="form-control" id="db_pass" name="db_pass">
                        </div>
                        
                        <div class="mb-3">
                            <label for="db_prefix" class="form-label">Prefixo das Tabelas</label>
                            <input type="text" class="form-control" id="db_prefix" name="db_prefix" value="na_">
                            <div class="form-text">Útil se você tem múltiplas instalações no mesmo banco de dados.</div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Continuar</button>
                        </div>
                    </form>
                    
                <?php elseif ($step === 2): ?>
                    <!-- Passo 2: Configuração do Site e Administrador -->
                    <h3 class="card-title mb-4">Configuração do Site</h3>
                    
                    <form method="post" action="install.php?step=2">
                        <div class="mb-3">
                            <label for="site_name" class="form-label">Nome do Site *</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="Nova Alternativa" required>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h4 class="mb-3">Conta do Administrador</h4>
                        
                        <div class="mb-3">
                            <label for="admin_name" class="form-label">Nome *</label>
                            <input type="text" class="form-control" id="admin_name" name="admin_name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_email" class="form-label">E-mail *</label>
                            <input type="email" class="form-control" id="admin_email" name="admin_email" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="admin_password" class="form-label">Senha *</label>
                                <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                                <div class="form-text">Mínimo de 6 caracteres.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="admin_password_confirm" class="form-label">Confirmar Senha *</label>
                                <input type="password" class="form-control" id="admin_password_confirm" name="admin_password_confirm" required>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Instalar</button>
                        </div>
                    </form>
                    
                <?php elseif ($step === 3): ?>
                    <!-- Passo 3: Conclusão -->
                    <div class="text-center">
                        <i class="fas fa-check-circle text-success fa-5x mb-3"></i>
                        <h3 class="card-title mb-4">Instalação Concluída!</h3>
                        <p class="lead">O sistema Nova Alternativa foi instalado com sucesso!</p>
                        <div class="alert alert-info">
                            <p><strong>Importante:</strong> Por segurança, recomendamos que você exclua ou renomeie o arquivo "install.php" para evitar que o processo de instalação seja executado novamente.</p>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <a href="index.php" class="btn btn-success btn-lg">Ir para o Site</a>
                            <a href="index.php?page=admin" class="btn btn-primary btn-lg">Ir para o Painel Administrativo</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
