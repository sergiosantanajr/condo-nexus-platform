
<?php
// Definir título da página
$titulo = "Serviços";

// Obter lista de serviços
$servicos = obterServicos();
?>

<!-- Banner da Página -->
<section class="page-banner bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="h1 mb-3">Nossos Serviços</h1>
                <p class="lead">Oferecemos soluções completas para a gestão eficiente do seu condomínio</p>
            </div>
        </div>
    </div>
</section>

<!-- Lista de Serviços -->
<section class="services-list py-5">
    <div class="container">
        <div class="row g-4">
            <?php if (empty($servicos)): ?>
                <div class="col-12 text-center">
                    <p>Nenhum serviço cadastrado no momento.</p>
                </div>
            <?php else: ?>
                <?php foreach ($servicos as $servico): ?>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="service-icon me-3">
                                        <i class="fas fa-<?php echo $servico['icone']; ?> fa-2x text-primary"></i>
                                    </div>
                                    <h3 class="h4 mb-0"><?php echo $servico['nome']; ?></h3>
                                </div>
                                
                                <?php if (!empty($servico['imagem'])): ?>
                                    <img src="<?php echo $servico['imagem']; ?>" alt="<?php echo $servico['nome']; ?>" class="img-fluid rounded mb-4">
                                <?php endif; ?>
                                
                                <p class="card-text"><?php echo nl2br($servico['descricao']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Seção CTA -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 mb-4 mb-lg-0">
                <h2 class="mb-2">Gostaria de saber mais sobre nossos serviços?</h2>
                <p class="lead mb-0">Entre em contato conosco e solicite um orçamento personalizado para o seu condomínio.</p>
            </div>
            <div class="col-lg-3 text-lg-end">
                <a href="index.php?page=contato" class="btn btn-light btn-lg">Solicitar Orçamento</a>
            </div>
        </div>
    </div>
</section>

<!-- Perguntas Frequentes -->
<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="h1 mb-3">Perguntas Frequentes</h2>
            <p class="lead">Esclareça suas dúvidas sobre nossos serviços</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="faqAccordion">
                    <!-- Pergunta 1 -->
                    <div class="accordion-item mb-3 border rounded shadow-sm">
                        <h2 class="accordion-header" id="faqHeading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                Como funciona o processo de contratação dos serviços?
                            </button>
                        </h2>
                        <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                O processo de contratação inicia com uma reunião para entendermos as necessidades específicas do seu condomínio. Em seguida, elaboramos uma proposta detalhada com todos os serviços incluídos e valores. Após a aprovação, formalizamos o contrato e iniciamos os trabalhos com um período de transição para que tudo ocorra sem problemas.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pergunta 2 -->
                    <div class="accordion-item mb-3 border rounded shadow-sm">
                        <h2 class="accordion-header" id="faqHeading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                Qual a diferença entre administração e gestão condominial?
                            </button>
                        </h2>
                        <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                A administração condominial envolve principalmente aspectos operacionais e burocráticos, como cobrança de taxas, pagamentos, manutenção básica e cumprimento de obrigações legais. Já a gestão condominial é mais abrangente, incluindo também planejamento estratégico, otimização de recursos, valorização patrimonial e melhoria contínua dos processos, proporcionando uma visão mais completa e de longo prazo para o condomínio.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pergunta 3 -->
                    <div class="accordion-item mb-3 border rounded shadow-sm">
                        <h2 class="accordion-header" id="faqHeading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                Como é feita a prestação de contas aos condôminos?
                            </button>
                        </h2>
                        <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Nossa prestação de contas é realizada mensalmente de forma transparente e detalhada. Disponibilizamos relatórios financeiros completos, incluindo receitas, despesas, inadimplência e saldo em caixa. Todos os documentos ficam disponíveis na área do cliente em nosso portal, e também enviamos por e-mail aos condôminos. Além disso, realizamos reuniões periódicas com o síndico e conselho para esclarecer qualquer dúvida sobre a gestão financeira.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pergunta 4 -->
                    <div class="accordion-item mb-3 border rounded shadow-sm">
                        <h2 class="accordion-header" id="faqHeading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                O sistema oferece acesso online para os condôminos?
                            </button>
                        </h2>
                        <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sim, nosso sistema oferece um portal exclusivo para condôminos acessarem informações como boletos, atas de assembleias, regulamento interno, prestação de contas e comunicados importantes. Também é possível abrir chamados para solicitações ou reclamações, agendar o uso de áreas comuns e participar de enquetes online. Todo esse acesso está disponível 24 horas por dia, 7 dias por semana, através de qualquer dispositivo com acesso à internet.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pergunta 5 -->
                    <div class="accordion-item border rounded shadow-sm">
                        <h2 class="accordion-header" id="faqHeading5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                Como vocês lidam com a inadimplência no condomínio?
                            </button>
                        </h2>
                        <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Trabalhamos com um sistema eficiente de gestão de inadimplência que inclui notificações automáticas, contatos telefônicos e negociações personalizadas com cada condômino em atraso. Buscamos sempre soluções amigáveis antes de partir para ações judiciais, oferecendo condições de pagamento que facilitem a regularização da situação. Em casos persistentes, contamos com assessoria jurídica especializada para realizar as cobranças judiciais necessárias, sempre respeitando as determinações legais e o acordo estabelecido com o condomínio.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
