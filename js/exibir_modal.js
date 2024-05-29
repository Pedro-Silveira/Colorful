/*
* Recebe como parâmetro o ID e o nome do usuário.
* Utiliza o nome para mudar o título do Modal.
* Atribui o ID do usuário como value no input escondido do modal.
* Exibe o modal cujo ID seja modalExcluir.
*/
function confirmarExclusao(id, nome) {
    document.getElementById("tituloModalExcluir").innerHTML = "Excluir <strong>" + nome + "</strong>?";
    document.getElementById("idExcluir").value = id;

    var modalExcluir = new bootstrap.Modal(document.getElementById("modalExcluir"));
    modalExcluir.show();
}

/*
* Recebe como parâmetro o ID, o nome e o e-mail do usuário.
* Utiliza o nome para mudar o título do Modal.
* Atribui o ID, o nome e o e-mail do usuário como parâmetro nos inputs do modal.
* Exibe o modal cujo ID seja modalEditar.
*/
function confirmarEdicao(id, nome, email) {
    document.getElementById("tituloModalEditar").innerHTML = "Editar <strong>" + nome + "</strong>?";
    document.getElementById("idEditar").value = id;
    document.getElementById("nome").value = nome;
    document.getElementById("email").value = email;

    var modalEditar = new bootstrap.Modal(document.getElementById("modalEditar"));
    modalEditar.show();
}