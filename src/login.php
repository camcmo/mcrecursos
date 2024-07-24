<?php
session_start();
setcookie("ck_authorized", "true", 0, "/");

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados

// Criando uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo dados do formulário
    $username = $_POST["usuario"];
    $password_input = $_POST["password"];

    // Usando instruções preparadas para evitar injeção de SQL
    $query = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificando se há um registro correspondente no banco de dados
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

         // Debug
       

        if (password_verify($password_input, $hashed_password)) {
            $_SESSION["login"] = $username;
            header("Location: ../cadastro.php");
            exit();
        } else {
            // Credenciais inválidas, exibir mensagem de erro
            echo <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login</title>
                <link rel="stylesheet" href="login.css"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            </head>
            <body class="error" style="display: flex; align-items: center; justify-content: center; height: 100vh;">
                <h1 style="font-size: 40px;">Credenciais inválidas, por favor, volte e tente novamente!</h1>
            </body>
            </html>
HTML;
        }
    } else {
        // Nenhum registro correspondente, exibir mensagem de erro
        echo "Usuário não encontrado!";
    }

    // Fechar a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
