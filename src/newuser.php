<?php

session_start();
setcookie("ck_authorized", "true", 0, "/");

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valores do formulário
    $username = $_POST['user'];
    $user_password = $_POST['password'];
    $admin_password = $_POST['passwordadm'];
    // Verifica se o nome de usuário é "DVL" ou "ADM"
    if ($username === 'DVL' || $username === 'ADM') {
        echo "Erro: Não é permitido cadastrar usuários com os nomes 'DVL' ou 'ADM'.";
        exit; // Interrompe a execução do script
    }

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "mcrecursos";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Senha de administrador correta (substitua pela senha real)
    $sql = "SELECT * FROM usuarios WHERE usuario = 'DVL' OR usuario = 'ADM'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtém a primeira linha do resultado
        $row = $result->fetch_assoc();

        // Verifica se a senha de administrador está correta
        if (password_verify($admin_password, $row['password'])) {

            // Hash da senha do usuário
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

            // Inserir novo usuário no banco de dados
            $sql = "INSERT INTO usuarios (usuario, password) VALUES ('$username', '$hashed_password')";

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
                        <h2 style=\"color: brown;\">Usuário inserido com sucesso!</h2>
                    </div>
                </body>
                </html>
                ";
            } else {
                echo "Erro ao cadastrar usuário: " . $conn->error;
            }

            // Fechar a conexão com o banco de dados
            $conn->close();
        } else {
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
                    <h2 style=\"color: brown;\">Senha de Administrador Incorreta!</h2>
                </div>
            </body>
            </html>
            ";
        }
    }
}
?>
