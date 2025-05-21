
<?php
// Obter configurações do site
$config = isset($config) ? $config : obterConfiguracoes();
?>
    </main>
    
    <!-- Rodapé -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <!-- Coluna 1: Logo e Sobre -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3 text-white">
                        <?php if (!empty($config['logo_url'])): ?>
                            <img src="<?php echo $config['logo_url']; ?>" alt="<?php echo $config['nome_site']; ?>" height="40" class="mb-3">
                        <?php else: ?>
                            <?php echo $config['nome_site']; ?>
                        <?php endif; ?>
                    </h5>
                    <p class="mb-3 text-light">Sistema profissional de gestão de condomínios, oferecendo soluções completas para administração condominial.</p>
                    <div class="social-links">
                        <?php if (!empty($config['facebook_url'])): ?>
                            <a href="<?php echo $config['facebook_url']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        
                        <?php if (!empty($config['instagram_url'])): ?>
                            <a href="<?php echo $config['instagram_url']; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        
                        <?php if (!empty($config['whatsapp'])): ?>
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $config['whatsapp']); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Coluna 2: Links Rápidos -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3 text-white">Links Rápidos</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="index.php">Início</a></li>
                        <li><a href="index.php?page=servicos">Serviços</a></li>
                        <li><a href="index.php?page=blog">Blog</a></li>
                        <li><a href="index.php?page=contato">Contato</a></li>
                        <li><a href="index.php?page=portal">Área do Cliente</a></li>
                        <li><a href="index.php?page=admin">Administração</a></li>
                    </ul>
                </div>
                
                <!-- Coluna 3: Contato -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3 text-white">Contato</h5>
                    <address class="mb-0 text-light">
                        <?php if (!empty($config['endereco'])): ?>
                            <p><i class="fas fa-map-marker-alt me-2"></i> <?php echo nl2br($config['endereco']); ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($config['telefone'])): ?>
                            <p><i class="fas fa-phone me-2"></i> <?php echo $config['telefone']; ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($config['email_contato'])): ?>
                            <p><i class="fas fa-envelope me-2"></i> <?php echo $config['email_contato']; ?></p>
                        <?php endif; ?>
                    </address>
                </div>
            </div>
            
            <hr class="mt-4 mb-4 border-light opacity-25">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 text-light">&copy; <?php echo date('Y'); ?> <?php echo $config['nome_site']; ?>. Todos os direitos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0 footer-bottom-links">
                        <li class="list-inline-item"><a href="#">Termos de Uso</a></li>
                        <li class="list-inline-item"><a href="#">Política de Privacidade</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
