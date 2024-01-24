<?php
include "db/conn.php";

// Verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Prepara a consulta para excluir o produto com o ID fornecido
    $query = "DELETE FROM Produtos WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $produto_id, SQLITE3_INTEGER);

    // Executa a consulta
    $result = $stmt->execute();

    if ($result) {
        echo "Produto excluído com sucesso!";
        header("Location: index.php");
    } else {
        echo "Erro ao excluir o produto: " . $db->lastErrorMsg();
    }
} else {
    echo "ID do produto não fornecido.";
}

// Fechar a conexão SQLite3 explicitamente
$db->close();
?>
