<?php
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do banco de dados
$password = "6698"; // Senha do banco de dados
$dbname = "mcrecursos"; // Nome do banco de dados

// Criando uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para excluir todos os registros da tabela (substitua 'sua_tabela' pelo nome da sua tabela)
$sql = "DELETE FROM emails";
$conn->query($sql);

// Fecha a conexão com o banco de dados
$conn->close();
echo "Registros Excluídos"
?>
