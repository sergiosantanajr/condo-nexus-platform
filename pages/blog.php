
<?php
// Definir título da página
$titulo = "Blog";
$paginaAtual = 'blog';

// Configurações de paginação
$posts_por_pagina = 6;
$pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina_atual - 1) * $posts_por_pagina;

// Simular posts do blog para demonstração
$categorias = ['Gestão Condominial', 'Legislação', 'Dicas', 'Finanças', 'Tecnologia'];

$posts = [
    [
        'id' => 1,
        'titulo' => '10 Dicas para Reduzir Custos no Condomínio',
        'resumo' => 'Confira estratégias eficientes para economizar nas despesas do seu condomínio sem comprometer a qualidade dos serviços.',
        'imagem' => 'assets/img/blog/post1.jpg',
        'data' => '2023-05-10',
        'autor' => 'Carlos Mendes',
        'categoria' => 'Finanças',
        'comentarios' => 8
    ],
    [
        'id' => 2,
        'titulo' => 'O Papel do Síndico na Gestão Moderna de Condomínios',
        'resumo' => 'Descubra como a função do síndico evoluiu com as novas tecnologias e quais são as habilidades essenciais para uma boa gestão.',
        'imagem' => 'assets/img/blog/post2.jpg',
        'data' => '2023-05-05',
        'autor' => 'Ana Silva',
        'categoria' => 'Gestão Condominial',
        'comentarios' => 5
    ],
    [
        'id' => 3,
        'titulo' => 'Alterações na Nova Lei do Condomínio: O Que Mudou?',
        'resumo' => 'Análise completa das principais mudanças na legislação condominial e como elas afetam o dia a dia dos condomínios.',
        'imagem' => 'assets/img/blog/post3.jpg',
        'data' => '2023-04-28',
        'autor' => 'Roberto Almeida',
        'categoria' => 'Legislação',
        'comentarios' => 12
    ],
    [
        'id' => 4,
        'titulo' => 'Como Implementar Coleta Seletiva no Seu Condomínio',
        'resumo' => 'Guia prático para iniciar um projeto de coleta seletiva eficiente e engajar os moradores em práticas sustentáveis.',
        'imagem' => 'assets/img/blog/post4.jpg',
        'data' => '2023-04-15',
        'autor' => 'Patrícia Santos',
        'categoria' => 'Dicas',
        'comentarios' => 7
    ],
    [
        'id' => 5,
        'titulo' => 'Segurança Condominial: Tecnologias que Fazem a Diferença',
        'resumo' => 'Conheça as principais inovações em segurança eletrônica para proteger seu condomínio e aumentar a tranquilidade dos moradores.',
        'imagem' => 'assets/img/blog/post5.jpg',
        'data' => '2023-04-05',
        'autor' => 'Ricardo Oliveira',
        'categoria' => 'Tecnologia',
        'comentarios' => 9
    ],
    [
        'id' => 6,
        'titulo' => 'Assembleias Digitais: Como Realizar e Quais as Vantagens',
        'resumo' => 'Saiba como organizar assembleias condominiais no formato digital, garantindo participação e respeitando os aspectos legais.',
        'imagem' => 'assets/img/blog/post6.jpg',
        'data' => '2023-03-22',
        'autor' => 'Mariana Costa',
        'categoria' => 'Tecnologia',
        'comentarios' => 6
    ],
    [
        'id' => 7,
        'titulo' => 'Inadimplência no Condomínio: Estratégias de Prevenção e Cobrança',
        'resumo' => 'Dicas práticas para reduzir a inadimplência e os procedimentos adequados para realizar cobranças eficientes.',
        'imagem' => 'assets/img/blog/post7.jpg',
        'data' => '2023-03-14',
        'autor' => 'Fernando Souza',
        'categoria' => 'Finanças',
        'comentarios' => 11
    ],
    [
        'id' => 8,
        'titulo' => 'Responsabilidade Civil do Síndico: O Que Você Precisa Saber',
        'resumo' => 'Entenda os limites da responsabilidade legal do síndico e como se proteger de possíveis problemas jurídicos.',
        'imagem' => 'assets/img/blog/post8.jpg',
        'data' => '2023-03-05',
        'autor' => 'Juliana Martins',
        'categoria' => 'Legislação',
        'comentarios' => 4
    ],
    [
        'id' => 9,
        'titulo' => 'Manutenção Preventiva: Economizando com Planejamento',
        'resumo' => 'Como um bom plano de manutenção preventiva pode evitar gastos excessivos e preservar o valor do patrimônio condominial.',
        'imagem' => 'assets/img/blog/post9.jpg',
        'data' => '2023-02-25',
        'autor' => 'Carlos Mendes',
        'categoria' => 'Gestão Condominial',
        'comentarios' => 7
    ]
];

// Filtrar posts por categoria se especificado
$categoria_filtro = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';
if (!empty($categoria_filtro)) {
    $posts_filtrados = array_filter($posts, function($post) use ($categoria_filtro) {
        return $post['categoria'] === $categoria_filtro;
    });
    $posts = array_values($posts_filtrados);
}

// Calcular total de posts e páginas
$total_posts = count($posts);
$total_paginas = ceil($total_posts / $posts_por_pagina);

// Obter posts da página atual
$posts_paginados = array_slice($posts, $offset, $posts_por_pagina);

// Formatar data
function formatarDataBlog($data) {
    return date('d/m/Y', strtotime($data));
}
?>

<!-- Hero Section -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="fw-bold mb-4">Blog Nova Alternativa</h1>
                <p class="lead mb-4">Conteúdo especializado sobre gestão condominial, tendências do mercado e dicas para síndicos e condôminos.</p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Posts do Blog -->
            <div class="col-lg-8">
                <?php if (empty($posts_paginados)): ?>
                    <div class="alert alert-info">
                        <p class="mb-0">Nenhum post encontrado <?php echo !empty($categoria_filtro) ? 'na categoria ' . $categoria_filtro : ''; ?>.</p>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($posts_paginados as $post): ?>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <?php if (!empty($post['imagem'])): ?>
                                        <img src="<?php echo $post['imagem']; ?>" class="card-img-top" alt="<?php echo $post['titulo']; ?>">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-primary"><?php echo $post['categoria']; ?></span>
                                            <small class="text-muted"><?php echo formatarDataBlog($post['data']); ?></small>
                                        </div>
                                        <h3 class="h5 card-title">
                                            <a href="index.php?page=blog&id=<?php echo $post['id']; ?>" class="text-dark text-decoration-none">
                                                <?php echo $post['titulo']; ?>
                                            </a>
                                        </h3>
                                        <p class="card-text text-muted"><?php echo limitarTexto($post['resumo'], 120); ?></p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">Por <?php echo $post['autor']; ?></small>
                                            <span>
                                                <i class="far fa-comment text-muted"></i>
                                                <small class="text-muted ms-1"><?php echo $post['comentarios']; ?></small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Paginação -->
                    <?php if ($total_paginas > 1): ?>
                        <nav class="mt-5">
                            <ul class="pagination justify-content-center">
                                <?php if ($pagina_atual > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="index.php?page=blog&pagina=<?php echo $pagina_atual - 1; ?><?php echo !empty($categoria_filtro) ? '&categoria=' . urlencode($categoria_filtro) : ''; ?>">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                    <li class="page-item <?php echo $i === $pagina_atual ? 'active' : ''; ?>">
                                        <a class="page-link" href="index.php?page=blog&pagina=<?php echo $i; ?><?php echo !empty($categoria_filtro) ? '&categoria=' . urlencode($categoria_filtro) : ''; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if ($pagina_atual < $total_paginas): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="index.php?page=blog&pagina=<?php echo $pagina_atual + 1; ?><?php echo !empty($categoria_filtro) ? '&categoria=' . urlencode($categoria_filtro) : ''; ?>">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Busca -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="h5 card-title mb-3">Pesquisar</h4>
                        <form action="index.php" method="get">
                            <input type="hidden" name="page" value="blog">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Buscar posts...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Categorias -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="h5 card-title mb-3">Categorias</h4>
                        <div class="list-group list-group-flush">
                            <a href="index.php?page=blog" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo empty($categoria_filtro) ? 'active' : ''; ?>">
                                Todas as Categorias
                                <span class="badge bg-primary rounded-pill"><?php echo $total_posts; ?></span>
                            </a>
                            <?php foreach ($categorias as $categoria): ?>
                                <?php
                                $count = count(array_filter($posts, function($post) use ($categoria) {
                                    return $post['categoria'] === $categoria;
                                }));
                                ?>
                                <a href="index.php?page=blog&categoria=<?php echo urlencode($categoria); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php echo $categoria_filtro === $categoria ? 'active' : ''; ?>">
                                    <?php echo $categoria; ?>
                                    <span class="badge bg-primary rounded-pill"><?php echo $count; ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Posts Populares -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="h5 card-title mb-3">Posts Populares</h4>
                        <div class="list-group list-group-flush">
                            <?php 
                            // Ordenar posts por número de comentários (mais populares)
                            $popular_posts = $posts;
                            usort($popular_posts, function($a, $b) {
                                return $b['comentarios'] - $a['comentarios'];
                            });
                            $popular_posts = array_slice($popular_posts, 0, 5);
                            
                            foreach ($popular_posts as $post):
                            ?>
                                <a href="index.php?page=blog&id=<?php echo $post['id']; ?>" class="list-group-item list-group-item-action py-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?php echo limitarTexto($post['titulo'], 60); ?></h6>
                                        <small class="text-primary">
                                            <i class="far fa-comment"></i>
                                            <?php echo $post['comentarios']; ?>
                                        </small>
                                    </div>
                                    <small class="text-muted"><?php echo formatarDataBlog($post['data']); ?></small>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Newsletter -->
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body p-4">
                        <h4 class="h5 card-title mb-3">Assine nossa Newsletter</h4>
                        <p class="card-text mb-3">Receba artigos, dicas e novidades sobre gestão condominial diretamente no seu e-mail.</p>
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Seu melhor e-mail" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-light">Inscrever-se</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
