
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
            
            $success = 'Sistema instalado com sucesso! <a href="index.php">Clique aqui</a> para acessar o site.';
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="install-page">
    <div class="install-container">
        <div class="install-header">
            <h1>Nova Alternativa</h1>
            <h2>Instalação do Sistema</h2>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php else: ?>
        
        <form method="post" action="">
            <div class="install-section">
                <h3>Configurações do Banco de Dados</h3>
                <div class="form-group">
                    <label for="db_host">Servidor MySQL:</label>
                    <input type="text" id="db_host" name="db_host" value="localhost" required>
                </div>
                
                <div class="form-group">
                    <label for="db_name">Nome do Banco de Dados:</label>
                    <input type="text" id="db_name" name="db_name" required>
                </div>
                
                <div class="form-group">
                    <label for="db_user">Usuário MySQL:</label>
                    <input type="text" id="db_user" name="db_user" required>
                </div>
                
                <div class="form-group">
                    <label for="db_pass">Senha MySQL:</label>
                    <input type="password" id="db_pass" name="db_pass">
                </div>
            </div>
            
            <div class="install-section">
                <h3>Configurações do Site</h3>
                <div class="form-group">
                    <label for="site_nome">Nome do Site:</label>
                    <input type="text" id="site_nome" name="site_nome" value="Nova Alternativa" required>
                </div>
            </div>
            
            <div class="install-section">
                <h3>Conta de Administrador</h3>
                <div class="form-group">
                    <label for="admin_email">E-mail do Administrador:</label>
                    <input type="email" id="admin_email" name="admin_email" required>
                </div>
                
                <div class="form-group">
                    <label for="admin_senha">Senha do Administrador:</label>
                    <input type="password" id="admin_senha" name="admin_senha" required>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Instalar Sistema</button>
            </div>
        </form>
        
        <?php endif; ?>
    </div>
    
    <script src="assets/js/scripts.js"></script>
</body>
</html>
