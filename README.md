## 📌 Request App — Sistema de Gerenciamento de Solicitações

O Request App é uma aplicação web em desenvolvimento voltada para o gerenciamento de solicitações, permitindo que usuários registrem, acompanhem e organizem pedidos de forma simples, estruturada e segura.

O projeto está sendo desenvolvido com foco em boas práticas de engenharia de software, priorizando clareza de código, separação de responsabilidades e escalabilidade.

## 🎯 Objetivo do Projeto

Criar um sistema que centralize solicitações, oferecendo:

- Cadastro e acompanhamento de requests

- Organização do fluxo do lado do usuário e do lado administrativo

- Base sólida para evoluir regras de negócio, status, permissões e relatórios
Perfeito 👍
Segue um trecho **pronto para adicionar ao README**, com uma seção clara de **Como inicializar o projeto**, usando Sail (Docker), no padrão profissional.

---

## 🚀 Como inicializar o projeto

### Pré-requisitos

* Docker e Docker Compose instalados
* Git
* PHP 8.2+ (opcional, apenas se não usar Sail para tudo)

---

### 1️⃣ Clonar o repositório

```bash
git clone https://github.com/seu-usuario/request-app.git
cd request-app
```

---

### 2️⃣ Copiar o arquivo de ambiente

```bash
cp .env.example .env
```

> Ajuste as variáveis se necessário. O projeto utiliza PostgreSQL via Docker.

---

### 3️⃣ Instalar dependências

```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php85-composer:latest \
  composer install
```

---

### 4️⃣ Subir o ambiente com Sail

```bash
./vendor/bin/sail up -d
```

---

### 5️⃣ Gerar a key da aplicação

```bash
./vendor/bin/sail artisan key:generate
```

---

### 6️⃣ Rodar as migrations

```bash
./vendor/bin/sail artisan migrate
```

---

### 7️⃣ Acessar a aplicação

* Aplicação: [http://localhost](http://localhost)
* PostgreSQL (externo): `localhost:5433`

---

### 🛑 Parar o ambiente

```bash
./vendor/bin/sail down
```



## 🛠️ Tecnologias Utilizadas

- Laravel (backend e arquitetura)

- Livewire 3 (interfaces dinâmicas sem complexidade de SPA)

- PostgreSQL (persistência de dados)

- Laravel Sail + Docker (ambiente de desenvolvimento isolado)

- Migrations e Eloquent ORM (modelagem e versionamento do banco)

## 🧩 Principais Funcionalidades (em evolução)

- Cadastro de solicitações (requests)

- Validação de dados no backend

- Persistência e consulta no banco de dados

- Estrutura preparada para autenticação e controle de acesso

- Separação clara entre fluxos de usuário e administração

## 🚀 Diferenciais Técnicos

- Ambiente totalmente containerizado com Docker

- Banco de dados isolado por projeto

- Código organizado com foco em manutenibilidade

- Evolução incremental baseada em regras de negócio reais

## 📈 Status do Projeto

🔧 Em desenvolvimento ativo
O projeto está sendo construído de forma incremental, com entregas contínuas e refinamento técnico a cada etapa.