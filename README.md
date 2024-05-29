# Colorful: CRUD de Usuários e Cores
![Versão](https://img.shields.io/badge/Vers%C3%A3o-1.0-%2397C900?style=for-the-badge)
![Linguagem](https://img.shields.io/badge/Linguagem-PHP-%231F6FEB?style=for-the-badge)
![Front-end](https://img.shields.io/badge/Front%20End-Bootstrap-%231F6FEB?style=for-the-badge)
![Banco de Dados](https://img.shields.io/badge/Banco%20de%20Dados-SQLite-%231F6FEB?style=for-the-badge)

![Captura de tela](https://drive.google.com/uc?export=view&id=1q46ras1L78XqwaudU-7uv1tKejKXHPl4)
<img src="https://drive.google.com/uc?export=view&id=1dzjUvwmnNPPLDfbzlrxP_zXJtVFInWW0" width="25%"></img><img src="https://drive.google.com/uc?export=view&id=1cdUTiBKFRbF2N8rP4aHOSLQty0fUvY2Y" width="25%"></img><img src="https://drive.google.com/uc?export=view&id=1BRkvHANtz3LaNl6UdD_FdvIzCfZEWRNT" width="25%"></img><img src="https://drive.google.com/uc?export=view&id=1oD6GEL5znu1zxUH3hh3nvcDc6wc4cF9e" width="25%"></img>
> Sistema CRUD desenvolvido como um teste para a empresa VersoTech, sediada em Porto Alegre - RS, com o objetivo de gerenciar usuários e atribuir cores a eles.

## 💻 Especificações Técnicas

O sistema tem como objetivo criar, editar e excluir usuários, além de associar cores aos usuários. Para isso, foram desenvolvidas as classes `Usuario`, `UsuarioBanco`, `Cor` e `CorBanco`.

As classes `Usuario` e `Cor` são responsáveis pela criação individual dos objetos, e as operações de manipulação dos dados são realizadas através dos métodos definidos dentro dessas classes. Por outro lado, as classes `UsuarioBanco` e `CorBanco` fazem a ligação direta com o banco de dados, gerenciando o armazenamento e a recuperação dos dados, também por meio dos seus próprios métodos.

O sistema possui três páginas principais para o gerenciamento e cadastro de usuários. Essas páginas são complementadas por funções em JavaScript e PHP que garantem a funcionalidade esperada. Ainda, vale destacar os seguintes aspectos:

**Boas práticas:** O sistema foi desenvolvido seguindo os princípios da Programação Orientada a Objetos (POO), o que assegura uma melhor organização, legibilidade e manutenibilidade do software. Todas as funções e métodos estão devidamente comentados, o que facilita o desenvolvimento em equipe. Além disso, o código foi revisado para otimizar processos e minimizar a repetição.

**Design UX:** O sistema prioriza a experiência do usuário através de funcionalidades como: foco automático nos formulários de cadastro, gatilho de foco pela tecla Enter, marcação automática de checkboxes ao clicar em elementos da lista, indicação clara da localização do usuário durante a navegação, exibição de mensagens de erro ou confirmação de tarefas, uso de modais para confirmar ações sensíveis, e uma interface moderna, limpa e totalmente responsiva.

**Segurança:** Para garantir a máxima proteção, todas as operações são executadas em objetos separados, e as classes que interagem diretamente com o banco de dados realizam a limpeza dos parâmetros recebidos, removendo qualquer caractere especial potencialmente perigoso.
