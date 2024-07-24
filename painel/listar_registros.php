<?php

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados

// Criando uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);


// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para obter todos os registros da tabela (substitua 'sua_tabela' pelo nome da sua tabela)
$sql = "SELECT * FROM emails";
$result = $conn->query($sql);

// Fecha a conexão com o banco de dados
$conn->close();
?>

<?php
// Exibe os registros se houver algum
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Aqui você exibe os dados de cada registro, ajuste conforme necessário
        echo "<p> {$row['endereco_email']}</p>";
    }
} else {
    echo "Não há registros.";
}
?>
