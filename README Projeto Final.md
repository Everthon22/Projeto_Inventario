# Projeto: Sistema de Inventário para Jogo

## 🌟 Introdução

### Qual o objetivo da atividade?

Desenvolver um sistema de inventário funcional para um jogo, permitindo que os jogadores adicionem, visualizem e gerenciem itens. O objetivo é aprimorar a experiência do usuário ao organizar e armazenar os itens coletados durante a jogabilidade.

### O que é um inventário de um jogo?

Um inventário de jogo é uma funcionalidade que permite ao jogador armazenar, visualizar e utilizar itens como armas, poções, equipamentos e objetos diversos que são relevantes para a progressão no jogo.

### Quais sistemas utilizam essa funcionalidade?

* **The Legend of Zelda: Breath of the Wild**
* **Minecraft**
* **Skyrim**, **The Witcher** e outros RPGs

### Por que essa funcionalidade é importante?

O inventário é essencial para melhorar a interação do jogador com o jogo, facilitando a gestão de recursos, organização de equipamentos e tomadas de decisão.

---

## 🧱 Implementação

### 🔹 Front-End

#### Tecnologias Utilizadas:

* **HTML e CSS**: Estrutura e estilização das páginas
* **Bootstrap**: Estilo moderno e responsividade

#### Layout

O layout do inventário foi criado em **formato de grid**, utilizando **Flexbox** para uma exibição organizada e responsiva dos itens.

### 🔸 Back-End

#### Tecnologias Utilizadas:

* **PHP**: Manipulação de dados, sessões e integração com banco de dados
* **MySQL**: Armazenamento persistente dos dados dos itens (substituindo o uso do `inventario.txt`)

---

## ⚙️ Funcionalidades do Código

### `login.php`

* Autenticação de usuário com login e senha
* Controle de sessão via PHP

### `inventario.php`

* Verifica se o usuário está logado
* Exibe os itens do inventário em um layout em grid
* Possibilita excluir e editar itens

### `cadastro.php`

* Adiciona novos itens ao inventário
* Se o item já existir (mesmo nome com letras diferentes), atualiza a quantidade em vez de duplicar
* Os itens são adicionados com imagens via URL

### `editar_item.php`

* Permite editar o nome, imagem e quantidade de um item já existente

### `config.php`

* Contém as credenciais de conexão com o banco de dados MySQL
* Define parâmetros globais de sessão

---

## 🚀 Passo-a-Passo para Executar o Sistema

1. Iniciar um servidor local com **XAMPP** ou **WAMP**
2. Colocar os arquivos do projeto na pasta `htdocs`
3. Criar um banco de dados MySQL com nome `inventario` e tabela `item`
4. Iniciar o servidor Apache e o MySQL
5. Acessar `http://localhost/PROJETO-ZELDA-INVENTARIO/login.php`
6. Fazer login com as credenciais definidas
7. Usar as páginas para cadastrar, editar e visualizar os itens

---

## 📁 Estrutura de Diretórios do Projeto

```
PROJETO-ZELDA-INVENTARIO/
│
├── assets/
│   └── css/
│       └── style.css
│
├── assets1/
│   └── css1/
│       └── style1.css
│
├── img1/
│   ├── escudo.jpeg
│   ├── espada_mestre.jpg
│   └── porcao.png
│
├── cadastro.php
├── config.php
├── editar_item.php
├── inventario.php
├── login.php
└── remover_item.php
```

---

## 📌 Explicação das Pastas e Arquivos

* **assets/**: CSS geral
* **assets1/**: CSS específico do inventário
* **img1/**: Imagens padrão dos itens fixos
* **cadastro.php**: Formulário para adicionar itens (com validação e verificação de duplicidade)
* **config.php**: Conexão com banco de dados e sessão
* **inventario.php**: Interface principal do inventário (visualização, exclusão e edição)
* **editar\_item.php**: Edição de itens já cadastrados
* **remover\_item.php**: Exclusão de itens
* **login.php**: Tela de autenticação

---

## 📚 Referências

* Documentação oficial do [PHP](https://www.php.net/)
* [MySQL](https://dev.mysql.com/doc/)
* [Bootstrap](https://getbootstrap.com/)
* Jogos como The Legend of Zelda, Minecraft e Skyrim

---

Sistema de Inventário desenvolvido para fins educacionais e de aprendizado em desenvolvimento web com integração back-end.
