
<?php
// Verificar se o administrador está logado
if (!adminLogado()) {
    header('Location: index.php?page=admin');
    exit();
}

// Obter dados do administrador logado
$admin = obterAdminLogado();

// Estatísticas do sistema
try {
    // Contar usuários
    $stmt = $conn->query("SELECT COUNT(*) FROM usuarios");
    $total_usuarios = $stmt->fetchColumn();
    
    // Contar tickets
    $stmt = $conn->query("SELECT COUNT(*) FROM tickets");
    $total_tickets = $stmt->fetchColumn();
    
    // Contar posts do blog
    $stmt = $conn->query("SELECT COUNT(*) FROM blog_posts");
    $total_posts = $stmt->fetchColumn();
    
    // Contar contatos
    $stmt = $conn->query("SELECT COUNT(*) FROM contatos WHERE status = 'novo'");
    $total_contatos = $stmt->fetchColumn();
    
    // Tickets recentes
    $stmt = $conn->query("SELECT t.*, u.nome as usuario_nome FROM tickets t JOIN usuarios u ON t.usuario_id = u.id ORDER BY t.data_criacao DESC LIMIT 5");
    $tickets_recentes = $stmt->fetchAll();
    
    // Contatos recentes
    $stmt = $conn->query("SELECT * FROM contatos ORDER BY data_criacao DESC LIMIT 5");
    $contatos_recentes = $stmt->fetchAll();
} catch (PDOException $e) {
    // Erro ao buscar estatísticas
    $total_usuarios = $total_tickets = $total_posts = $total_contatos = 0;
    $tickets_recentes = $contatos_recentes = [];
}

// Definir título da página
$titulo = "Dashboard - Administração";
?>

<!-- Admin Dashboard -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <div class="user-profile p-3 mb-4 border-bottom text-center">
                    <div class="user-avatar mb-3">
                        <i class="fas fa-user-circle fa-4x text-primary"></i>
                    </div>
                    <h6 class="mb-1"><?php echo $admin['nome']; ?></h6>
                    <p class="small text-muted mb-0"><?php echo $admin['email']; ?></p>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=admin&secao=dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin&secao=blog">
                            <i class="fas fa-blog me-2"></i>
                            Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin&secao=usuarios">
                            <i class="fas fa-users me-2"></i>
                            Usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin&secao=tickets">
                            <i class="fas fa-ticket-alt me-2"></i>
                            Tickets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin&secao=condominios">
                            <i class="fas fa-building me-2"></i>
                            Condomínios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin&secao=servicos">
                            <i class="fas fa-concierge-bell me-2"></i>
                            Serviços
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin&secao=configuracoes">
                            <i class="fas fa-cog me-2"></i>
                            Configurações
                        </a>
                    </li>
                </ul>
                
                <hr>
                
                <div class="px-3">
                    <a href="index.php?page=admin&logout=1" class="btn btn-outline-danger w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Sair
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Conteúdo Principal -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download me-1"></i> Exportar
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Cartões de Estatísticas -->
            <div class="row g-4 mb-4">
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Usuários</h5>
                                <div class="dashboard-icon bg-primary text-white rounded-circle">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <h3 class="mb-0"><?php echo $total_usuarios; ?></h3>
                            <p class="text-muted small mb-0">usuários cadastrados</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Tickets</h5>
                                <div class="dashboard-icon bg-success text-white rounded-circle">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                            </div>
                            <h3 class="mb-0"><?php echo $total_tickets; ?></h3>
                            <p class="text-muted small mb-0">tickets abertos</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Blog</h5>
                                <div class="dashboard-icon bg-warning text-white rounded-circle">
                                    <i class="fas fa-blog"></i>
                                </div>
                            </div>
                            <h3 class="mb-0"><?php echo $total_posts; ?></h3>
                            <p class="text-muted small mb-0">posts publicados</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Contatos</h5>
                                <div class="dashboard-icon bg-info text-white rounded-circle">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <h3 class="mb-0"><?php echo $total_contatos; ?></h3>
                            <p class="text-muted small mb-0">novas mensagens</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gráficos e Informações -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Atividade Recente</h5>
                        </div>
                        <div class="card-body">
                            <div style="height: 300px; background-color: #f8f9fa; border-radius: 0.25rem; display: flex; align-items: center; justify-content: center;">
                                <p class="text-muted mb-0">Gráfico de atividades recentes</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Status do Sistema</h5>
                        </div>
                        <div class="card-body">
                            <div class="progress mb-3" style="height: 25px;">
                                <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                            </div>
                            <p class="small mb-3">Espaço em disco utilizado</p>
                            
                            <div class="progress mb-3" style="height: 25px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 28%;" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100">28%</div>
                            </div>
                            <p class="small mb-3">Uso de CPU</p>
                            
                            <div class="progress mb-3" style="height: 25px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                            </div>
                            <p class="small">Uso de memória</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tickets Recentes e Mensagens -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Tickets Recentes</h5>
                            <a href="index.php?page=admin&secao=tickets" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                        </div>
                        <div class="card-body">
                            <?php if (empty($tickets_recentes)): ?>
                                <p class="text-center text-muted my-4">Nenhum ticket encontrado.</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <th>Usuário</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tickets_recentes as $ticket): ?>
                                                <tr>
                                                    <td>#<?php echo $ticket['id']; ?></td>
                                                    <td><?php echo $ticket['titulo']; ?></td>
                                                    <td><?php echo $ticket['usuario_nome']; ?></td>
                                                    <td>
                                                        <?php 
                                                            $status = [
                                                                'aberto' => '<span class="badge bg-success">Aberto</span>',
                                                                'em_andamento' => '<span class="badge bg-primary">Em andamento</span>',
                                                                'respondido' => '<span class="badge bg-info text-dark">Respondido</span>',
                                                                'fechado' => '<span class="badge bg-secondary">Fechado</span>'
                                                            ];
                                                            echo $status[$ticket['status']] ?? '<span class="badge bg-secondary">Desconhecido</span>';
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Contatos Recentes</h5>
                            <a href="index.php?page=admin&secao=contatos" class="btn btn-sm btn-outline-primary">Ver Todos</a>
                        </div>
                        <div class="card-body">
                            <?php if (empty($contatos_recentes)): ?>
                                <p class="text-center text-muted my-4">Nenhum contato encontrado.</p>
                            <?php else: ?>
                                <div class="list-group">
                                    <?php foreach ($contatos_recentes as $contato): ?>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1"><?php echo $contato['nome']; ?></h6>
                                                <small class="text-muted"><?php echo formatarData($contato['data_criacao']); ?></small>
                                            </div>
                                            <p class="mb-1 text-truncate"><?php echo $contato['mensagem']; ?></p>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i> <?php echo $contato['email']; ?>
                                                <?php if (!empty($contato['telefone'])): ?>
                                                    <i class="fas fa-phone ms-2 me-1"></i> <?php echo $contato['telefone']; ?>
                                                <?php endif; ?>
                                            </small>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
