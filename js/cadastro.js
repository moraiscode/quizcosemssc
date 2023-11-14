// Função para verificar o acesso antes de submeter o formulário
function verificarAcessoAntesDeEnviar() {
    var whatsapp = document.getElementById('whatsapp').value;

    // Adicione aqui a lógica para verificar se o número de WhatsApp já está cadastrado no banco de dados

    // Exemplo de verificação
    if (whatsapp === 'numero_cadastrado') {
        // Se o número já estiver cadastrado, exibe um alerta e impede o envio do formulário
        mostrarAlerta('warning', 'Já existe um registro no banco de dados!');
        return false; // Impede o envio do formulário
    }

    // Se o número não estiver cadastrado, continua o envio do formulário
    return true;
}

// Função para mostrar alerta SweetAlert
function mostrarAlerta(type, message) {
    Swal.fire({
        icon: 'warning',
        title: 'Atenção',
        text: message,
    });
}

// Função para mostrar alerta SweetAlert
function mostrarErroConexao(erro) {
    Swal.fire({
        icon: 'error',
        title: 'Erro na Conexão',
        text: erro,
    });
}

// Função para verificar o acesso
function verificarAcesso() {
    var whatsapp = document.getElementById('whatsappmodal').value;

    $.ajax({
        type: 'POST',
        url: 'class/verificarusuario.php',
        data: {
            whatsappmodal: whatsapp
        },
        success: function(response) {
            // Remove alertas existentes
            $(".alert").remove();

            // Adiciona o alerta Bootstrap com base na resposta do servidor
            if (response === 'nao_cadastrado') {
                mostrarAlerta('warning',
                    'Ainda não há cadastro, por favor preencha o formulário!');
            } else if (response === 'venceu_quiz') {
                mostrarAlerta('danger', 'Só é permitido vencer o QUIZ uma vez!');
            } else {
                // Se existir e não venceu o quiz, redirecionar para "quiz.php"
                window.location.href = 'quiz.php';
            }
        },
        error: function(error) {
            // Lidar com erros de requisição Ajax
            console.error('Erro na requisição Ajax:', error);
        }
    });
}

function mostrarAlerta(type, message) {
    // Cria o elemento de alerta Bootstrap
    var alert = $('<div class="mb-3"><br/><div class="alert alert-' + type +
        ' alert-dismissible fade show" role="alert">' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
        message +
        '</div></div>');

    // Adiciona o alerta após o input
    $('#whatsappmodal').after(alert);

    // Fecha automaticamente após 5 segundos
    setTimeout(function() {
        alert.alert('close');
    }, 5000);
}