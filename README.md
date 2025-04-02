# Projeto_Inventario

## Introdução

Qual o objetivo da atividade?

O objetivo desta atividade é desenvolver um sistema de inventário funcional para um jogo, permitindo que os jogadores adicionem, visualizem e gerenciem itens. Esse sistema visa
aprimorar a experiência do usuário ao organizar e armazenar itens coletados durante o jogo.



O que é um inventário de um jogo?

Um inventário de jogo é uma funcionalidade que permite ao jogador armazenar, visualizar e utilizar itens durante a jogabilidade. Ele pode conter armas, poções, equipamentos e outros objetos relevantes para a progressão no jogo.



Quais sistemas utilizam a funcionalidade?

Vários jogos utilizam sistemas de inventário, incluindo:

The Legend of Zelda: Breath of the Wild (gestão de armas, escudos e poções)

Minecraft (itens coletáveis e utilizáveis)

RPGs como Skyrim e The Witcher (organização de itens, equipamentos e materiais de crafting)



Por que essa funcionalidade é importante?

O inventário é essencial para melhorar a interação do jogador com o jogo, facilitando a gestão de recursos, organização de equipamentos e tomada de decisões estratégicas.




Implementação

Front-End

Quais ferramentas/frameworks foram utilizadas e por quê?

Para a implementação do front-end, foram utilizadas as seguintes tecnologias:

HTML e CSS: Estruturação e estilização das páginas.

Bootstrap: Framework CSS para responsividade e design moderno.




Como o layout foi feito? (linha x colunas)

O layout do inventário foi projetado em formato de grid responsivo, utilizando flexbox e grid CSS, para exibir os itens lado a lado em uma organização de colunas dinâmica.




Back-End

Quais ferramentas/linguagens/frameworks foram utilizados?

PHP: Para a manipulação dos dados do inventário e controle de sessão do usuário.

JSON (arquivo inventario.txt): Para armazenar e recuperar os itens do inventário.




Código PHP

O que o código faz? (Explicar as principais funcionalidades)

login.php

Realiza a autenticação do usuário através de um login e senha predefinidos.

Utiliza sessão PHP para controlar o acesso ao inventário.

![Login](https://github.com/user-attachments/assets/6fa01326-0598-42c0-9083-bcccdf1dd61e)






inventario.php

Exibe os itens armazenados no inventário.

Verifica se o usuário está logado antes de permitir o acesso.

Carrega os itens do arquivo JSON inventario.txt e os exibe em um grid responsivo.

![Inventario print](https://github.com/user-attachments/assets/1e32bbd3-aa34-4597-b39c-760048541634)






cadastro.php

Permite adicionar novos itens ao inventário.

Se o item já existir, incrementa a quantidade.

Salva os itens no arquivo inventario.txt.

![Cadastro](https://github.com/user-attachments/assets/b3c6fd18-90d1-4bc4-80ab-a8f8f3ce772c)





config.php

Define credenciais de login e o caminho do arquivo JSON.

Contém a função verificarLogin() para autenticação de usuários.

![Config](https://github.com/user-attachments/assets/4764699b-b859-4648-94fb-2266556c2383)





Passo-a-Passo para Executar o Sistema

Abrir um servidor local (como XAMPP ou WAMP).

Colocar os arquivos do projeto na pasta htdocs.

Iniciar o servidor Apache e o PHP.

Acessar http://localhost/projeto-zelda-inventario/login.php pelo navegador.

Fazer login com as credenciais predefinidas.

Navegar até a página do inventário e gerenciar os itens.



Hierarquia de Diretórios do Projeto

PROJETO-ZELDA-INVENTARIO/

│── assets/

│   ├── css/

│   │   ├── style.css

│

│── assets1/

│   ├── css1/

│   │   ├── style1.css

│

│── img1/

│   ├── escudo.jpeg

│   ├── espada_mestre.jpg

│   ├── porcao.png

│

│── cadastro.php

│── config.php

│── inventario.php

│── inventario.txt

│── login.php


Explicação

assets/css/: Contém arquivos de estilização geral.

assets1/css1/: Contém estilos específicos do inventário.

img1/: Armazena as imagens dos itens.

inventario.txt: Base de dados do inventário (JSON).

cadastro.php: Formulário para adicionar itens ao inventário.

config.php: Configurações do sistema (login e inventário).

inventario.php: Exibição do inventário.

login.php: Tela de login do sistema.

![Login inven](https://github.com/user-attachments/assets/4cee1c31-7d95-4dac-bd46-feb433b2ef1d)

![Inventario prin](https://github.com/user-attachments/assets/5b7ff0ca-31fe-44be-be18-5641274feb1e)
