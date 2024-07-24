$(document).ready(function() {
    $("#btnListarRegistros").click(function() {
        // Faz uma requisição AJAX para o script PHP que lista os registros
        $.ajax({
            url: 'listar_registros.php',
            type: 'GET',
            success: function(data) {
                // Exibe os registros na div 'resultado'
                $('#resultado').html(data);
            },
            error: function() {
                alert('Erro ao listar os registros.');
            }
        });
    });
});