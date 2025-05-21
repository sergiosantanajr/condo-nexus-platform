
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

// Obter unidades do usuário para formulário
$unidades = obterUnidadesUsuario($_SESSION['usuario_id']);

// Processamento do formulário de novo ticket
$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'novo_ticket') {
    $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';
    $unidade_id = isset($_POST['unidade_id']) ? intval($_POST['unidade_id']) : null;
    
    // Validar campos
    if (empty($titulo)) {
        $erro = "Por favor, informe o título do ticket.";
    } elseif (empty($descricao)) {
        $erro = "Por favor, descreva o problema ou solicitação.";
    } elseif (empty($categoria)) {
        $erro = "Por favor, selecione uma categoria.";
    } else {
        // Criar novo ticket
        try {
            $stmt = $conn->prepare("
                INSERT INTO tickets 
                (usuario_id, titulo, descricao, categoria, status, unidade_id, data_criacao) 
                VALUES (?, ?, ?, ?, 'aberto', ?, NOW())
            ");
            
            $resultado = $stmt->execute([
                $_SESSION['usuario_id'],
                $titulo,
                $descricao,
                $categoria,
                $unidade_id ?: null
            ]);
            
            if ($resultado) {
                $sucesso = "Ticket criado com sucesso!";
                
                // Recarregar tickets após criação
                $tickets = obterTicketsUsuario($_SESSION['usuario_id']);
                
                // Limpar campos
                $titulo = $descricao = $categoria = '';
                $unidade_id = null;
            } else {
                $erro = "Erro ao criar ticket. Por favor, tente novamente.";
            }
        } catch (PDOException $e) {
            $erro = "Erro de sistema. Por favor, tente novamente mais tarde.";
        }
    }
}

// Definir título da página
$titulo = "Tickets - Portal do Cliente";
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
                        <a class="nav-link" href="index.php?page=portal&secao=dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=portal&secao=tickets">
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
                <h1 class="h2">Tickets</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#novoTicketModal">
                        <i class="fas fa-plus me-2"></i> Novo Ticket
                    </button>
                </div>
            </div>
            
            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($sucesso)): ?>
                <div class="alert alert-success"><?php echo $sucesso; ?></div>
            <?php endif; ?>
            
            <!-- Lista de Tickets -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Meus Tickets</h5>
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
                                        <th scope="col">Respostas</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tickets as $ticket): ?>
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
                                                <?php if ($ticket['total_respostas'] > 0): ?>
                                                    <span class="badge bg-primary rounded-pill"><?php echo $ticket['total_respostas']; ?></span>
                                                    <?php if ($ticket['respostas_nao_lidas'] > 0): ?>
                                                        <span class="badge bg-danger rounded-pill ms-1"><?php echo $ticket['respostas_nao_lidas']; ?> nova(s)</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-dark">Nenhuma</span>
                                                <?php endif; ?>
                                            </td>
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
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Informações sobre Categorias de Tickets -->
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="ticket-category-icon bg-danger text-white rounded-circle me-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h5 class="card-title mb-0">Reclamações</h5>
                            </div>
                            <p class="card-text">Use esta categoria para registrar reclamações sobre problemas que estejam ocorrendo no condomínio.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="ticket-category-icon bg-primary text-white rounded-circle me-3">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <h5 class="card-title mb-0">Solicitações</h5>
                            </div>
                            <p class="card-text">Para pedir autorizações, documentos ou solicitar informações sobre assuntos relacionados ao condomínio.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="ticket-category-icon bg-warning text-white rounded-circle me-3">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <h5 class="card-title mb-0">Manutenção</h5>
                            </div>
                            <p class="card-text">Solicite reparos e manutenções nas áreas comuns ou informe problemas em sua unidade que precisem de suporte.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="ticket-category-icon bg-info text-white rounded-circle me-3">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h5 class="card-title mb-0">Sugestões</h5>
                            </div>
                            <p class="card-text">Compartilhe suas ideias e sugestões para melhorar a convivência, segurança e qualidade de vida no condomínio.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Novo Ticket -->
<div class="modal fade" id="novoTicketModal" tabindex="-1" aria-labelledby="novoTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="novoTicketModalLabel">Novo Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="acao" value="novo_ticket">
                    
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título *</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria *</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <option value="reclamacao">Reclamação</option>
                            <option value="solicitacao">Solicitação</option>
                            <option value="manutencao">Manutenção</option>
                            <option value="sugestao">Sugestão</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="unidade_id" class="form-label">Unidade relacionada</label>
                        <select class="form-select" id="unidade_id" name="unidade_id">
                            <option value="">Selecione uma unidade (opcional)</option>
                            <?php foreach ($unidades as $unidade): ?>
                                <option value="<?php echo $unidade['id']; ?>">
                                    <?php echo $unidade['condominio_nome']; ?> - <?php echo $unidade['identificacao']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição *</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="5" required></textarea>
                        <div class="form-text">Descreva detalhadamente sua solicitação ou problema para que possamos atendê-lo melhor.</div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="concordo" required>
                            <label class="form-check-label" for="concordo">
                                Concordo em fornecer informações verdadeiras e precisas para a resolução deste ticket.
                            </label>
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.ticket-category-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
