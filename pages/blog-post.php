
<?php
// Obter ID do post da URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Buscar post específico
try {
    $stmt = $conn->prepare("
        SELECT p.*, a.nome as autor_nome, a.email as autor_email  
        FROM blog_posts p 
        JOIN administradores a ON p.autor_id = a.id 
        WHERE p.id = ? AND p.status = 'publicado'
    ");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();
    
    if ($post) {
        // Incrementa visualizações
        $stmt = $conn->prepare("UPDATE blog_posts SET visualizacoes = visualizacoes + 1 WHERE id = ?");
        $stmt->execute([$post_id]);
        
        // Buscar categorias do post
        $stmt = $conn->prepare("
            SELECT c.* 
            FROM blog_categorias c 
            JOIN blog_posts_categorias pc ON c.id = pc.categoria_id 
            WHERE pc.post_id = ?
        ");
        $stmt->execute([$post_id]);
        $categorias = $stmt->fetchAll();
        
        // Definir título da página
        $titulo = $post['titulo'];
        
        // Buscar posts relacionados
        $stmt = $conn->prepare("
            SELECT p.id, p.titulo, p.imagem_capa, p.data_publicacao 
            FROM blog_posts p 
            JOIN blog_posts_categorias pc1 ON p.id = pc1.post_id 
            JOIN blog_posts_categorias pc2 ON pc1.categoria_id = pc2.categoria_id 
            WHERE pc2.post_id = ? AND p.id != ? AND p.status = 'publicado' 
            GROUP BY p.id 
            ORDER BY p.data_publicacao DESC 
            LIMIT 3
        ");
        $stmt->execute([$post_id, $post_id]);
        $posts_relacionados = $stmt->fetchAll();
    } else {
        // Post não encontrado, redirecionar para página de blog
        header('Location: index.php?page=blog');
        exit();
    }
} catch (PDOException $e) {
    // Erro na consulta, redirecionar para página de blog
    header('Location: index.php?page=blog');
    exit();
}
?>

<!-- Artigo Completo -->
<section class="blog-post py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Imagem de Capa -->
                <?php if (!empty($post['imagem_capa'])): ?>
                    <div class="blog-post-image mb-4">
                        <img src="<?php echo $post['imagem_capa']; ?>" alt="<?php echo $post['titulo']; ?>" class="img-fluid rounded shadow">
                    </div>
                <?php endif; ?>
                
                <!-- Cabeçalho do Post -->
                <div class="blog-post-header mb-4">
                    <h1 class="blog-post-title h2 mb-3"><?php echo $post['titulo']; ?></h1>
                    <div class="blog-post-meta d-flex flex-wrap align-items-center text-muted mb-3">
                        <div class="me-4">
                            <i class="fas fa-user me-1"></i> <?php echo $post['autor_nome']; ?>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-calendar me-1"></i> <?php echo formatarDataHora($post['data_publicacao']); ?>
                        </div>
                        <div>
                            <i class="fas fa-eye me-1"></i> <?php echo $post['visualizacoes']; ?> visualizações
                        </div>
                    </div>
                    
                    <?php if (!empty($categorias)): ?>
                        <div class="blog-post-categories mb-4">
                            <?php foreach ($categorias as $categoria): ?>
                                <span class="badge bg-secondary me-2"><?php echo $categoria['nome']; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Conteúdo do Post -->
                <div class="blog-post-content mb-5">
                    <?php echo nl2br($post['conteudo']); ?>
                </div>
                
                <!-- Compartilhar -->
                <div class="blog-post-share mb-5">
                    <h5 class="mb-3">Compartilhar:</h5>
                    <div class="d-flex">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?php echo urlencode($post['titulo']); ?>" target="_blank" class="btn btn-sm btn-outline-info me-2">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text=<?php echo urlencode($post['titulo'] . " - http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" class="btn btn-sm btn-outline-success me-2">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="mailto:?subject=<?php echo urlencode($post['titulo']); ?>&body=<?php echo urlencode("Confira este artigo: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-envelope me-1"></i> E-mail
                        </a>
                    </div>
                </div>
                
                <!-- Sobre o Autor -->
                <div class="blog-post-author bg-light p-4 rounded mb-5">
                    <h5 class="mb-3">Sobre o Autor</h5>
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div>
                            <h6><?php echo $post['autor_nome']; ?></h6>
                            <p class="mb-0">Profissional especializado em gestão condominial, com experiência no setor e conhecimento das melhores práticas do mercado.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Posts Relacionados -->
                <?php if (!empty($posts_relacionados)): ?>
                    <div class="blog-related-posts mb-5">
                        <h4 class="mb-4">Artigos Relacionados</h4>
                        <div class="row g-4">
                            <?php foreach ($posts_relacionados as $relacionado): ?>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <?php if (!empty($relacionado['imagem_capa'])): ?>
                                            <img src="<?php echo $relacionado['imagem_capa']; ?>" class="card-img-top" alt="<?php echo $relacionado['titulo']; ?>">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h5 class="card-title h6"><?php echo $relacionado['titulo']; ?></h5>
                                            <p class="card-text small text-muted mb-2">
                                                <i class="fas fa-calendar me-1"></i> <?php echo formatarData($relacionado['data_publicacao']); ?>
                                            </p>
                                            <a href="index.php?page=blog&id=<?php echo $relacionado['id']; ?>" class="btn btn-sm btn-outline-primary">Ler mais</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Navegação -->
                <div class="blog-post-navigation d-flex justify-content-between">
                    <a href="index.php?page=blog" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i> Voltar para o Blog
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
