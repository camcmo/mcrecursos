<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $assunto = $_POST["assunto"];
    $emailRemetente = $_POST["email"];
    $telefone = $_POST["telefone"];
    $mensagem = $_POST["mensagem"];

    // Configurações para o e-mail
    $subject = "Nova mensagem do formulário";

    // Constrói o corpo do e-mail
    $message = "Nome: $nome\n";
    $message .= "Assunto: $assunto\n";
    $message .= "E-mail: $emailRemetente\n";
    $message .= "Telefone: $telefone\n";
    $message .= "Mensagem:\n$mensagem";

    // Busca e-mails na tabela "email"

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT email FROM emails");
    $to = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Adiciona cada e-mail encontrado à lista de destinatários
            $to[] = $row["email"];
        }
    } else {
        echo "Nenhum e-mail encontrado na tabela 'email'";
    }

    $conn->close();

    // Envia o e-mail para cada destinatário
    foreach ($to as $destinatario) {
        $headers = "From: $emailRemetente";
    
        if (mail($destinatario, $subject, $message, $headers)) {
            echo "
            <!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Sucesso na Postagem</title>
            </head>
            <body>
                <div style=\"text-align: center; padding: 20px; background-color: #e0e0e0;\">
                    <h2 style=\"color: brown;\">Email enviado com sucesso!</h2>
                </div>
            </body>
            </html>
            ";
           
        } else {
            echo '<div style="color: red; font-weight: bold;">';
            echo 'Erro ao enviar o e-mail para ' . $destinatario . '. Motivo: ' . error_get_last()['message'];
            echo '</div><br>';
        }
    }
    
} else {
    echo "Acesso inválido.";
}
?>
