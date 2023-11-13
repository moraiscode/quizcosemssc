// Adiciona máscara em tempo real para o número do WhatsApp
document.getElementById('whatsapp').addEventListener('input', function(event) {
    let inputValue = event.target.value.replace(/\D/g,
        ''); // Remove caracteres não numéricos
    let formattedValue = '';

    if (inputValue.length > 2) {
        formattedValue += `(${inputValue.substring(0, 2)}) `;
        if (inputValue.length > 7) {
            formattedValue +=
                `${inputValue.substring(2, 7)}-${inputValue.substring(7, 11)}`;
        } else {
            formattedValue += inputValue.substring(2);
        }
    } else {
        formattedValue = inputValue;
    }

    event.target.value = formattedValue;
});