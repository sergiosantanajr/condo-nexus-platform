
-- Criação das tabelas do banco de dados

-- Configurações do sistema
CREATE TABLE IF NOT EXISTS configuracoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_site VARCHAR(100) NOT NULL,
    email_contato VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    endereco TEXT,
    sobre_texto TEXT,
    logo_url VARCHAR(255),
    facebook_url VARCHAR(255),
    instagram_url VARCHAR(255),
    whatsapp VARCHAR(20),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Administradores
CREATE TABLE IF NOT EXISTS administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    ultimo_acesso DATETIME,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuários/Condôminos
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    cpf VARCHAR(14) UNIQUE,
    status ENUM('ativo', 'inativo', 'pendente') DEFAULT 'pendente',
    ultimo_acesso DATETIME,
    token_reset VARCHAR(100),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Condomínios
CREATE TABLE IF NOT EXISTS condominios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco TEXT NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    cep VARCHAR(10),
    total_unidades INT,
    sindico_nome VARCHAR(100),
    sindico_contato VARCHAR(100),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Unidades/Imóveis
CREATE TABLE IF NOT EXISTS unidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    condominio_id INT NOT NULL,
    identificacao VARCHAR(20) NOT NULL,
    tipo ENUM('apartamento', 'casa', 'sala comercial') NOT NULL,
    area DECIMAL(10,2),
    quartos INT,
    proprietario_id INT,
    inquilino_id INT,
    status ENUM('ocupado', 'vago') DEFAULT 'vago',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (condominio_id) REFERENCES condominios(id) ON DELETE CASCADE,
    FOREIGN KEY (proprietario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (inquilino_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Tickets/Chamados
CREATE TABLE IF NOT EXISTS tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    categoria ENUM('reclamacao', 'solicitacao', 'manutencao', 'sugestao', 'outro') NOT NULL,
    prioridade ENUM('baixa', 'media', 'alta', 'urgente') DEFAULT 'media',
    status ENUM('aberto', 'em_andamento', 'respondido', 'fechado') DEFAULT 'aberto',
    unidade_id INT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (unidade_id) REFERENCES unidades(id) ON DELETE SET NULL
);

-- Respostas de Tickets
CREATE TABLE IF NOT EXISTS ticket_respostas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    usuario_id INT,
    admin_id INT,
    mensagem TEXT NOT NULL,
    anexo_url VARCHAR(255),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (admin_id) REFERENCES administradores(id) ON DELETE SET NULL
);

-- Blog/Notícias
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    conteudo TEXT NOT NULL,
    resumo TEXT,
    imagem_capa VARCHAR(255),
    autor_id INT NOT NULL,
    status ENUM('publicado', 'rascunho') DEFAULT 'rascunho',
    visualizacoes INT DEFAULT 0,
    slug VARCHAR(200) UNIQUE,
    data_publicacao DATETIME,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (autor_id) REFERENCES administradores(id) ON DELETE CASCADE
);

-- Categorias do Blog
CREATE TABLE IF NOT EXISTS blog_categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE,
    descricao TEXT
);

-- Relação Posts-Categorias
CREATE TABLE IF NOT EXISTS blog_posts_categorias (
    post_id INT NOT NULL,
    categoria_id INT NOT NULL,
    PRIMARY KEY (post_id, categoria_id),
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES blog_categorias(id) ON DELETE CASCADE
);

-- Serviços Oferecidos
CREATE TABLE IF NOT EXISTS servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    icone VARCHAR(100),
    imagem VARCHAR(255),
    ordem INT DEFAULT 0,
    ativo BOOLEAN DEFAULT TRUE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contatos/Mensagens
CREATE TABLE IF NOT EXISTS contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    mensagem TEXT NOT NULL,
    assunto VARCHAR(200),
    status ENUM('novo', 'lido', 'respondido', 'spam') DEFAULT 'novo',
    ip VARCHAR(45),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Depoimentos
CREATE TABLE IF NOT EXISTS depoimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cargo VARCHAR(100),
    empresa VARCHAR(100),
    texto TEXT NOT NULL,
    avatar VARCHAR(255),
    avaliacao INT DEFAULT 5,
    ativo BOOLEAN DEFAULT FALSE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dados iniciais para o sistema
INSERT INTO blog_categorias (nome, slug, descricao) VALUES 
('Gestão Condominial', 'gestao-condominial', 'Artigos sobre gestão de condomínios'),
('Manutenção', 'manutencao', 'Dicas e informações sobre manutenção em condomínios'),
('Legislação', 'legislacao', 'Leis e regulamentos para condomínios');

INSERT INTO servicos (nome, descricao, icone, ordem) VALUES 
('Administração de Condomínios', 'Gestão completa do seu condomínio com transparência e eficiência.', 'building', 1),
('Consultoria Condominial', 'Análise e orientação especializada para melhorar a gestão do seu condomínio.', 'clipboard-list', 2),
('Assessoria Jurídica', 'Suporte jurídico especializado em questões condominiais.', 'balance-scale', 3),
('Manutenção Predial', 'Serviços de manutenção preventiva e corretiva para o seu condomínio.', 'tools', 4);

INSERT INTO depoimentos (nome, cargo, empresa, texto, avaliacao, ativo) VALUES 
('Carlos Silva', 'Síndico', 'Condomínio Jardim das Flores', 'Desde que contratamos a Nova Alternativa, a gestão do nosso condomínio melhorou significativamente. Recomendo!', 5, TRUE),
('Ana Paula', 'Síndica', 'Edifício Aurora', 'Serviço de qualidade e atendimento sempre rápido. Estamos muito satisfeitos!', 5, TRUE),
('Roberto Mendes', 'Conselheiro', 'Residencial Monte Verde', 'A transparência na prestação de contas foi o que mais me impressionou. Excelente trabalho!', 4, TRUE);
