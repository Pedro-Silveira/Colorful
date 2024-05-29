/*
* Verifica se os elementos da página já foram carregados.
* Atribui o foco para o elemento cujo ID seja nome.
* Cria a função focarCampo, que recebe como parâmetro o event e o ID do próximo input.
*
* Verifica se o elemento recebido possui um próximo elemento no formulário.
* Em caso positivo, foca esse elemento.
* Em caso negativo, executa um click no botão de cadastrar do formulário.
*
* Por fim, cria gatilhos para ativar a função através da tecla Enter, para cada um dos elementos do formulário.
*/
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("nome").focus();

    function focarCampo(evento, idProximoCampo) {
        if (evento.key === "Enter") {
            var proximoCampo = document.getElementById(idProximoCampo);

            evento.preventDefault();

            if (proximoCampo) {
                proximoCampo.focus();
            } else {
                document.getElementById("botaoCadastrar").click();
            }
        }
    }

    document.getElementById("nome").addEventListener("keypress", function(evento) {
        focarCampo(evento, 'email');
    });

    document.getElementById("email").addEventListener("keypress", function(evento) {
        focarCampo(evento, null);
    });
});