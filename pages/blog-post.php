
<?php
// Definir ID do post
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar se ID existe
if ($id <= 0) {
    include 'pages/404.php';
    exit;
}

// Simulação de posts do blog para demonstração
$posts = [
    1 => [
        'id' => 1,
        'titulo' => '10 Dicas para Reduzir Custos no Condomínio',
        'resumo' => 'Confira estratégias eficientes para economizar nas despesas do seu condomínio sem comprometer a qualidade dos serviços.',
        'conteudo' => '<p>A gestão financeira de um condomínio é um dos maiores desafios enfrentados por síndicos e administradores. Com o aumento constante dos custos de manutenção, energia, água e serviços em geral, encontrar formas de economizar sem comprometer a qualidade de vida dos moradores tornou-se uma necessidade.</p>
                      <p>Neste artigo, apresentamos 10 estratégias eficientes que podem ajudar a reduzir significativamente os gastos do seu condomínio, mantendo ou até mesmo melhorando os serviços oferecidos.</p>
                      <h3>1. Faça um diagnóstico completo dos gastos</h3>
                      <p>Antes de implementar qualquer medida de economia, é fundamental conhecer detalhadamente onde e como o dinheiro está sendo gasto. Realize uma análise minuciosa das contas dos últimos 12 meses, identificando os principais itens de despesa e possíveis inconsistências.</p>
                      <h3>2. Renegocie contratos com prestadores de serviços</h3>
                      <p>Muitos contratos são renovados automaticamente sem uma reavaliação crítica. Compare preços no mercado e use essas informações para renegociar valores com os atuais fornecedores ou considere novas cotações.</p>
                      <h3>3. Invista em iluminação LED</h3>
                      <p>A substituição de lâmpadas convencionais por modelos LED pode gerar economia de até 80% no consumo de energia para iluminação. Embora o investimento inicial seja maior, o retorno acontece em poucos meses.</p>
                      <h3>4. Implemente sensores de presença</h3>
                      <p>Instalar sensores de presença em áreas de circulação, garagens e outros espaços comuns evita que as luzes fiquem acesas desnecessariamente, gerando economia significativa.</p>
                      <h3>5. Revise o sistema hidráulico</h3>
                      <p>Vazamentos podem passar despercebidos e causar enormes desperdícios. Uma revisão periódica do sistema hidráulico pode identificar problemas e evitar gastos excessivos com água.</p>
                      <h3>6. Adote sistemas de captação de água da chuva</h3>
                      <p>A água coletada pode ser utilizada para limpeza de áreas comuns, irrigação de jardins e outras finalidades não potáveis, reduzindo o consumo de água tratada.</p>
                      <h3>7. Invista em automação</h3>
                      <p>Sistemas automatizados para controle de bombas, iluminação e outros equipamentos ajudam a otimizar o consumo e reduzir gastos desnecessários.</p>
                      <h3>8. Promova a coleta seletiva de resíduos</h3>
                      <p>Além do benefício ambiental, a separação correta do lixo pode gerar receita com a venda de materiais recicláveis e reduzir custos com a coleta tradicional.</p>
                      <h3>9. Centralize compras de materiais de limpeza e manutenção</h3>
                      <p>A compra em maior volume geralmente resulta em melhores preços. Estabeleça um cronograma de compras planejadas em vez de aquisições emergenciais.</p>
                      <h3>10. Capacite a equipe de funcionários</h3>
                      <p>Funcionários bem treinados trabalham com mais eficiência e cometem menos erros, o que contribui para a redução de gastos e melhoria dos serviços.</p>
                      <h3>Conclusão</h3>
                      <p>A implementação dessas medidas pode resultar em economia significativa para o condomínio, possibilitando a manutenção do valor da taxa condominial ou até mesmo sua redução. O importante é que essas ações sejam planejadas e executadas com transparência, sempre comunicando aos condôminos os objetivos e resultados alcançados.</p>
                      <p>Lembre-se que pequenas mudanças, quando somadas, podem fazer grande diferença no orçamento do condomínio ao longo do ano.</p>',
        'imagem' => 'assets/img/blog/post1.jpg',
        'data' => '2023-05-10',
        'autor' => 'Carlos Mendes',
        'categoria' => 'Finanças',
        'tags' => ['Economia', 'Gestão Financeira', 'Redução de Custos', 'Condomínio'],
        'comentarios' => [
            ['nome' => 'Roberto Silva', 'data' => '2023-05-11', 'comentario' => 'Excelentes dicas! Já implementamos algumas dessas medidas no nosso condomínio e realmente vimos redução nos gastos.'],
            ['nome' => 'Ana Paula', 'data' => '2023-05-11', 'comentario' => 'A dica sobre sensores de presença é muito boa. Instalamos nas garagens e estamos economizando cerca de 30% na energia elétrica.'],
            ['nome' => 'Marcelo Santos', 'data' => '2023-05-12', 'comentario' => 'Gostaria de saber mais sobre sistemas de captação de água da chuva. Alguém tem experiência com isso?'],
            ['nome' => 'Juliana Martins', 'data' => '2023-05-13', 'comentario' => 'Implementamos a coleta seletiva no nosso condomínio e, além da economia, percebemos uma maior conscientização dos moradores quanto a questões ambientais.']
        ]
    ],
    2 => [
        'id' => 2,
        'titulo' => 'O Papel do Síndico na Gestão Moderna de Condomínios',
        'resumo' => 'Descubra como a função do síndico evoluiu com as novas tecnologias e quais são as habilidades essenciais para uma boa gestão.',
        'conteudo' => '<p>O papel do síndico tem passado por transformações significativas nas últimas décadas. Se antes o cargo era visto como uma obrigação burocrática focada principalmente em cobranças e manutenção básica, hoje representa uma função gerencial complexa que exige múltiplas habilidades e conhecimentos.</p><p>Neste artigo, discutiremos como a função do síndico evoluiu e quais são as competências essenciais para uma gestão moderna e eficiente de condomínios.</p>',
        'imagem' => 'assets/img/blog/post2.jpg',
        'data' => '2023-05-05',
        'autor' => 'Ana Silva',
        'categoria' => 'Gestão Condominial',
        'tags' => ['Síndico', 'Gestão', 'Condomínio', 'Administração'],
        'comentarios' => [
            ['nome' => 'Fernando Oliveira', 'data' => '2023-05-06', 'comentario' => 'Como síndico há 3 anos, posso confirmar que o papel mudou muito. Hoje administramos verdadeiras empresas!'],
            ['nome' => 'Carla Mendes', 'data' => '2023-05-07', 'comentario' => 'Excelente artigo. Realmente, a profissionalização do síndico é cada vez mais necessária.']
        ]
    ]
];

// Verificar se o post existe
if (!isset($posts[$id])) {
    include 'pages/404.php';
    exit;
}

$post = $posts[$id];

// Definir título da página
$titulo = $post['titulo'];
$paginaAtual = 'blog';

// Formatar data
function formatarDataBlog($data) {
    return date('d/m/Y', strtotime($data));
}
?>

<!-- Blog Post Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Conteúdo do Post -->
            <div class="col-lg-8">
                <article>
                    <!-- Título e Metadados -->
                    <header class="mb-4">
                        <h1 class="fw-bold mb-3"><?php echo $post['titulo']; ?></h1>
                        <div class="text-muted mb-3">
                            <span><i class="far fa-calendar-alt me-1"></i> <?php echo formatarDataBlog($post['data']); ?></span>
                            <span class="mx-2">|</span>
                            <span><i class="far fa-user me-1"></i> <?php echo $post['autor']; ?></span>
                            <span class="mx-2">|</span>
                            <span><i class="far fa-folder me-1"></i> <?php echo $post['categoria']; ?></span>
                        </div>
                        <div class="mb-4">
                            <?php foreach ($post['tags'] as $tag): ?>
                                <span class="badge bg-light text-dark me-1">#<?php echo $tag; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </header>
                    
                    <!-- Imagem do Post -->
                    <?php if (!empty($post['imagem'])): ?>
                        <figure class="mb-4">
                            <img src="<?php echo $post['imagem']; ?>" alt="<?php echo $post['titulo']; ?>" class="img-fluid rounded">
                        </figure>
                    <?php endif; ?>
                    
                    <!-- Conteúdo do Post -->
                    <section class="mb-5">
                        <div class="blog-content">
                            <?php echo $post['conteudo']; ?>
                        </div>
                    </section>
                    
                    <!-- Compartilhamento -->
                    <section class="border-top border-bottom py-4 mb-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Compartilhar:</h5>
                            <div class="social-share">
                                <a href="#" class="me-2 text-primary"><i class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="#" class="me-2 text-info"><i class="fab fa-twitter fa-lg"></i></a>
                                <a href="#" class="me-2 text-success"><i class="fab fa-whatsapp fa-lg"></i></a>
                                <a href="#" class="text-secondary"><i class="fas fa-envelope fa-lg"></i></a>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Navegação entre Posts -->
                    <section class="mb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if ($id > 1): ?>
                                    <a href="index.php?page=blog&id=<?php echo $id - 1; ?>" class="btn btn-outline-primary d-block">
                                        <i class="fas fa-arrow-left me-1"></i> Post Anterior
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 text-end">
                                <?php if (isset($posts[$id + 1])): ?>
                                    <a href="index.php?page=blog&id=<?php echo $id + 1; ?>" class="btn btn-outline-primary d-block">
                                        Próximo Post <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Comentários -->
                    <section class="mb-5">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title mb-4">Comentários (<?php echo count($post['comentarios']); ?>)</h3>
                                
                                <?php if (!empty($post['comentarios'])): ?>
                                    <div class="comments">
                                        <?php foreach ($post['comentarios'] as $comentario): ?>
                                            <div class="comment mb-4 pb-4 border-bottom">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="comment-avatar me-3">
                                                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0"><?php echo $comentario['nome']; ?></h5>
                                                        <small class="text-muted"><?php echo formatarDataBlog($comentario['data']); ?></small>
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                    <p class="mb-0"><?php echo $comentario['comentario']; ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">Seja o primeiro a comentar neste post.</p>
                                <?php endif; ?>
                                
                                <!-- Formulário de Comentário -->
                                <div class="comment-form mt-4">
                                    <h4 class="mb-3">Deixe seu comentário</h4>
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3 mb-md-0">
                                                <input type="text" class="form-control" placeholder="Seu nome" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" placeholder="Seu e-mail" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" rows="5" placeholder="Seu comentário" required></textarea>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Enviar Comentário</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Sobre o Autor -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center">
                        <div class="author-avatar mb-3">
                            <i class="fas fa-user-circle fa-5x text-primary"></i>
                        </div>
                        <h4 class="card-title mb-1"><?php echo $post['autor']; ?></h4>
                        <p class="text-muted mb-3">Especialista em Gestão Condominial</p>
                        <p class="card-text">Profissional com mais de 15 anos de experiência em administração de condomínios, consultoria e treinamento para síndicos e gestores.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>
                
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
                
                <!-- Posts Relacionados -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="h5 card-title mb-3">Posts Relacionados</h4>
                        <div class="list-group list-group-flush">
                            <?php 
                            // Filtrar posts da mesma categoria
                            $related_posts = array_filter($posts, function($p) use ($post) {
                                return $p['id'] != $post['id'] && $p['categoria'] == $post['categoria'];
                            });
                            
                            // Limitar a 3 posts
                            $related_posts = array_slice($related_posts, 0, 3);
                            
                            if (!empty($related_posts)): 
                                foreach ($related_posts as $related):
                            ?>
                                <a href="index.php?page=blog&id=<?php echo $related['id']; ?>" class="list-group-item list-group-item-action py-3">
                                    <div class="row align-items-center">
                                        <div class="col-4">
                                            <img src="<?php echo $related['imagem']; ?>" alt="<?php echo $related['titulo']; ?>" class="img-fluid rounded">
                                        </div>
                                        <div class="col-8">
                                            <h6 class="mb-1"><?php echo limitarTexto($related['titulo'], 60); ?></h6>
                                            <small class="text-muted"><?php echo formatarDataBlog($related['data']); ?></small>
                                        </div>
                                    </div>
                                </a>
                            <?php 
                                endforeach; 
                            else: 
                            ?>
                                <p class="text-muted">Nenhum post relacionado encontrado.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Tags -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="h5 card-title mb-3">Tags</h4>
                        <div class="tags">
                            <?php foreach ($post['tags'] as $tag): ?>
                                <a href="index.php?page=blog&tag=<?php echo urlencode($tag); ?>" class="btn btn-sm btn-light mb-2 me-1">
                                    #<?php echo $tag; ?>
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
