
<?php
// Obter configurações do site
$config = obterConfiguracoes();
$paginaAtual = $page ?? 'home';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo) ? $titulo . ' - ' . $config['nome_site'] : $config['nome_site']; ?></title>
    <meta name="description" content="<?php echo $config['nome_site']; ?> - Sistema de Gestão de Condomínios">
    
    <!-- Favicon -->
    <link rel="icon" href="assets/img/favicon.ico">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Barra de WhatsApp -->
    <?php if (!empty($config['whatsapp'])): ?>
    <div class="whatsapp-button">
        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $config['whatsapp']); ?>" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <?php endif; ?>
    
    <!-- Cabeçalho -->
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.php">
                    <?php if (!empty($config['logo_url'])): ?>
                        <img src="<?php echo $config['logo_url']; ?>" alt="<?php echo $config['nome_site']; ?>" height="40">
                    <?php else: ?>
                        <span class="site-logo">Nova Alternativa</span>
                    <?php endif; ?>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item <?php echo $paginaAtual == 'home' ? 'active' : ''; ?>">
                            <a class="nav-link" href="index.php">Início</a>
                        </li>
                        <li class="nav-item <?php echo $paginaAtual == 'servicos' ? 'active' : ''; ?>">
                            <a class="nav-link" href="index.php?page=servicos">Serviços</a>
                        </li>
                        <li class="nav-item <?php echo $paginaAtual == 'blog' ? 'active' : ''; ?>">
                            <a class="nav-link" href="index.php?page=blog">Blog</a>
                        </li>
                        <li class="nav-item <?php echo $paginaAtual == 'contato' ? 'active' : ''; ?>">
                            <a class="nav-link" href="index.php?page=contato">Contato</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white rounded-pill px-4" href="index.php?page=portal">Área do Cliente</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Conteúdo principal -->
    <main>
