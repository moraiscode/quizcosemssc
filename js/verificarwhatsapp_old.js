// Obtenha uma referência ao botão de cadastro
let cadastrarButton = document.getElementById('cadastrarButton');

document.getElementById('whatsapp').addEventListener('input', function () {
    let inputWhatsApp = this.value;

    // Realize a verificação apenas se o número de WhatsApp atender aos requisitos mínimos
    if (inputWhatsApp.length >= 10) {
        // Crie um objeto FormData para enviar os parâmetros
        let formData = new FormData();
        formData.append('whatsapp', inputWhatsApp);

        // Faça uma requisição AJAX para verificar se o número já está cadastrado
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);

                // Exiba a mensagem de alerta com base na resposta
                let alertElement = document.getElementById('whatsappAlert');
                if (response.exists) {
                    alertElement.className = 'alert alert-danger';
                    alertElement.innerText = 'Esse número já está cadastrado!';
                    // Desabilite o botão de cadastro se o número já estiver cadastrado
                    cadastrarButton.disabled = true;
                } else {
                    alertElement.className = 'alert alert-success';
                    alertElement.innerText = 'Número disponível para cadastro';
                    // Habilite o botão de cadastro se o número não estiver cadastrado
                    cadastrarButton.disabled = false;
                }
            }
        };

        // Substitua "verificar_whatsapp.php" pelo nome do arquivo que você usará para verificar o WhatsApp
        xhr.open('POST', 'class/verificar_whatsapp.php', true);
        xhr.send(formData);
    } else {
        // Limpe a mensagem de alerta se o número for muito curto
        document.getElementById('whatsappAlert').innerText = '';
        // Desabilite o botão de cadastro se o número for muito curto
        cadastrarButton.disabled = true;
    }
});
