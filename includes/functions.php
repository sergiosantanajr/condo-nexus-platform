
<?php
session_start();

// Funções gerais do sistema

/**
 * Carrega as configurações do site
 * @return array Configurações do site
 */
function obterConfiguracoes() {
    global $conn;
    try {
        $stmt = $conn->query("SELECT * FROM configuracoes LIMIT 1");
        return $stmt->fetch();
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Formata a data para o padrão brasileiro
 * @param string $data Data no formato americano (YYYY-MM-DD)
 * @return string Data no formato brasileiro (DD/MM/YYYY)
 */
function formatarData($data) {
    if (empty($data)) return '-';
    $timestamp = strtotime($data);
    return date('d/m/Y', $timestamp);
}

/**
 * Formata a data e hora para o padrão brasileiro
 * @param string $dataHora Data e hora no formato americano (YYYY-MM-DD HH:MM:SS)
 * @return string Data e hora no formato brasileiro (DD/MM/YYYY HH:MM)
 */
function formatarDataHora($dataHora) {
    if (empty($dataHora)) return '-';
    $timestamp = strtotime($dataHora);
    return date('d/m/Y H:i', $timestamp);
}

/**
 * Gera um slug a partir de um texto
 * @param string $texto Texto para gerar o slug
 * @return string Slug gerado
 */
function gerarSlug($texto) {
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
    $texto = preg_replace('/[^a-zA-Z0-9\s]/', '', $texto);
    $texto = strtolower(trim($texto));
    $texto = preg_replace('/[\s]+/', '-', $texto);
    return $texto;
}

/**
 * Limita o tamanho de um texto
 * @param string $texto Texto a ser limitado
 * @param int $limite Limite de caracteres
 * @param string $sufixo Sufixo a ser adicionado após o corte
 * @return string Texto limitado
 */
function limitarTexto($texto, $limite, $sufixo = '...') {
    if (strlen($texto) <= $limite) {
        return $texto;
    }
    
    return substr($texto, 0, $limite) . $sufixo;
}

/**
 * Cria um token para redefinição de senha
 * @return string Token gerado
 */
function gerarToken() {
    return bin2hex(random_bytes(32));
}

/**
 * Redireciona para uma URL
 * @param string $url URL para redirecionamento
 */
function redirecionar($url) {
    header("Location: $url");
    exit();
}

/**
 * Verifica se o usuário está logado
 * @return bool True se estiver logado, False caso contrário
 */
function usuarioLogado() {
    return isset($_SESSION['usuario_id']);
}

/**
 * Verifica se o administrador está logado
 * @return bool True se estiver logado, False caso contrário
 */
function adminLogado() {
    return isset($_SESSION['admin_id']);
}

/**
 * Obtém os dados do usuário logado
 * @return array|bool Dados do usuário ou False se não estiver logado
 */
function obterUsuarioLogado() {
    global $conn;
    
    if (!usuarioLogado()) {
        return false;
    }
    
    try {
        $stmt = $conn->prepare("SELECT id, nome, email, telefone, status, ultimo_acesso FROM usuarios WHERE id = ?");
        $stmt->execute([$_SESSION['usuario_id']]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Obtém os dados do administrador logado
 * @return array|bool Dados do administrador ou False se não estiver logado
 */
function obterAdminLogado() {
    global $conn;
    
    if (!adminLogado()) {
        return false;
    }
    
    try {
        $stmt = $conn->prepare("SELECT id, nome, email, ultimo_acesso FROM administradores WHERE id = ?");
        $stmt->execute([$_SESSION['admin_id']]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Valida o formulário de contato
 * @param array $dados Dados do formulário
 * @return array Erros encontrados
 */
function validarFormularioContato($dados) {
    $erros = [];
    
    if (empty($dados['nome'])) {
        $erros[] = 'O nome é obrigatório';
    }
    
    if (empty($dados['email'])) {
        $erros[] = 'O e-mail é obrigatório';
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'E-mail inválido';
    }
    
    if (empty($dados['mensagem'])) {
        $erros[] = 'A mensagem é obrigatória';
    }
    
    return $erros;
}

/**
 * Envia um e-mail
 * @param string $para E-mail de destino
 * @param string $assunto Assunto do e-mail
 * @param string $mensagem Corpo do e-mail
 * @return bool True se enviado com sucesso, False caso contrário
 */
function enviarEmail($para, $assunto, $mensagem) {
    $config = obterConfiguracoes();
    $headers = "From: {$config['nome_site']} <{$config['email_contato']}>\r\n";
    $headers .= "Reply-To: {$config['email_contato']}\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    return mail($para, $assunto, $mensagem, $headers);
}

/**
 * Registra os dados de um novo contato
 * @param array $dados Dados do contato
 * @return bool True se registrado com sucesso, False caso contrário
 */
function registrarContato($dados) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("INSERT INTO contatos (nome, email, telefone, assunto, mensagem, ip) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $dados['nome'],
            $dados['email'],
            $dados['telefone'] ?? null,
            $dados['assunto'] ?? 'Contato pelo site',
            $dados['mensagem'],
            $_SERVER['REMOTE_ADDR']
        ]);
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Obtém os posts do blog
 * @param int $limite Limite de posts
 * @param int $offset Offset para paginação
 * @param string $categoria Slug da categoria (opcional)
 * @return array Posts do blog
 */
function obterPosts($limite = 10, $offset = 0, $categoria = null) {
    global $conn;
    
    try {
        $sql = "SELECT p.*, a.nome as autor_nome 
                FROM blog_posts p 
                JOIN administradores a ON p.autor_id = a.id 
                WHERE p.status = 'publicado'";
        
        if ($categoria) {
            $sql .= " JOIN blog_posts_categorias pc ON p.id = pc.post_id 
                      JOIN blog_categorias c ON pc.categoria_id = c.id 
                      WHERE c.slug = :categoria";
        }
        
        $sql .= " ORDER BY p.data_publicacao DESC LIMIT :limite OFFSET :offset";
        
        $stmt = $conn->prepare($sql);
        
        if ($categoria) {
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        }
        
        $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Obtém um post do blog pelo slug
 * @param string $slug Slug do post
 * @return array|bool Post do blog ou False se não encontrado
 */
function obterPostPorSlug($slug) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("
            SELECT p.*, a.nome as autor_nome 
            FROM blog_posts p 
            JOIN administradores a ON p.autor_id = a.id 
            WHERE p.slug = ? AND p.status = 'publicado'
        ");
        $stmt->execute([$slug]);
        $post = $stmt->fetch();
        
        if ($post) {
            // Incrementa visualizações
            $stmt = $conn->prepare("UPDATE blog_posts SET visualizacoes = visualizacoes + 1 WHERE id = ?");
            $stmt->execute([$post['id']]);
            
            // Obtém categorias do post
            $stmt = $conn->prepare("
                SELECT c.* 
                FROM blog_categorias c 
                JOIN blog_posts_categorias pc ON c.id = pc.categoria_id 
                WHERE pc.post_id = ?
            ");
            $stmt->execute([$post['id']]);
            $post['categorias'] = $stmt->fetchAll();
        }
        
        return $post;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Obtém os serviços ativos
 * @return array Serviços
 */
function obterServicos() {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM servicos WHERE ativo = 1 ORDER BY ordem");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Obtém os depoimentos ativos
 * @param int $limite Limite de depoimentos
 * @return array Depoimentos
 */
function obterDepoimentos($limite = 3) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM depoimentos WHERE ativo = 1 ORDER BY RAND() LIMIT ?");
        $stmt->bindParam(1, $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Obtém os tickets de um usuário
 * @param int $usuario_id ID do usuário
 * @return array Tickets
 */
function obterTicketsUsuario($usuario_id) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("
            SELECT t.*, u.identificacao as unidade_identificacao, 
                  (SELECT COUNT(*) FROM ticket_respostas WHERE ticket_id = t.id) as total_respostas,
                  (SELECT COUNT(*) FROM ticket_respostas WHERE ticket_id = t.id AND usuario_id IS NULL) as respostas_nao_lidas
            FROM tickets t
            LEFT JOIN unidades u ON t.unidade_id = u.id
            WHERE t.usuario_id = ?
            ORDER BY t.data_atualizacao DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Obtém as unidades de um usuário
 * @param int $usuario_id ID do usuário
 * @return array Unidades
 */
function obterUnidadesUsuario($usuario_id) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("
            SELECT u.*, c.nome as condominio_nome
            FROM unidades u
            JOIN condominios c ON u.condominio_id = c.id
            WHERE u.proprietario_id = ? OR u.inquilino_id = ?
            ORDER BY c.nome, u.identificacao
        ");
        $stmt->execute([$usuario_id, $usuario_id]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Valida o login de um usuário
 * @param string $email E-mail
 * @param string $senha Senha
 * @return array|bool ID do usuário ou False se inválido
 */
function validarLoginUsuario($email, $senha) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE email = ? AND status = 'ativo'");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Atualiza último acesso
            $stmt = $conn->prepare("UPDATE usuarios SET ultimo_acesso = NOW() WHERE id = ?");
            $stmt->execute([$usuario['id']]);
            
            return $usuario['id'];
        }
        
        return false;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Valida o login de um administrador
 * @param string $email E-mail
 * @param string $senha Senha
 * @return array|bool ID do administrador ou False se inválido
 */
function validarLoginAdmin($email, $senha) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT id, senha FROM administradores WHERE email = ? AND status = 'ativo'");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($senha, $admin['senha'])) {
            // Atualiza último acesso
            $stmt = $conn->prepare("UPDATE administradores SET ultimo_acesso = NOW() WHERE id = ?");
            $stmt->execute([$admin['id']]);
            
            return $admin['id'];
        }
        
        return false;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Cadastra um novo usuário
 * @param array $dados Dados do usuário
 * @return bool|string ID do usuário ou mensagem de erro
 */
function cadastrarUsuario($dados) {
    global $conn;
    
    try {
        // Verifica se e-mail já existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$dados['email']]);
        
        if ($stmt->rowCount() > 0) {
            return "E-mail já cadastrado";
        }
        
        // Verifica se CPF já existe
        if (!empty($dados['cpf'])) {
            $stmt = $conn->prepare("SELECT id FROM usuarios WHERE cpf = ?");
            $stmt->execute([$dados['cpf']]);
            
            if ($stmt->rowCount() > 0) {
                return "CPF já cadastrado";
            }
        }
        
        // Insere o usuário
        $stmt = $conn->prepare("
            INSERT INTO usuarios (nome, email, senha, telefone, cpf, status) 
            VALUES (?, ?, ?, ?, ?, 'pendente')
        ");
        
        $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        
        $stmt->execute([
            $dados['nome'],
            $dados['email'],
            $senha_hash,
            $dados['telefone'] ?? null,
            $dados['cpf'] ?? null
        ]);
        
        return $conn->lastInsertId();
    } catch (PDOException $e) {
        return "Erro ao cadastrar: " . $e->getMessage();
    }
}
