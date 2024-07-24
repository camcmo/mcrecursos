<?php

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados



$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obter o ID do comentário a ser excluído
$id = $_GET['id'];

// Consulta SQL para excluir o comentário
$sql = "DELETE FROM comentarios WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Comentário excluído com sucesso";
} else {
    echo "Erro ao excluir o comentário: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>