<!-- Digite sua solução para o desafio (AQUI) -->

<?php

// Configurações do banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "Senai@118";
$banco = "exercicio";

// Conexão com o banco
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se a conexão foi realizada corretamente
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Cria uma variável para armazenar a mensagem
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pega os dados preenchidos no formulário
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];

    // Verifica se o nome está vazio
    if (empty($nome)) {
        $mensagem = "Erro: O nome do produto não pode estar vazio.";
    }

    // Verifica se o preço é um número maior que zero
    elseif (!is_numeric($preco) || $preco <= 0) {
        $mensagem = "Erro: O preço deve ser um número positivo.";
    }

    // Se os dados forem válidos
    else {

        // Insere o produto no banco de dados
        $sql = "INSERT INTO produtos (nome, preco) VALUES ('$nome', '$preco')";

        // Executa o comando
        if ($conexao->query($sql)) {
            $mensagem = "Produto cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar o produto.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
</head>

<body>

    <!-- Título da página -->
    <h1>Cadastro de Produtos</h1>

    <!-- Formulário de cadastro -->
    <form method="POST">

        <!-- Campo para o nome -->
        <label>Nome do Produto:</label>
        <input type="text" name="nome">

        <br><br>

        <!-- Campo para o preço -->
        <label>Preço:</label>
        <input type="number" name="preco" step="0.01">

        <br><br>

        <!-- Botão para cadastrar -->
        <input type="submit" value="Cadastrar">

    </form>

    <br>

    <!-- Exibe a mensagem abaixo do botão -->
    <?php
    if (!empty($mensagem)) {
        echo $mensagem;
    }
    ?>

</body>

</html>