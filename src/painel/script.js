function abrirNovaGuia() {
    var largura = 800;
    var altura = 800;
    var left = (window.innerWidth - largura) / 2;
    var top = (window.innerHeight - altura) / 2;

    // Abre uma nova guia com a página HTML e dimensões especificadas
    var novaGuia = window.open('', '_blank', 'width=' + largura + ',height=' + altura + ',left=' + left + ',top=' + top);

    // Escreve o conteúdo HTML na nova guia
    novaGuia.document.write(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email System</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            input, button {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <h2>Email System</h2>
        <form id="emailForm">
            <label for="email">Email:</label>
            <input type="email" id="email" required>
            <button type="button" onclick="addEmail()">Adicionar Email</button>
        </form>
        
        <h3>Lista de Emails</h3>
        <ul id="emailList"></ul>
    
        <script src="scripteste.js"></script>
    </body>
    </html>
    `);

    // Fecha o documento para garantir que a marcação HTML seja interpretada corretamente
    novaGuia.document.close();
}

// Chama a função quando necessário (por exemplo, em resposta a um evento de clique)
abrirNovaGuia();


function retorne() {
    window.location.href = "../index.php";
}