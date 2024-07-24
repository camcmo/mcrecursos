<?php

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $user = $_POST["user"];
    $newpassword = $_POST["newpassword"];
    $passwordconf = $_POST["passwordconf"];
    $passwordadm = $_POST['passwordadm'];
    if ($user == 'DVL' || $user == 'ADM') {
        echo "Não é permitido alterar a senha do usuário DVL ou ADM.";
    } else {

        // Consultar os usuários DVL ou ADM com o usuário fornecido
        $query_users = "SELECT * FROM usuarios WHERE usuario = 'DVL' OR usuario = 'ADM';";
        $stmt_users = $conn->prepare($query_users);
        $stmt_users->execute();
        $result_users = $stmt_users->get_result();

        if ($result_users->num_rows > 0) {
            while ($row_user = $result_users->fetch_assoc()) {
                // Verificar se as senhas coincidem
                if ($newpassword == $passwordconf) {
                    // Verificar se a senha do administrador está correta
                    if (password_verify($passwordadm, $row_user['password'])) {
                        // Atualizar a senha na tabela usuarios
                        $hashedPassword = password_hash($newpassword, PASSWORD_BCRYPT);
                        $query_update = "UPDATE usuarios SET password = ? WHERE usuario = ?";
                        $stmt_update = $conn->prepare($query_update);
                        $stmt_update->bind_param("ss", $hashedPassword, $user);

                        // Executar a atualização da senha
                        if ($stmt_update->execute()) {
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
                                    <h2 style=\"color: brown;\">Senha atualizada com Sucesso!</h2>
                                </div>
                            </body>
                            </html>
                            ";                        } else {
                            echo "Erro ao atualizar a senha: " . $stmt_update->error;
                        }

                        // Fechar a declaração de atualização
                        $stmt_update->close();
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
                            <h2 style=\"color: brown;\">Senhas não coincidem!</h2>
                        </div>
                    </body>
                    </html>
                    ";
                }
            }
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
                <h2 style=\"color: brown;\">Usuário não encontrado ou Ação não permitida!</h2>
            </div>
        </body>
        </html>
        ";
        }

        // Fechar a declaração de consulta de usuários
        $stmt_users->close();
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}

?>