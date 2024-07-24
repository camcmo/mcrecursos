<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verifica se o campo de e-mail foi preenchido
    if (isset($_POST['email'])) {
        
        // Obtém o valor do campo de e-mail
        $email = $_POST['email'];
        
        // Conexão com o banco de dados (substitua as informações de acordo com o seu ambiente)

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Prepara e executa a consulta SQL para inserir os dados no banco de dados
        $sql = "INSERT INTO emails (email) VALUES ('$email')";
        
        if ($conn->query($sql) === TRUE) {
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
                <h2 style=\"color: brown;\">Registro inserido com sucesso!</h2>
            </div>
        </body>
        </html>
        ";
        } else {
            echo "Erro ao registrar: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "O campo de e-mail não foi preenchido.";
    }
}
?>
