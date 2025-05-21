
# Nova Alternativa - Sistema de Gestão de Condomínios (PHP)

Este projeto é uma aplicação web desenvolvida com PHP puro para gestão de condomínios, compatível com servidores Nginx/PHP tradicionais.

## 📋 Instalação Simples

1. Faça o upload de todos os arquivos para o diretório raiz do seu servidor web (public_html, www, htdocs, etc.)
2. Acesse o site pelo navegador. Você será automaticamente redirecionado para a página de instalação
3. Siga as instruções na tela para configurar o banco de dados e criar o usuário administrador

## 📂 Estrutura do Projeto

- `/` - Diretório raiz com arquivos principais
- `/assets` - Arquivos CSS, JavaScript e imagens
- `/config` - Arquivos de configuração do sistema
- `/includes` - Funções e componentes reutilizáveis 
- `/pages` - Páginas do site

## 🔧 Requisitos do Servidor

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor Web (Apache, Nginx, etc.)
- Extensão PDO habilitada

## 📱 Funcionalidades

- Site institucional com informações sobre serviços
- Blog com artigos sobre gestão condominial
- Portal para condôminos com acesso a serviços
- Painel administrativo para gestão de conteúdo
- Sistema de tickets para solicitações e reclamações

## 💼 Uso do Sistema

**Painel Administrativo:**
- Acesse `/admin` para gerenciar o sistema 
- Use as credenciais criadas durante a instalação

**Portal do Cliente:**
- Acesse `/portal` para o acesso de condôminos
- Novos usuários podem se cadastrar e terão status "pendente" até aprovação

## 📄 Licença

Este projeto é proprietário e seu uso não é permitido sem autorização expressa.

## 🔐 Segurança

O sistema inclui:
- Proteção contra SQL Injection
- Senhas armazenadas com hash seguro
- Validação de formulários
- Sanitização de entradas

## 📧 Suporte

Para suporte, entre em contato através do formulário no site ou diretamente pelo e-mail configurado na instalação.
