
<?php
// Verificar se o usuário está logado
if (!usuarioLogado()) {
    header('Location: index.php?page=portal');
    exit();
}

// Obter dados do usuário logado
$usuario = obterUsuarioLogado();

// Obter tickets do usuário
$tickets = obterTicketsUsuario($_SESSION['usuario_id']);

// Obter unidades do usuário
$unidades = obterUnidadesUsuario($_SESSION['usuario_id']);

// Definir título da página
$titulo = "Dashboard - Portal do Cliente";
?>

<!-- Barra de Navegação do Portal -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <div class="user-profile p-3 mb-4 border-bottom text-center">
                    <div class="user-avatar mb-3">
                        <i class="fas fa-user-circle fa-4x text-primary"></i>
                    </div>
                    <h6 class="mb-1"><?php echo $usuario['nome']; ?></h6>
                    <p class="small text-muted mb-0"><?php echo $usuario['email']; ?></p>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=portal&secao=dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=portal&secao=tickets">
                            <i class="fas fa-ticket-alt me-2"></i>
                            Tickets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-home me-2"></i>
                            Meus Imóveis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-invoice-dollar me-2"></i>
                            Financeiro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-alt me-2"></i>
                            Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-question-circle me-2"></i>
                            Ajuda
                        </a>
                    </li>
                </ul>
                
                <hr>
                
                <div class="px-3">
                    <a href="index.php?page=portal&logout=1" class="btn btn-outline-danger w-100">
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
            
            <!-- Cards Informativos -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Imóveis</h5>
                                <div class="dashboard-icon bg-primary text-white rounded-circle">
                                    <i class="fas fa-home"></i>
                                </div>
                            </div>
                            <h3 class="mb-0"><?php echo count($unidades); ?></h3>
                            <p class="text-muted small mb-0">imóveis vinculados</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Tickets</h5>
                                <div class="dashboard-icon bg-success text-white rounded-circle">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                            </div>
                            <h3 class="mb-0"><?php echo count($tickets); ?></h3>
                            <p class="text-muted small mb-0">solicitações abertas</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Boletos</h5>
                                <div class="dashboard-icon bg-warning text-white rounded-circle">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">0</h3>
                            <p class="text-muted small mb-0">pendentes de pagamento</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="card-title mb-0">Notificações</h5>
                                <div class="dashboard-icon bg-info text-white rounded-circle">
                                    <i class="fas fa-bell"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">0</h3>
                            <p class="text-muted small mb-0">não lidas</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Últimos Tickets -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Últimos Tickets</h5>
                                <a href="index.php?page=portal&secao=tickets" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus me-1"></i> Novo Ticket
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (empty($tickets)): ?>
                                <p class="text-center text-muted my-4">Você ainda não possui tickets cadastrados.</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Título</th>
                                                <th scope="col">Categoria</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Data</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $contador = 0;
                                            foreach ($tickets as $ticket): 
                                                $contador++;
                                                if ($contador > 5) break; // Limitar a 5 tickets
                                            ?>
                                                <tr>
                                                    <td><?php echo $ticket['id']; ?></td>
                                                    <td><?php echo $ticket['titulo']; ?></td>
                                                    <td>
                                                        <?php 
                                                            $categorias = [
                                                                'reclamacao' => '<span class="badge bg-danger">Reclamação</span>',
                                                                'solicitacao' => '<span class="badge bg-primary">Solicitação</span>',
                                                                'manutencao' => '<span class="badge bg-warning text-dark">Manutenção</span>',
                                                                'sugestao' => '<span class="badge bg-info text-dark">Sugestão</span>',
                                                                'outro' => '<span class="badge bg-secondary">Outro</span>'
                                                            ];
                                                            echo $categorias[$ticket['categoria']] ?? '<span class="badge bg-secondary">Outro</span>';
                                                        ?>
                                                    </td>
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
                                                    <td><?php echo formatarData($ticket['data_criacao']); ?></td>
                                                    <td>
                                                        <a href="index.php?page=portal&secao=tickets&id=<?php echo $ticket['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if (count($tickets) > 5): ?>
                                    <div class="text-center mt-3">
                                        <a href="index.php?page=portal&secao=tickets" class="btn btn-link">Ver todos os tickets</a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Meus Imóveis -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Meus Imóveis</h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($unidades)): ?>
                                <p class="text-center text-muted my-4">Você ainda não possui imóveis vinculados.</p>
                            <?php else: ?>
                                <div class="row g-4">
                                    <?php foreach ($unidades as $unidade): ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card h-100 border">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <?php echo $unidade['condominio_nome']; ?>
                                                    </h5>
                                                    <p class="card-text">
                                                        <strong>Unidade:</strong> <?php echo $unidade['identificacao']; ?><br>
                                                        <strong>Tipo:</strong> 
                                                        <?php 
                                                            $tipos = [
                                                                'apartamento' => 'Apartamento',
                                                                'casa' => 'Casa',
                                                                'sala comercial' => 'Sala Comercial'
                                                            ];
                                                            echo $tipos[$unidade['tipo']] ?? $unidade['tipo'];
                                                        ?><br>
                                                        <strong>Status:</strong> 
                                                        <?php echo $unidade['status'] == 'ocupado' ? 'Ocupado' : 'Vago'; ?>
                                                    </p>
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <span class="badge bg-<?php echo $unidade['proprietario_id'] == $_SESSION['usuario_id'] ? 'success' : 'info'; ?>">
                                                            <?php echo $unidade['proprietario_id'] == $_SESSION['usuario_id'] ? 'Proprietário' : 'Inquilino'; ?>
                                                        </span>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">Detalhes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Documentos Recentes -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Documentos Recentes</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-center text-muted my-4">Nenhum documento disponível no momento.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
