<?php
include ("db/conn.php");
// Verifique a conexão
if (!$db) {
    die("Connection failed: " . $db->lastErrorMsg());
}

// Processar a edição de um produto existente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_produto"])) {
    $produto_id = $_POST["produto_id"];
    $nome = $_POST["nome_do_produto"];
    $codigo = $_POST["codigo_do_produto"];
    $descricao = $_POST["descricao_do_produto"];
    $preco = $_POST["preco_do_produto"];

    $query = "UPDATE Produtos SET 
              nome_do_produto = '$nome', 
              codigo_do_produto = '$codigo', 
              descricao_do_produto = '$descricao', 
              preco_do_produto = '$preco' 
              WHERE id = $produto_id";
    $result = $db->exec($query);

    if (!$result) {
        die("Erro ao editar o produto: " . $db->lastErrorMsg());
    }

    // Redirecionar de volta para a lista de produtos após a edição bem-sucedida
    header("Location: index.php");
}

// Obtém o ID do produto da URL
$produto_id = isset($_GET["id"]) ? $_GET["id"] : null;

// Consulta SQL para selecionar o produto específico pelo ID
$query = "SELECT * FROM Produtos WHERE id = $produto_id";
$result = $db->query($query);

// Verifique se a consulta foi bem-sucedida
if (!$result) {
    die("Query failed: " . $db->lastErrorMsg());
}

// Obtém os dados do produto
$produto = $result->fetchArray(SQLITE3_ASSOC);

// Feche a conexão com o banco de dados
$db->close();
?>

<!-- Formulário para editar um produto existente -->
<h2>Editar Produto</h2>
<form method="post" action="">
    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
    Nome do Produto: <input type="text" name="nome_do_produto" value="<?php echo $produto['nome_do_produto']; ?>" required><br>
    Código do Produto: <input type="text" name="codigo_do_produto" value="<?php echo $produto['codigo_do_produto']; ?>" required><br>
    Descrição do Produto: <input type="text" name="descricao_do_produto" value="<?php echo $produto['descricao_do_produto']; ?>" required><br>
    Preço do Produto: <input type="number" name="preco_do_produto" step="0.01" value="<?php echo $produto['preco_do_produto']; ?>" required><br>
    <input type="submit" name="editar_produto" value="Editar Produto">
</form>

<!-- Link de volta para a lista de produtos -->
<a href="index.php">Voltar para a Lista de Produtos</a>
