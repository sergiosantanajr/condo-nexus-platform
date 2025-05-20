
# Nova Alternativa - Sistema de Gestão de Condomínios

Este projeto é uma aplicação web desenvolvida com React para gestão de condomínios.

## ⚠️ IMPORTANTE: Este é um projeto React moderno

Este projeto utiliza tecnologias web modernas (React, Vite, etc.) e **NÃO É** uma aplicação PHP tradicional. Para executá-lo corretamente, você precisa seguir as instruções abaixo.

## 📋 Requisitos

- Node.js versão 16.0 ou superior
- NPM ou Yarn

## 🚀 Instalação

1. Primeiro, instale as dependências:

```bash
npm install
# ou
yarn install
```

2. Execute o projeto em modo de desenvolvimento:

```bash
npm run dev
# ou
yarn dev
```

3. Para compilar para produção:

```bash
npm run build
# ou
yarn build
```

4. Para servir a versão de produção:

```bash
npm run preview
# ou
yarn preview
```

## 📂 Estrutura do Projeto

- `/src` - Código fonte da aplicação
  - `/components` - Componentes React reutilizáveis
  - `/pages` - Páginas da aplicação
  - `/hooks` - Custom hooks
  - `/lib` - Funções utilitárias

## 🌐 Deploy em Servidor Web Tradicional (Apache/Nginx)

Se você deseja hospedar este site em um servidor Apache ou Nginx tradicional:

1. Execute `npm run build` para gerar os arquivos estáticos
2. Copie todo o conteúdo da pasta `dist` para a raiz do seu servidor web
3. Configure seu servidor para servir `index.html` para todas as rotas (necessário para SPA - Single Page Application)

### Configuração para Nginx:

```nginx
server {
    listen 80;
    server_name seu-dominio.com;
    root /caminho/para/pasta/dist;
    index index.html;
    
    location / {
        try_files $uri $uri/ /index.html;
    }
}
```

### Configuração para Apache:

Crie um arquivo `.htaccess` na raiz do seu site:

```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /
  RewriteRule ^index\.html$ - [L]
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . /index.html [L]
</IfModule>
```

Certifique-se de que o módulo `mod_rewrite` esteja habilitado no seu servidor Apache.

## 📱 Funcionalidades

- Site institucional com informações sobre serviços
- Blog com artigos sobre gestão condominial
- Portal para condôminos com acesso a serviços
- Painel administrativo para gestão de conteúdo
- Sistema de tickets para solicitações e reclamações

## 📄 Licença

Este projeto é proprietário e seu uso não é permitido sem autorização expressa.
