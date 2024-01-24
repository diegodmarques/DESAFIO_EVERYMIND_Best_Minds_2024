<?php
include "db/conn.php";

// Exemplo de consulta para obter dados da tabela de produtos
$query = "SELECT * FROM Produtos";
$result = $db->query($query);

// Verifica se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $db->lastErrorMsg());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
    <h2>Lista de Produtos</h2>

    <?php
    // Verifica se há dados na tabela
    if ($result->numColumns() > 0) {
        echo "<table>";
        echo "<tr>";

        // Exibe os cabeçalhos da tabela
              // Exibe os cabeçalhos da tabela
        echo "<th>ID</th>";
        echo "<th>Nome do Produto</th>";
        echo "<th>Código</th>";
        echo "<th>Descrição</th>";
        echo "<th>Preço</th>";
        echo "<th>Ações</th>"; // Coluna adicional para botões de ação
        echo "</tr>";

        // Exibe os dados da tabela
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }

            // Adiciona botões de editar e excluir
            echo "<td>";
            echo "<a class='edit-btn' href='update.php?id=" . $row['id'] . "'>Editar</a>";
            echo "<a class='delete-btn' href='delete.php?id=" . $row['id'] . "'>Excluir</a>";
            echo "</td>";

            echo "</tr>";
        }
 


        echo "</table>";

        echo "<a class='edit-btn' href='cadastro.php?'>Cadastrar Produto</a>";
    } else {
        echo "<p>Nenhum produto encontrado.</p>";
    }

    $db->close();
?>
   



