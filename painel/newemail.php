<?php
// Configurações do banco de dados

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o e-mail do formulário
    $email = $_POST["email"];

    // Prepara a consulta SQL para inserir o e-mail na tabela
    $sql = "INSERT INTO emails (endereco_email) VALUES ('$email')";

    // Executa a consulta
    if ($conn->query($sql) === TRUE) {
        $_SESSION["mensagem"] = "E-mail '$email' salvo com sucesso!";

        // Redireciona para a próxima página
        header("Location: emails.html");
        exit();
    } else {
        echo "Erro ao salvar o registro: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita | Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="edit.css" type="text/css" />
   
</head>
</head>

<body class="newemail">
    <nav class="navbar">
        <ul>
            <i class="fa-solid fa-gear" style="color: #ffffff;"></i>
            <li><button onclick="newemail()"><a href="newemail.php">Cadastrar Novo</a></button></li>
            <li><button onclick="emailcad()"><a href="emails.html">Emails Cadastrados</a></button></li>
            <i class="fa-solid fa-xmark" style="color: #ffffff;" onclick="retorne()" id="btnAbrirTela"></i>
            <!-- <li><button>Excluir E-mail</button></li> -->
            <script>
                    $(document).ready(function() {
                        $("#btnAbrirTela").click(function() {
                            $.ajax({
                                url: '../index.php',
                                type: 'GET',
                                success: function() {
                                    // Redireciona para a nova tela
                                    window.location.href = '../index.html';
                                },
                                error: function() {
                                    alert('Erro ao abrir a tela.');
                                }
                            });
                        });
                    });
                </script>
        </ul>
    </nav>

    <div class="edicao">
        <h2>Cadastrar Novo Email</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">E-mail:</label><br>
            <input type="email" name="email" required>
            <br>
            <input type="submit" value="Salvar">
        </form>
    </div>
</body>

</html>