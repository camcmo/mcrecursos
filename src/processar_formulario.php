<?php
// Conectar ao banco de dados (substitua as informações conforme necessário)

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados


$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Capturar os valores do formulário
$remetente = $_POST['remetente'];
$data_envio = $_POST['date'];
$comentario = mysqli_real_escape_string($conn, $_POST['comentario']);

// Preparar a consulta SQL para inserir os dados
$sql = "INSERT INTO comentarios (data_envio, remetente, mensagem) VALUES ('$data_envio', '$remetente', '$comentario')";

// Executar a consulta SQL
if ($conn->query($sql) === TRUE) {
    echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Comentário</title>
            <link rel="stylesheet" href="blog.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        </head>
        <body class="error" style="display: flex; align-items: center; justify-content: center; height: 100vh;">
        <!-- <i class="fa-solid fa-circle-exclamation"></i> -->
        <h1 style="font-size: 40px;">Comentário salvo com sucesso!</h1>
        </body>
        </html>
HTML;
} else {
    echo "Erro ao enviar o comentário: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
