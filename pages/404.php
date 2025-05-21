
<?php
// Definir título da página
$titulo = "Página não encontrada";

// Definir código HTTP 404
http_response_code(404);
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-4">
                    <span class="display-1 fw-bold text-primary">404</span>
                </div>
                <h1 class="h3 mb-4">Oops! Página não encontrada</h1>
                <p class="text-muted mb-5">A página que você está procurando não existe ou foi movida.</p>
                
                <a href="index.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-home me-2"></i> Voltar para o início
                </a>
            </div>
        </div>
    </div>
</section>
