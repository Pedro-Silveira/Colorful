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