<?php
    /*
    * Recebe como parâmetro o código de erro da página.
    * Cria um array para armazenar os parâmetros "texto" e "tipo" da mensagem de erro.
    * Atribui os parâmetros mencionados conforme o código do erro.
    * Retorna o array contendo a mensagem de erro, para ser usado no Alert.
    */
    function mensagemErro($codigo) {
        $mensagem = [];

        switch ($codigo) {
            case 1:
                $mensagem["texto"] = "O nome inserido é inválido!";
                $mensagem["tipo"] = "erro";
                break;
            case 2:
                $mensagem["texto"] = "O e-mail inserido é inválido!";
                $mensagem["tipo"] = "erro";
                break;
            case 3:
                $mensagem["texto"] = "Houve um erro. Por favor, tente novamente!";
                $mensagem["tipo"] = "erro";
                break;
            case 4:
                $mensagem["texto"] = "Usuário editado com sucesso!";
                $mensagem["tipo"] = "sucesso";
                break;
            case 5:
                $mensagem["texto"] = "Usuário excluído com sucesso!";
                $mensagem["tipo"] = "sucesso";
                break;
            case 6:
                $mensagem["texto"] = "Usuário criado com sucesso!";
                $mensagem["tipo"] = "sucesso";
                break;
            case 7:
                $mensagem["texto"] = "Associações alteradas com sucesso!";
                $mensagem["tipo"] = "sucesso";
                break;
            case 8:
                $mensagem["texto"] = "Você não selecionou uma cor e um usuário!";
                $mensagem["tipo"] = "erro";
                break;
            default:
                $mensagem["texto"] = "Houve um erro desconhecido!";
                $mensagem["tipo"] = "erro";
                break;
        }

        return $mensagem;
    }
?>
