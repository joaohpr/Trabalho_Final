# 🎬 CineSearch

## 📖 Sobre o Projeto

O CineSearch é uma aplicação web desenvolvida com o objetivo de facilitar a busca, organização e recomendação de filmes. O sistema centraliza funcionalidades que auxiliam os usuários a encontrar conteúdos de acordo com seus interesses, registrar avaliações pessoais e acompanhar seu histórico de pesquisas.

A proposta surgiu da dificuldade enfrentada por muitos usuários ao procurar filmes em meio à grande quantidade de conteúdos disponíveis atualmente. O CineSearch busca oferecer uma experiência mais organizada e personalizada por meio de filtros, recomendações e armazenamento de interações.

---

## 🎯 Objetivos

* Facilitar a pesquisa de filmes.
* Centralizar informações sobre obras cinematográficas.
* Permitir o registro de avaliações pessoais.
* Armazenar o histórico de pesquisas dos usuários.
* Oferecer recomendações baseadas nas interações realizadas.

---

## 🚀 Funcionalidades

### Usuários

* Cadastro de usuários.
* Autenticação por login.

### Filmes

* Pesquisa de filmes por título.
* Aplicação de filtros de pesquisa.
* Visualização de informações detalhadas dos filmes.
* Exibição de filmes semelhantes.

### Personalização

* Registro de avaliações e notas.
* Armazenamento do histórico de pesquisas.
* Recomendações personalizadas com base nas interações do usuário.

---

## 🏗️ Arquitetura de Busca

Para otimizar o desempenho da aplicação:

1. O sistema consulta primeiro o banco de dados local.
2. Caso o filme não esteja cadastrado, uma consulta é realizada na API TMDb.
3. Os dados retornados podem ser armazenados localmente para futuras consultas.

Fluxo simplificado:

Usuário → Banco de Dados Local → API TMDb (quando necessário) → Exibição dos Dados

---

## 🛠️ Tecnologias Utilizadas

### Front-end

* HTML5
* CSS3
* JavaScript
* jQuery
* Bootstrap

### Back-end

* PHP
* Laravel

### Banco de Dados

* MySQL
* PostgreSQL

### Modelagem e Documentação

* Draw.io
* MySQL Workbench

### Integrações

* API TMDb (The Movie Database)

---

## 📋 Requisitos Funcionais

* RF01 – Permitir cadastro de usuários.
* RF02 – Permitir autenticação por login.
* RF03 – Pesquisar filmes por título.
* RF04 – Filtrar resultados de pesquisa.
* RF05 – Exibir informações detalhadas de filmes.
* RF06 – Exibir filmes semelhantes.
* RF07 – Registrar avaliações e notas.
* RF08 – Armazenar histórico de pesquisas.
* RF09 – Gerar recomendações personalizadas.
* RF10 – Consultar o banco de dados local antes de utilizar sistemas externos.

---

## ❌ Limitações

O sistema não contempla:

* Streaming de filmes.
* Compra de ingressos.
* Chat entre usuários.
* Processamento de pagamentos.

---

## 🎯 Resultado Esperado

Desenvolver uma aplicação web funcional que permita ao usuário pesquisar filmes, registrar avaliações, armazenar histórico e receber recomendações personalizadas de maneira organizada e intuitiva.

---

## 👨‍💻 Equipe de Desenvolvimento

* João Lucas Silva Simões
* Otávio Davi de Faria

---

## 📈 Status do Projeto

🚧 Em desenvolvimento.
