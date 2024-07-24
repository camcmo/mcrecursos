<?php
// Assuming you have a database connection established

$servername = "localhost"; // Endereço do servidor MySQL
$username = "u861504172_contato"; // Nome de usuário do banco de dados
$password = "Mcre3101!"; // Senha do banco de dados
$dbname = "u861504172_mcrecursos"; // Nome do banco de dados
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mcrecursos";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // $capa = $_FILES["capa"]["tmp_name"];
  $titulo = $_POST['titulo'];
  $datapubli = $_POST['datapubli'];

  $conteudo = mysqli_real_escape_string($conn, $_POST['conteudo']);
  $conteudo = str_replace(array("\r\n", "\r", "\n"), '', $_POST['conteudo']);

  $raiz_img = "mcrecursos/painel/";


  $diretorio_img = "posts/";


  $nome_arquivo_img = strtolower(str_replace(' ', '_', $_FILES['capa']['name']));
  $caminho_arquivo_img = $diretorio_img . $nome_arquivo_img;


  move_uploaded_file($_FILES['capa']['tmp_name'], $caminho_arquivo_img);

  $raiz = "painel/";

  $diretorio = "posts/";

  // Nome do arquivo com base no título
  $nome_arquivo = strtolower(preg_replace('/[\s:-]/', '', $titulo)) . ".html";

  // Caminho completo do arquivo
  $caminho_arquivo = $diretorio . $nome_arquivo;
  // SQL query to insert data into the "postagens" table
  $sql = "INSERT INTO postagens (titulo, data, conteudo, link, capa) VALUES
     ('$titulo', '$datapubli', '$conteudo', '$raiz$caminho_arquivo', '$raiz_img$caminho_arquivo_img')";

  // Execute the query
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
                <h2 style=\"color: brown;\">Postagem inserida com sucesso!</h2>
            </div>
        </body>
        </html>
        ";
    // Diretório onde o arquivo será salvo
    $raiz = "mcrecursos/painel/";

    $diretorio = "posts/";

    // Nome do arquivo com base no título
    $nome_arquivo = strtolower(preg_replace('/[\s:-]/', '', $titulo)) . ".html";

    // Caminho completo do arquivo
    $caminho_arquivo = $diretorio . $nome_arquivo;

    // SQL query to insert data into the "postagens" table
    // $sql = "INSERT INTO postagens (link) VALUES ('$raiz $caminho_arquivo')";
    // if ($conn->query($sql) === TRUE) {
    //     echo "Link inserido com sucesso!";
    // } else {
    //     echo "Erro ao inserir link: " . $conn->error;
    // }
    // // Conteúdo HTML
    $html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../../styles/mediaquery-basic-footer.css'>
    <link rel='stylesheet' href='../../styles/mediaquery-basic.css'>
    <link rel='stylesheet' href='../../styles/basic.css' media='screen and (min-width: 600px)'>
    <link rel='stylesheet' href='../../styles/reset.css'>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'
    integrity='sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=='
    crossorigin='anonymous' referrerpolicy='no-referrer' />

    <link rel='stylesheet' href='../../styles/media-block.css'>
    <link rel='stylesheet' href='../../styles/style-blog.css'>
    <link rel='stylesheet' href='../../styles/newpost.css'>
    <title>$titulo</title>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&family=Roboto:wght@500&family=Sora&display=swap' rel='stylesheet'>
</head>

<body>
<header>
<nav class='menus'>
  <div class='logo'>
    <a href='../../index.html'><img src='../../img/logo.png' id='logopng'>
    </a>
    <div class='icons'>
      <span class='fa-solid fa-bars' id='bars'></span>
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


  <ul class='menusul'>
    <li id='dest'><a href='../../index.html'>INÍCIO</a></li>
    <li><a href='../../src/sobre.html' id='it'>SOBRE</a></li>
    <li><a href='../../src/solucoes.html' id='it'>SOLUÇÕES</a></li>
    <button type='button' onclick='blognovo()' class='blogbtn'>BLOG</button>
    <script>
      function blognovo() {
        window.location.href = 'src/blog.php';
      }

    </script>

  </ul>

</nav>

</header>
<main class='post-novo'>
    <h1 id='title-css'>$titulo</h1>
    <div id='data-publi'>Data de Publicação: $datapubli</div>
    <img src='../$caminho_arquivo_img' id='capa'>
    <div id='conteudo-css'>$conteudo</div>
    <div class='custom-container'>
        <i class='fas fa-user'></i> Autor: MC Recursos - Lagoa da Prata<br>
        Serviço especializado de Direito no Trânsito
    </div>
    <div class='contact'>
        <h2>Você tem uma multa e quer evitar perder sua habilitação?</h2>
        <p><a href='https://wa.me/5537988585482?text=Ol%C3%A1%21+Gostaria+de+saber+mais+sobre+a+MC+Recursos%21' id='especialist'>Clique aqui e fale com um especialista!</a></p>
    </div>
    <div class='logo-container'>
        <img src='../../img/logo.png' alt='Logo'>
    </div>

    <!-- New div -->
    <div class='footer-mc'>

        <div>

            <h2>Onde Estamos</h2>
            <div>
                <h5>R. Ângelo Perilo, 55 - Centro</h5>
                <h5>Lagoa da Prata - MG, 35590-048</h5>
            </div>
        </div>
        
        <div>
            <h2>Redes Sociais</h2>
            <ul>
                <li><a href='https://www.facebook.com' target='_blank'>Facebook</a></li>
                <li><a href='https://www.instagram.com' target='_blank'>Instagram</a></li>
            </ul>
        </div>
        <div>
            <h2><a href='../../politic.html'>Política de Privacidade</a></h2>
            <!-- Adicione informações sobre a política de privacidade -->
        </div>
        
    </div>
</main>
<footer>
<p>2024 © MC Recursos</p>
</footer>
</body>
</html>";




    // Salvar o conteúdo no arquivo
    file_put_contents($caminho_arquivo, $html);

    // Redirecionar para a página do blog ou exibir uma mensagem de sucesso
    // header("Location: index.");
    exit();
  } else {
    echo "Erro ao inserir postagem: " . $conn->error;
  }
}

$conn->close();


?>