<?php
session_start();

// Verifica se o botão de logout foi clicado
if (isset($_POST['logout'])) {
    // Destroi a sessão
    session_destroy();
    // Redireciona para a página de login
    header("Location: ../index.html");
    exit();
}

// Verifica se a sessão não está definida ou se o usuário não está autenticado
if (!isset($_SESSION["login"])) {
    header("Location: ./src/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita</title>
    <script src="myscript.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="edit.css" type="text/css" />
</head>

<body style="background-image: url(../img/textura2.jpg);">
    <header>
        <div class="bar-super" style="background-color: rgb(75, 38, 38);">
            <img src="../img/logo.png" alt="Logo" style="width: 60px; margin-left: 15px">
          

        </div>
    </header>
    <main>
        <nav class="navbar">
            <ul>
                <i class="fa-solid fa-gear" style="color: #ffffff;"></i>
                <li><button onclick="folder()"><a href="registros.php"
                            style="font-family: Arial;">Registros</a></button></li>
                <!-- <li><button onclick="emailcad()"><a href="painel/emails.html">Emails Cadastrados</a></button></li> -->
                <!-- <li><button>Excluir E-mail</button></li> -->
                <li><button onclick="editor()"><a href="editor.php" style="font-family: Arial;">Painel do
                            Blog</a></button></li>
                <form method="post" style="text-align: center; margin: 10px;">
                    <input type="submit" name="logout" value="Logout" id="logout"
                        style="background-color: brown; padding: 15px; color: white; border-radius: 5px;">
                </form>
            </ul>
        </nav>
        <section class="register">
            <h1 style="font-family: Arial; font-size: 35px;">Cadastro de emails</h1>
            <form action="registra_email.php" method="post">
                <!-- Campo de E-mail -->
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <!-- Botão de Salvar -->
                <button type="submit" name="salvar">Salvar</button>

                <!-- Botão de Excluir -->
                <!-- <button type="button" onclick="excluir()">Excluir</button> -->
            </form>
            <?php
            // Configurações do banco de dados

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

            // Consulta SQL para obter os dados da tabela email
            $sql = "SELECT * FROM emails";
            $result = $conn->query($sql);
            // Exibir os dados na tabela
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["email"] . "</td></tr>";
                    echo '<td><button class="btn-excluir" onclick="excluirEmail(' . $row['id'] . ')" style="width: 80px; height: 40px; margin-left: 15px;">Excluir</button></td>';
                    echo '<br>';
                }
            } else {
                echo '<div style="text-align: center; color: brown; margin-top: 10%;">';
                echo '<i class="fa-solid fa-ban" style="color: brown; font-size: 60px; padding-bottom: 25px;"></i>';
                echo '<h2 style="font-family: Arial; font-style: italic; font-size: 30px;">Nenhum registro encontrado</h2>';
                echo '</div>';
            }

            ?>
        </section>
        <script>
            function excluirEmail(id) {
                if (confirm("Tem certeza que deseja excluir este email?")) {
                    // Enviar solicitação de exclusão para o arquivo PHP
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // Atualizar a tabela após a exclusão
                            location.reload();
                        }
                    };
                    xhttp.open("GET", "excluir_email.php?id=" + id, true);
                    xhttp.send();
                }
            }
        </script>


        <script>
            $(document).ready(function () {
                $("#btnAbrirTela").click(function () {
                    $.ajax({
                        url: 'index.html',
                        type: 'GET',
                        success: function () {
                            // Redireciona para a nova tela
                            window.location.href = 'index.html';
                        },
                        error: function () {
                            alert('Erro ao abrir a tela.');
                        }
                    });
                });
            });
        </script>
    </main>
</body>

</html>