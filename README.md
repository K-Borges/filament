# Sistema de Gestão de Produtos e Pedidos

Sistema administrativo desenvolvido com Laravel 13 e Filament 4 para gerenciamento de produtos, categorias, pedidos e métricas de negócio.

## Tecnologias Utilizadas

### Backend

* PHP 8.4+
* Laravel 13
* SQLite (desenvolvimento)
* Eloquent ORM

### Painel Administrativo

* Filament 4
* Livewire 3
* Alpine.js
* Tailwind CSS 4

### Ferramentas de Desenvolvimento

* Composer
* Artisan CLI
* Faker
* Seeders e Factories

---

# Objetivo do Projeto

Este projeto foi criado com fins de estudo e prática dos recursos modernos do ecossistema Laravel, explorando principalmente:

* CRUDs avançados com Filament
* Relacionamentos Eloquent
* Widgets e Dashboards
* Infolists
* Uploads de arquivos
* Tabelas e filtros
* Seeders e Factories
* Arquitetura TALL Stack

---

# Funcionalidades

## Dashboard

Painel inicial com indicadores de negócio:

* Total de clientes cadastrados
* Quantidade de itens em estoque
* Total de pedidos
* Faturamento acumulado

Widgets desenvolvidos com:

* StatsOverviewWidget
* ChartWidget

---

## Gestão de Categorias

Permite:

* Criar categorias
* Editar categorias
* Visualizar categorias
* Excluir categorias

---

## Gestão de Produtos

Permite:

* Cadastro de produtos
* Controle de estoque
* Associação com categorias
* Upload de imagens
* Pesquisa e ordenação
* Visualização detalhada

Campos principais:

* Nome
* Descrição
* Preço
* Estoque
* Categoria
* Imagem

---

## Gestão de Pedidos

Permite:

* Criar pedidos
* Associar clientes
* Gerenciar status
* Visualizar pedidos
* Calcular faturamento

Campos principais:

* Cliente
* Valor total
* Status

---

## Itens do Pedido

Relacionamento responsável por armazenar:

* Produto
* Quantidade
* Valor unitário
* Subtotal

Relacionamentos:

* Pedido possui vários itens
* Item pertence a um pedido
* Item pertence a um produto

---

# Estrutura do Banco de Dados

## users

Responsável pelos usuários do sistema.

### Campos

* id
* name
* email
* password

---

## categories

Categorias dos produtos.

### Campos

* id
* name

---

## products

Produtos cadastrados.

### Campos

* id
* category_id
* name
* description
* price
* stock
* image

---

## orders

Pedidos realizados.

### Campos

* id
* user_id
* total_price
* status

---

## order_items

Itens vinculados aos pedidos.

### Campos

* id
* order_id
* product_id
* quantity
* unit_price
* subtotal

---

# Relacionamentos

User

* hasMany Orders

Order

* belongsTo User
* hasMany OrderItems

OrderItem

* belongsTo Order
* belongsTo Product

Product

* belongsTo Category
* hasMany OrderItems

Category

* hasMany Products

---

# Instalação

Clone o projeto:

```bash
git clone <repositorio>
```

Acesse a pasta:

```bash
cd projeto
```

Instale as dependências:

```bash
composer install
```

Copie o arquivo de ambiente:

```bash
cp .env.example .env
```

Gere a chave:

```bash
php artisan key:generate
```

Execute as migrations:

```bash
php artisan migrate
```

Popule o banco:

```bash
php artisan db:seed
```

Inicie o servidor:

```bash
php artisan serve
```

---

# Conceitos Estudados

Durante o desenvolvimento deste projeto foram praticados:

* Resources
* Forms
* Tables
* Infolists
* Widgets
* Dashboards
* Eloquent Relationships
* Factories
* Seeders
* Migrations
* Notifications
* File Upload
* Filtros
* Paginação
* Pesquisa
* TALL Stack

---

# Próximas Melhorias

* Relation Managers
* Dashboard avançado
* Gráficos de vendas
* Controle de permissões
* Policies
* Soft Deletes
* API REST
* Integrações externas
* Testes automatizados

