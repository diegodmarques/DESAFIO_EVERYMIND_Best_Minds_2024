
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    

<?php

include 'db/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastro"])) {
    // Processar a criação de um novo produto
    $nome = $_POST["nome_do_produto"];
    $codigo = $_POST["codigo_do_produto"];
    $descricao = $_POST["descricao_do_produto"];
    $preco = $_POST["preco_do_produto"];

    

    // Usando uma declaração preparada para evitar injeção de SQL
    $query = "INSERT INTO Produtos (nome_do_produto, codigo_do_produto, descricao_do_produto, preco_do_produto) 
              VALUES (:nome, :codigo, :descricao, :preco)";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindParam(':codigo', $codigo, SQLITE3_TEXT);
    $stmt->bindParam(':descricao', $descricao, SQLITE3_TEXT);
    $stmt->bindParam(':preco', $preco, SQLITE3_FLOAT);

    // Executa a declaração preparada
    $result = $stmt->execute();

    if ($result) {
        // Redirecionar de volta para a lista de produtos após a criação bem-sucedida
        header("Location: index.php");
        exit;
    } else {
        // Mensagem de erro em caso de falha
        echo "Erro ao criar o produto: " . $db->lastErrorMsg();
    }
}
// ?>

<!-- Formulário para criar um novo produto -->
<h2>Criar Novo Produto</h2>
<form method="post" action="">
    Nome do Produto: <input type="text" name="nome_do_produto" required><br>
    Código do Produto: <input type="text" name="codigo_do_produto" required><br>
    Descrição do Produto: <input type="text" name="descricao_do_produto" required><br>
    Preço do Produto: <input type="number" name="preco_do_produto" step="0.01" required><br>
    <input type="submit" name="cadastro" value="Criar Produto">
</form>

<!-- Link de volta para a lista de produtos -->
<a href="../index.php">Voltar para a Lista de Produtos</a>
</body>
</html>

