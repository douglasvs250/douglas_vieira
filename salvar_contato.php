<?php
    // verificando se o botão de enviar mensagem do formulario foi clicada, caso contrario redireciona o usuario para a pagina index na sessão de contato
    if(isset($_POST['salvar'])){
        include_once("config/connect.php"); // chamando a conexão com o gerenciador de banco de dados
        date_default_timezone_set('America/Sao_Paulo'); // definindo fuso horario
        

        // função para sanitizar e validar os inputs do formulario
        function limpar($input){
            global $connect;
            $input = mysqli_escape_string($connect, $input);
            $input = htmlspecialchars($input);
            return $input;
        }

        // definindo variaveis com o inputs sanetizados e validados
        $nome = limpar($_POST['nome']);
        $telefone = limpar($_POST['telefone']);
        $email = limpar($_POST['email']);
        $mensagem = limpar($_POST['mensagem']);
        $data = date("Y/m/d H:i:s"); // configurando formato de data e hora

        // verificando se os campos de formulario estão preenchidos, caso contrario redireciona o usuario para a pagina index na sessão de contato
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($mensagem)){
            $sql = "INSERT INTO contato (nome, telefone, email, mensagem, data) VALUES ('$nome', '$telefone', '$email', '$mensagem', '$data')"; // prepara os comandos SQL
            $adicionar = mysqli_query($connect, $sql); // prepara a variavel para salvar os dados

            // faz a adição dos dados na tabela, se ocorrer tudo certo, redireciona o usuario para a pagina index na sessão de inicio, caso contrario redireciona o usuario para a pagina index na sessão de contato
            if($adicionar){
                header("Location: index.html#douglas");
            }
        }else{
            header("Location: index.html#form");
        }
    }else{
        header("Location: index.html#form");
    }