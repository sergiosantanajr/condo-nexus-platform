
<?php
session_start();

/**
 * Obter configurações do site
 * @return array Array com as configurações do site
 */
function obterConfiguracoes() {
    global $conn;
    $config = [
        'nome_site' => 'Nova Alternativa',
        'logo_url' => 'assets/img/logo.png',
        'whatsapp' => '(11) 99999-9999',
        'telefone' => '(11) 3333-3333',
        'email_contato' => 'contato@novaalternativa.com.br',
        'endereco' => 'Av. Paulista, 1000\nSão Paulo - SP',
        'facebook_url' => 'https://facebook.com/',
        'instagram_url' => 'https://instagram.com/',
        'descricao_site' => 'Sistema profissional de gestão de condomínios'
    ];
    
    // Se estiver conectado ao banco de dados, buscar as configurações
    if (isset($conn)) {
        try {
            $stmt = $conn->query("SELECT * FROM configuracoes LIMIT 1");
            if ($stmt->rowCount() > 0) {
                $config_db = $stmt->fetch(PDO::FETCH_ASSOC);
                // Mesclar configurações do banco com as padrões
                $config = array_merge($config, $config_db);
            }
        } catch (PDOException $e) {
            // Silencia erro e usa config padrão
        }
    }
    
    return $config;
}

/**
 * Verificar se o usuário está logado
 * @return bool True se estiver logado, False caso contrário
 */
function usuarioLogado() {
    return isset($_SESSION['usuario_id']);
}

/**
 * Verificar se o administrador está logado
 * @return bool True se estiver logado, False caso contrário
 */
function adminLogado() {
    return isset($_SESSION['admin_id']);
}

/**
 * Validar login do usuário
 * @param string $email Email do usuário
 * @param string $senha Senha do usuário
 * @return mixed ID do usuário se login válido, False caso contrário
 */
function validarLoginUsuario($email, $senha) {
    global $conn;
    
    // Simular login bem-sucedido para demonstração
    if ($email == 'demo@example.com' && $senha == 'demo123') {
        return 1;
    }
    
    if (!isset($conn)) {
        return false;
    }
    
    try {
        $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE email = ? AND status = 'ativo' LIMIT 1");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch();
            
            if (password_verify($senha, $usuario['senha'])) {
                return $usuario['id'];
            }
        }
    } catch (PDOException $e) {
        // Log do erro
    }
    
    return false;
}

/**
 * Validar login do administrador
 * @param string $email Email do administrador
 * @param string $senha Senha do administrador
 * @return mixed ID do administrador se login válido, False caso contrário
 */
function validarLoginAdmin($email, $senha) {
    global $conn;
    
    // Simular login bem-sucedido para demonstração
    if ($email == 'admin@example.com' && $senha == 'admin123') {
        return 1;
    }
    
    if (!isset($conn)) {
        return false;
    }
    
    try {
        $stmt = $conn->prepare("SELECT id, senha FROM administradores WHERE email = ? AND status = 'ativo' LIMIT 1");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $admin = $stmt->fetch();
            
            if (password_verify($senha, $admin['senha'])) {
                return $admin['id'];
            }
        }
    } catch (PDOException $e) {
        // Log do erro
    }
    
    return false;
}

/**
 * Obter dados do usuário logado
 * @return array Dados do usuário
 */
function obterUsuarioLogado() {
    global $conn;
    
    if (!usuarioLogado()) {
        return null;
    }
    
    // Dados padrão para demonstração
    $usuario_padrao = [
        'id' => 1,
        'nome' => 'Usuário Demo',
        'email' => 'demo@example.com',
        'telefone' => '(11) 99999-9999',
        'cpf' => '123.456.789-00',
        'status' => 'ativo',
        'data_cadastro' => '2023-01-01'
    ];
    
    if (!isset($conn)) {
        return $usuario_padrao;
    }
    
    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ? LIMIT 1");
        $stmt->execute([$_SESSION['usuario_id']]);
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Log do erro
    }
    
    return $usuario_padrao;
}

/**
 * Obter dados do administrador logado
 * @return array Dados do administrador
 */
function obterAdminLogado() {
    global $conn;
    
    if (!adminLogado()) {
        return null;
    }
    
    // Dados padrão para demonstração
    $admin_padrao = [
        'id' => 1,
        'nome' => 'Administrador',
        'email' => 'admin@example.com',
        'cargo' => 'Administrador Geral',
        'status' => 'ativo',
        'data_cadastro' => '2023-01-01'
    ];
    
    if (!isset($conn)) {
        return $admin_padrao;
    }
    
    try {
        $stmt = $conn->prepare("SELECT * FROM administradores WHERE id = ? LIMIT 1");
        $stmt->execute([$_SESSION['admin_id']]);
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Log do erro
    }
    
    return $admin_padrao;
}

/**
 * Obter tickets do usuário
 * @param int $usuario_id ID do usuário
 * @return array Array de tickets
 */
function obterTicketsUsuario($usuario_id) {
    global $conn;
    
    // Tickets padrão para demonstração
    $tickets_padrao = [
        [
            'id' => 1,
            'titulo' => 'Vazamento no banheiro',
            'descricao' => 'Há um vazamento no banheiro social do meu apartamento.',
            'categoria' => 'manutencao',
            'status' => 'aberto',
            'data_criacao' => '2023-05-10 14:30:00',
            'total_respostas' => 0,
            'respostas_nao_lidas' => 0
        ],
        [
            'id' => 2,
            'titulo' => 'Barulho excessivo do vizinho',
            'descricao' => 'O vizinho do apartamento 302 faz barulho excessivo após às 22h.',
            'categoria' => 'reclamacao',
            'status' => 'em_andamento',
            'data_criacao' => '2023-05-15 10:45:00',
            'total_respostas' => 2,
            'respostas_nao_lidas' => 1
        ]
    ];
    
    if (!isset($conn)) {
        return $tickets_padrao;
    }
    
    try {
        $stmt = $conn->prepare("
            SELECT t.*, 
                   (SELECT COUNT(*) FROM ticket_respostas WHERE ticket_id = t.id) AS total_respostas,
                   (SELECT COUNT(*) FROM ticket_respostas WHERE ticket_id = t.id AND lido = 0 AND usuario_id != ?) AS respostas_nao_lidas
            FROM tickets t 
            WHERE t.usuario_id = ? 
            ORDER BY t.data_criacao DESC
        ");
        $stmt->execute([$usuario_id, $usuario_id]);
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Log do erro
    }
    
    return $tickets_padrao;
}

/**
 * Obter unidades do usuário
 * @param int $usuario_id ID do usuário
 * @return array Array de unidades
 */
function obterUnidadesUsuario($usuario_id) {
    global $conn;
    
    // Unidades padrão para demonstração
    $unidades_padrao = [
        [
            'id' => 1,
            'condominio_id' => 1,
            'condominio_nome' => 'Residencial Villa Nova',
            'identificacao' => 'Bloco A, Ap. 101',
            'tipo' => 'apartamento',
            'status' => 'ocupado',
            'proprietario_id' => 1
        ],
        [
            'id' => 2,
            'condominio_id' => 2,
            'condominio_nome' => 'Comercial Plaza Center',
            'identificacao' => 'Sala 45',
            'tipo' => 'sala comercial',
            'status' => 'ocupado',
            'proprietario_id' => 2
        ]
    ];
    
    if (!isset($conn)) {
        return $unidades_padrao;
    }
    
    try {
        $stmt = $conn->prepare("
            SELECT u.*, c.nome as condominio_nome 
            FROM unidades u 
            JOIN condominios c ON u.condominio_id = c.id
            WHERE u.proprietario_id = ? OR u.morador_id = ?
            ORDER BY c.nome, u.identificacao
        ");
        $stmt->execute([$usuario_id, $usuario_id]);
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Log do erro
    }
    
    return $unidades_padrao;
}

/**
 * Cadastrar novo usuário
 * @param array $dados Dados do usuário
 * @return mixed ID do usuário se cadastro bem-sucedido, string de erro caso contrário
 */
function cadastrarUsuario($dados) {
    global $conn;
    
    // Verificar email já existe
    if (isset($conn)) {
        try {
            $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$dados['email']]);
            
            if ($stmt->rowCount() > 0) {
                return "Este e-mail já está cadastrado.";
            }
            
            // Inserir usuário no banco
            $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("
                INSERT INTO usuarios (nome, email, telefone, cpf, senha, status, data_cadastro) 
                VALUES (?, ?, ?, ?, ?, 'pendente', NOW())
            ");
            
            $stmt->execute([
                $dados['nome'],
                $dados['email'],
                $dados['telefone'] ?? null,
                $dados['cpf'] ?? null,
                $senha_hash
            ]);
            
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            return "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    }
    
    // Simulação de cadastro bem-sucedido
    return 123;
}

/**
 * Formatar data
 * @param string $data Data no formato SQL
 * @return string Data formatada
 */
function formatarData($data) {
    if (empty($data)) {
        return '';
    }
    
    $timestamp = strtotime($data);
    return date('d/m/Y H:i', $timestamp);
}

/**
 * Gerar URL amigável
 * @param string $string String para converter em URL
 * @return string URL amigável
 */
function gerarSlug($string) {
    $string = preg_replace('/[^a-zA-Z0-9 -]/', '', $string);
    $string = str_replace(' ', '-', $string);
    $string = strtolower($string);
    return $string;
}

/**
 * Limitar texto
 * @param string $texto Texto para limitar
 * @param int $limite Limite de caracteres
 * @return string Texto limitado
 */
function limitarTexto($texto, $limite) {
    if (strlen($texto) <= $limite) {
        return $texto;
    }
    
    $texto = substr($texto, 0, $limite);
    $ultimo_espaco = strrpos($texto, ' ');
    
    if ($ultimo_espaco !== false) {
        $texto = substr($texto, 0, $ultimo_espaco);
    }
    
    return $texto . '...';
}
