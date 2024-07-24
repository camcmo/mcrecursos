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
                <!-- <li><button onclick="folder()"><a href="registros.html">Registros</a></button></li> -->
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

        // Consulta SQL para recuperar os comentários do banco de dados (substitua os detalhes conforme necessário)
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Obter o número da página do parâmetro da URL
        $registrosPorPagina = 10;
        $offset = ($pagina - 1) * $registrosPorPagina;

        $sql = "SELECT * FROM postagens LIMIT $offset, $registrosPorPagina";
        $result = $conn->query($sql);

        // Verificar se há resultados
        if ($result->num_rows > 0) {
            echo '<div style="background-color: white; padding: 20px; width: 350px; text-align: center; margin-left: 30%;">';

            while ($row = $result->fetch_assoc()) {
                // Exiba as informações da postagem aqui
                echo '<tr>';
                echo '<td>' . $row['titulo'] . '</td>';
                echo '<td>' . $row['data'] . '</td>';
                echo '<td><button class="btn-excluir" onclick="excluirComentario(' . $row['id'] . ')" style="width: 80px; height: 40px; margin-left: 15px;">Excluir</button></td>';
                echo '</tr>';
                echo '<br>';

            }
            // Calcular o número total de registros
            $sqlTotalRegistros = "SELECT COUNT(*) as total FROM postagens";
            $resultTotalRegistros = $conn->query($sqlTotalRegistros);
            $rowTotalRegistros = $resultTotalRegistros->fetch_assoc();
            $totalRegistros = $rowTotalRegistros['total'];

            // Calcular o número total de páginas
            $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

            // Exibir os links de paginação
            echo '<div style="text-align: center; margin-top: 10%;">';
            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo '<a href="?pagina=' . $i . '">' . $i . '</a> ';
            }
            echo '</div>';


            echo '</div>';
        } else {
            // Caso não haja resultados
            echo '<div style="text-align: center; color: brown; margin-top: 10%; margin-left: 20%;">';
            echo '<i class="fa-solid fa-ban" style="color: brown; font-size: 60px; padding-bottom: 25px;"></i>';
            echo '<h2 style="font-family: Arial; font-style: italic; font-size: 40px;">Nenhuma postagem encontrada</h2>';
            echo '</div>';

        }
        // Fechar a conexão com o banco de dados
        $conn->close();
        ?>
        <script>
            function excluirComentario(id) {
                if (confirm("Tem certeza que deseja excluir esta postagem?")) {
                    // Enviar solicitação de exclusão para o arquivo PHP
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // Atualizar a tabela após a exclusão
                            location.reload();
                        }
                    };
                    xhttp.open("GET", "excluir_postagem.php?id=" + id, true);
                    xhttp.send();
                }
            }
        </script>



    </main>
</body>

</html>