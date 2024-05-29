/*
* Verifica se os elementos da página já foram carregados.
* Seleciona todos os itens na lista da página que pertençam a classe "list-group-item".
* Cria um gatilho para cliques nesses elementos.
*
* Verifica se o clique não foi no próprio checkbox, para evitar mal funcionamento.
* Em caso negativo, marca o checkbox do elemento clicado na lista.
*/
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.list-group-item').forEach(item => {
        item.addEventListener('click', (alvo) => {
            if (alvo.target.tagName !== 'INPUT') {
                const checkbox = item.querySelector('input[type="checkbox"]');

                checkbox.checked = !checkbox.checked;
            }
        });
    });
});