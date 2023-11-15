let cadastrarButton = document.getElementById('cadastrarButton');

document.getElementById('whatsapp').addEventListener('input', function () {
    let inputWhatsApp = this.value;

    if (inputWhatsApp.length >= 10) {

        let formData = new FormData();
        formData.append('whatsapp', inputWhatsApp);

        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);

                let alertElement = document.getElementById('whatsappAlert');
                if (response.exists) {
                    alertElement.className = 'alert alert-danger';
                    alertElement.innerText = 'Esse número já está cadastrado!';
                    cadastrarButton.disabled = true;
                } else {
                    alertElement.className = 'alert alert-success';
                    alertElement.innerText = 'Número disponível para cadastro';
                    cadastrarButton.disabled = false;
                }
            }
        };
        xhr.open('POST', 'class/verificar_whatsapp.php', true);
        xhr.send(formData);
    } else {
        document.getElementById('whatsappAlert').innerText = '';
        cadastrarButton.disabled = true;
    }
});
