<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - MC Recursos</title>
    <link rel="stylesheet" href="../styles/style-blog.css">
    <link rel="stylesheet" href="../styles/media-block.css">
    <link rel="stylesheet" href="../styles/mediaquery-basic.css">
    <link rel="stylesheet" href="../styles/mediaquery-basic-footer.css">
    <link rel="stylesheet" href="../styles/mediaquery-blog.css">
    <!-- <link rel="stylesheet" href="../styles/reset.css"> -->
    <link rel="stylesheet" href="./blog-style.css">
    <link rel="stylesheet" href="../styles/basic.css" media="screen and (min-width: 600px)">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @font-face {
            font-family: "Clear Sans";
            src: url(ClearSans-Regular.ttf);
            /* Adicione outros formatos e estilos conforme necessário */
        }

        #formd {

            border-collapse: collapse;
            width: 100%;
            font-size: 30px;
            margin-top: 140px;
            text-align: center;
            font-weight: bold;
        }

        #title {
            font-size: 38px;
            font-weight: bold;
            text-align: center;
            color: brown;
            font-family: "Clear Sans";
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .post {
            background-color: white;
            padding-top: 150px;
            padding: 40px;
            padding-top: 150px;
        }
        #leiamais{
            margin: 40px;
            color: brown;
            font-weight: bold;
        }

        #msg {
            color: grey;
            font-style: italic;
            text-align: center;
        }

        #content {
            background-color: #bababa;
            margin: 120px;
            padding: 20px;
            border-radius: 5px;
        }

        .coments-cont {
            background-color: #bdb8b8;
            color: black;
            padding-left: 100px;
            margin-left: 100px;
            padding-right: 100px;
            margin-right: 100px;
            margin-top: 80px;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .coments-cont div {
            margin-top: 45px;
            background-color: white;
            padding: 40px;
            border-radius: 5px;
        }

        #data-envio {
            font-size: 20px;
        }

        #remetente {
            font-size: 20px;
            font-weight: bold;
        }

        .coments {
            background-color: white;
            padding: 35px;
        }

        @media only screen and (max-width: 600px) {
            #msg {
                color: grey;
                font-style: italic;
                text-align: center;
            }



            .coments-cont {
                background-color: #bdb8b8;
                margin: 0;
                color: black;
            }

            .coments-cont div {
                background-color: white;
            }

            #data-envio {
                font-size: 20px;
            }

            #remetente {
                font-size: 20px;
                font-weight: bold;
            }

            .coments {
                background-color: white;
                padding: 35px;
            }

        }
    </style>

</head>

<body>
    <header>
        <nav class="menus">
            <div class="logo"><a href="../index.html"><img src="../img/logo.png" id="logopng"></a>
                <div class="icons">
                    <span class="fa-solid fa-bars" id="bars"></span>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var barsIcon = document.getElementById('bars');
                    var menusUl = document.querySelector('.menusul');

                    barsIcon.addEventListener('click', function () {
                        // Verifica se o display atual é 'none' e altera para 'block', ou vice-versa
                        menusUl.style.display = menusUl.style.display === 'none' || menusUl.style.display === '' ? 'block' : 'none';
                    });
                });
            </script>
            </div>
            <ul class="menusul">
                <li><a href="../index.html">INÍCIO</a></li>
                <li><a href="sobre.html" id="it">SOBRE</a></li>
                <!-- <li><a href="docs/resolucao.pdf" id="it">CONTRAN</a></li> -->
                <li><a href="solucoes.html" id="it">SOLUÇÕES</a></li>
                <button type="button" onclick="blog()" class="blogbtn">BLOG</button>
            </ul>
        </nav>
    </header>
    <style>
        @media only screen and (max-width: 600px) {

            /* Estilos para dispositivos com largura máxima de 600px (celulares) */
            .post {
                width: 100%;
                /* Define a largura para ocupar toda a largura da tela */
                margin-left: 0;
                /* Remove a margem esquerda */
                padding: 20px;
                /* Diminui o padding para uma aparência mais compacta */
                padding-top: 100px;
                /* Reduz o espaço superior */
            }

            #formd {
                text-align: center;
                /* Centraliza o formulário de paginação */
            }
        }
    </style>

    <!-- .post {
    width: 950px;
    margin-left: 20%;
    padding: 40px;
    padding-top: 150px;
    
    }

    #formd {
    text-align: center;
    }

    @media only screen and (max-width: 600px) {
    .post {
    width: 100%;
    margin-left: 0;
    padding: 20px;
    padding-top: 100px;
    }
     -->
    </style>
    <?php
    // Conectar ao banco de dados (substitua as informações conforme necessário)

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "mcrecursos";
    
    // Conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Número de posts por página
    $postsPorPagina = 3;

    // Página atual (se não estiver definida, padrão é 1)
    $paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular o offset para a consulta SQL
    $offset = ($paginaAtual - 1) * $postsPorPagina;

    // Consulta SQL com LIMIT e OFFSET
    $sql = "SELECT * FROM postagens LIMIT $postsPorPagina OFFSET $offset";
    $result = $conn->query($sql);

    

    // Verificar se há resultados
    if ($result->num_rows > 0) {
        // Saída de dados de cada linha
        while ($row = $result->fetch_assoc()) {
            echo '<div class="post">';
            echo '<br>';
            echo '<div id="title">' . $row['titulo'] . '</div>';
            echo '<br>';
            echo '<div id="msg">' . $row['data'] . '</div>';
            echo '<br>';
            $conteudo = $row['conteudo'];
            if (strlen($conteudo) > 250) {
                $conteudo = substr($conteudo, 0, 40) . '...';
            }
            $link = $row['link'];
            echo "<div id='content'>" . $conteudo . "</div>";
            echo "<a href=\"../$link\" id='leiamais'>Leia Mais</a>";
            echo '<br>';
            echo '</div>';
        }
        // Formulário de paginação
        echo '<div id="formd">';
        if ($paginaAtual > 1) {
            echo '<a href="?pagina=' . ($paginaAtual - 1) . '"style="color: brown;">Anterior</a>';
        }
        if ($result->num_rows == $postsPorPagina) {
            echo ' <a href="?pagina=' . ($paginaAtual + 1) . '" style="color: brown;">Próximo</a>'; //corrigir lógica
        }
        echo '</div>';

    } else {
        // Caso não haja resultados
        echo '<p>Nenhuma postagem encontrada</p>';
    }

    // Consulta SQL para recuperar os comentários do banco de dados
    $sqlComentarios = "SELECT id, data_envio, remetente, mensagem FROM comentarios";
    $resultComentarios = $conn->query($sqlComentarios);

    // Verificar se há resultados
    if ($resultComentarios->num_rows > 0) {
        // Saída de dados de cada comentário
        while ($row = $resultComentarios->fetch_assoc()) {
            echo '<section class="coments">';
            echo '<div class="coments-cont">';
            echo '<p id="remetente"> Enviado por: ' . $row['remetente'] . '</p>';
            echo '<br>';
            echo '<p id="data-envio"> Enviado em: ' . $row['data_envio'] . '</p>';
            echo '<br>';
            echo '<p>' . $row['mensagem'] . '</p>';
            echo '</div>';
            echo '<br>';
            echo '</section>';
            echo '}';
        }
    } else {
        // Caso não haja resultados
        echo '<p>Nenhum comentário encontrado</p>';
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>

    <style>
        /* Media query para dispositivos com largura máxima de 600px (celulares) */
        @media only screen and (max-width: 600px) {
            .comentarios {
                margin: 10px;
                padding: 10px;
            }

            .comentarios h3 {
                font-size: 20px;
            }

            .comentarios input {
                padding: 5px;
                margin: 5px;
            }

            .comentarios textarea {
                width: 220px;

            }

            .comments fieldset {
                width: 90%;
                text-align: center;
            }

        }
    </style>
    <div class="comments">
        <form action="processar_formulario.php" method="post">
            <fieldset class="comentarios">
                <h3>Deixe seu comentário</h3>
                <input type="text" class="id" placeholder="Digite seu nome" name="remetente" />
                <input type="date" class="date" name="date" required /><br>
                <textarea class="comentario" placeholder="Deixe seu comentário" name="comentario"></textarea><br>
                <button type="submit" class="submit">Enviar</button>
            </fieldset>
        </form>
    </div>
    <div class="logo-container">
    <img src="../img/logo.png" alt="Logo">
  </div>

  <div class="footer-mc">
    <!-- Onde Estamos -->
    <div>
      <h2>Onde Estamos</h2>
      <div>
        <h5>R. Ângelo Perilo, 55 - Centro</h5>
        <h5>Lagoa da Prata - MG, 35590-048</h5>
      </div>
    </div>

    <!-- Atendimento -->
    <!-- <div>
      <h2>Atendimento</h2>
      <ul>
        <li><strong>Domingo:</strong> Fechado</li>
        <li><strong>Segunda-feira:</strong> 08:30–17:30</li>
        <li><strong>Terça-feira:</strong> 08:30–17:30</li>
        <li><strong>Quarta-feira:</strong> 08:30–17:30</li>
        <li><strong>Quinta-feira:</strong> 08:30–17:30</li>
        <li><strong>Sexta-feira:</strong> 08:30–17:00</li>
        <li><strong>Sábado:</strong> Fechado</li>
      </ul>
    </div> -->

    <!-- Redes Sociais -->
    <div>
      <h2>Redes Sociais</h2>
      <ul>
        <li><a href="https://www.facebook.com" target="_blank">Facebook</a></li>
        <li><a href="https://www.instagram.com" target="_blank">Instagram</a></li>
      </ul>
    </div>

    <!-- Política de Privacidade -->
    <div>
      <h2><a href="../politic.html">Política de Privacidade</a></h2>
    </div>

    <!-- Área Restrita -->
    
  </div>

  <!-- Rodapé -->
  <footer>
    <p>2024 © MC Recursos</p>
  </footer>

</body>

</html>