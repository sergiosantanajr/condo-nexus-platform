
<?php
// Definir título da página
$titulo = "Blog";

// Configurar paginação
$itens_por_pagina = 6;
$pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Obter posts para a página atual
$posts = obterPosts($itens_por_pagina, $offset);

// Obter total de posts para paginação
try {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM blog_posts WHERE status = 'publicado'");
    $stmt->execute();
    $total_posts = $stmt->fetchColumn();
    $total_paginas = ceil($total_posts / $itens_por_pagina);
} catch (PDOException $e) {
    $total_posts = 0;
    $total_paginas = 1;
}
?>

<!-- Banner da Página -->
<section class="page-banner bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="h1 mb-3">Blog</h1>
                <p class="lead">Artigos e novidades sobre gestão condominial</p>
            </div>
        </div>
    </div>
</section>

<!-- Lista de Posts -->
<section class="blog-list py-5">
    <div class="container">
        <div class="row g-4">
            <?php if (empty($posts)): ?>
                <div class="col-12 text-center">
                    <p>Nenhum artigo publicado no momento.</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <?php if (!empty($post['imagem_capa'])): ?>
                                <img src="<?php echo $post['imagem_capa']; ?>" class="card-img-top" alt="<?php echo $post['titulo']; ?>">
                            <?php endif; ?>
                            <div class="card-body p-4">
                                <h3 class="card-title h5"><?php echo $post['titulo']; ?></h3>
                                <div class="mb-3 text-muted small">
                                    <i class="fas fa-user me-1"></i> <?php echo $post['autor_nome']; ?> 
                                    <i class="fas fa-calendar ms-3 me-1"></i> <?php echo formatarData($post['data_publicacao']); ?>
                                </div>
                                <p class="card-text"><?php echo limitarTexto($post['resumo'] ?? $post['conteudo'], 120); ?></p>
                                <a href="index.php?page=blog&id=<?php echo $post['id']; ?>" class="btn btn-sm btn-outline-primary mt-2">Ler mais</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Paginação -->
        <?php if ($total_paginas > 1): ?>
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Navegação do blog">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo $pagina_atual <= 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="index.php?page=blog&pagina=<?php echo $pagina_atual - 1; ?>" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            
                            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                <li class="page-item <?php echo $i == $pagina_atual ? 'active' : ''; ?>">
                                    <a class="page-link" href="index.php?page=blog&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <li class="page-item <?php echo $pagina_atual >= $total_paginas ? 'disabled' : ''; ?>">
                                <a class="page-link" href="index.php?page=blog&pagina=<?php echo $pagina_atual + 1; ?>" aria-label="Próximo">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Seção Inscreva-se -->
<section class="subscribe-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="h3 mb-4">Receba nossas novidades</h2>
                <p class="mb-4">Inscreva-se para receber nossos artigos mais recentes diretamente no seu e-mail.</p>
                <form class="row g-3 justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Seu melhor e-mail" aria-label="Seu melhor e-mail">
                            <button class="btn btn-primary" type="button">Inscrever-se</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
