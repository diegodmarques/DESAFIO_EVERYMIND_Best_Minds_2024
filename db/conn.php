

<?php

// Caminho para o arquivo SQLite
$database_file = "db/nunesports.db";

try {
    // Cria uma nova instância da classe SQLite3
    $db = new SQLite3($database_file);
   
    // Exemplo de como usar a conexão (opcional)
    // $query = "SELECT * FROM sua_tabela";
    // $result = $db->query($query);
} catch (Exception $e) {
    // Em caso de erro na conexão, exibe uma mensagem e encerra o script
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

?>
