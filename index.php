
<?php
// Verificar se o sistema já foi instalado
$config_file = 'config/database.php';
$installed = file_exists($config_file);

// Redirecionar para instalação se não estiver instalado
if (!$installed && !strpos($_SERVER['REQUEST_URI'], '/install')) {
    header('Location: install.php');
    exit();
}

// Incluir arquivos de configuração se estiver instalado
if ($installed) {
    require_once 'config/database.php';
    require_once 'includes/functions.php';
}

// Definir página atual
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Cabeçalho do site
include 'includes/header.php';

// Conteúdo da página
switch ($page) {
    case 'home':
        include 'pages/home.php';
        break;
    case 'servicos':
        include 'pages/servicos.php';
        break;
    case 'blog':
        if (isset($_GET['id'])) {
            include 'pages/blog-post.php';
        } else {
            include 'pages/blog.php';
        }
        break;
    case 'contato':
        include 'pages/contato.php';
        break;
    case 'portal':
        if (!isset($_SESSION['usuario_id'])) {
            include 'pages/portal-login.php';
        } else {
            if (isset($_GET['secao'])) {
                switch ($_GET['secao']) {
                    case 'dashboard':
                        include 'pages/portal-dashboard.php';
                        break;
                    case 'tickets':
                        include 'pages/portal-tickets.php';
                        break;
                    default:
                        include 'pages/portal-dashboard.php';
                }
            } else {
                include 'pages/portal-dashboard.php';
            }
        }
        break;
    case 'admin':
        if (!isset($_SESSION['admin_id'])) {
            include 'pages/admin-login.php';
        } else {
            if (isset($_GET['secao'])) {
                switch ($_GET['secao']) {
                    case 'dashboard':
                        include 'pages/admin-dashboard.php';
                        break;
                    case 'blog':
                        include 'pages/admin-blog.php';
                        break;
                    case 'tickets':
                        include 'pages/admin-tickets.php';
                        break;
                    default:
                        include 'pages/admin-dashboard.php';
                }
            } else {
                include 'pages/admin-dashboard.php';
            }
        }
        break;
    default:
        include 'pages/404.php';
}

// Rodapé do site
include 'includes/footer.php';
?>
