/*
    Função para exibir o modal de confirmação de exclusão:

    * Recebe como parâmetro o ID e o nome do Usuário.
    * Não retorna dados.

    -> Atribui o parâmetro href do botão cujo ID é "botaoExcluir" com o direcionamento para a função de excluir usuário,
       discriminando através do método _GET qual o ID do usuário a ser excluído.
    -> Insere no título do modal cujo ID é "tituloModal" o nome do usuário que será excluído.
    -> Cria uma variável chamada "modal" que recebe como referência o modal na página web com id igual a "modalExcluir".
    -> Exibe o modal na página.
 */
function confirmarExclusao(id, nome) {
    document.getElementById("botaoExcluir").href = "excluir_usuario.php?id=" + id;
    document.getElementById("tituloModalExcluir").innerHTML = "Excluir <strong>" + nome + "</strong>?";

    var modalExcluir = new bootstrap.Modal(document.getElementById("modalExcluir"));
    modalExcluir.show();
}

function confirmarEdicao(id, nome, email) {
    document.getElementById("tituloModalEditar").innerHTML = "Editar <strong>" + nome + "</strong>?";
    document.getElementById("id").value = id;
    document.getElementById("nome").value = nome;
    document.getElementById("email").value = email;

    var modalEditar = new bootstrap.Modal(document.getElementById("modalEditar"));
    modalEditar.show();
}