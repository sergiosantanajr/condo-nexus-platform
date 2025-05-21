
<?php
// Obter configurações do site
$config = isset($config) ? $config : obterConfiguracoes();
?>
    </main>
    
    <!-- Rodapé -->
    <footer class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <!-- Coluna 1: Logo e Sobre -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">
                        <?php if (!empty($config['logo_url'])): ?>
                            <img src="<?php echo $config['logo_url']; ?>" alt="<?php echo $config['nome_site']; ?>" height="40" class="mb-3">
                        <?php else: ?>
                            <?php echo $config['nome_site']; ?>
                        <?php endif; ?>
                    </h5>
                    <p class="mb-3">Sistema profissional de gestão de condomínios, oferecendo soluções completas para administração condominial.</p>
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
                    <h5 class="mb-3">Links Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white-50">Início</a></li>
                        <li><a href="index.php?page=servicos" class="text-white-50">Serviços</a></li>
                        <li><a href="index.php?page=blog" class="text-white-50">Blog</a></li>
                        <li><a href="index.php?page=contato" class="text-white-50">Contato</a></li>
                        <li><a href="index.php?page=portal" class="text-white-50">Área do Cliente</a></li>
                        <li><a href="index.php?page=admin" class="text-white-50">Administração</a></li>
                    </ul>
                </div>
                
                <!-- Coluna 3: Contato -->
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Contato</h5>
                    <address class="mb-0 text-white-50">
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
            
            <hr class="mt-4 mb-4 border-secondary">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 text-white-50">&copy; <?php echo date('Y'); ?> <?php echo $config['nome_site']; ?>. Todos os direitos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white-50">Termos de Uso</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white-50">Política de Privacidade</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
