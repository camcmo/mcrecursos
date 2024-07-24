<?php
session_start();

// Verifica se o botão de logout foi clicado
if (isset($_POST['logout'])) {
    // Destroi a sessão
    session_destroy();
    // Redireciona para a página de login
    header("Location: index.html");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="cadastro.css" type="text/css" />
</head>

<body>
    <header>
        <div class="bar-super" style="background-color: rgb(75, 38, 38);">
            <img src="./img/logo.png" alt="Logo" style="width: 60px; margin-left: 15px">
          

        </div>
    </header>
    <main>
        <nav class="navbar">
            <ul>
                <i class="fa-solid fa-gear" style="color: #ffffff;"></i>
                <li><button onclick="folder()"><a href="painel/registros.php">Registros</a></button></li>
                <!-- <li><button onclick="emailcad()"><a href="painel/emails.html">Emails Cadastrados</a></button></li> -->
                <!-- <li><button>Excluir E-mail</button></li> -->
                <li><button onclick="editor()"><a href="painel/editor.php">Painel do Blog</a></button></li>
                <form method="post" style="text-align: center; margin: 10px;">
                    <input type="submit" name="logout" value="Logout" id="logout" style="background-color: brown; padding: 15px; color: white; border-radius: 5px;">
                </form>

               

            </ul>
        </nav>


    </main>
</body>

</html>