
function updateTimer() {
    let timerElement = document.getElementById('timer');
    let timerBarElement = document.getElementById('timerBar');
    let time = parseInt(timerElement.innerText, 10) || 120;
    time--;

    // Atualize a largura da barra de progresso com base no tempo restante
    let progress = (time / 120) * 100;
    timerBarElement.style.width = progress + '%';

    timerElement.innerText = time;

    // Atualize as classes CSS da barra de progresso com base no progresso
    timerBarElement.classList.remove('green', 'blue', 'orange', 'red');
    if (progress >= 90) {
        timerBarElement.classList.add('green');
    } else if (progress >= 70) {
        timerBarElement.classList.add('blue');
    } else if (progress >= 40) {
        timerBarElement.classList.add('orange');
    } else {
        timerBarElement.classList.add('red');
    }

    if (time <= 0) {
        endGame();
    }
}

let questions;
let currentQuestionIndex = 0;
let correctAnswers = 0;
let timer;

// Use the perguntas variable directly
questions = _.sampleSize(perguntas, 5);
displayQuestion();
timer = setInterval(updateTimer, 1000);

function displayQuestion() {
    let questionContainer = document.getElementById('questionContainer');
    questionContainer.innerHTML = '';
    let question = questions[currentQuestionIndex];
    let questionElement = document.createElement('h2');
    questionElement.innerHTML = question[0] + '<br/>'; // Adicione <br/> após o título da pergunta
    questionContainer.appendChild(questionElement);
    for (let i = 1; i <= 3; i++) {
        let answerElement = document.createElement('button');
        answerElement.innerText = question[i];
        answerElement.classList.add('btn', 'btn-light', 'mb-3', 'w-100');
        answerElement.addEventListener('click', function() {
            let correct = question[4] === String.fromCharCode(64 + i);
            markAnswer(this, correct); // Adiciona esta linha para marcar a resposta
            if (correct) {
                correctAnswers++;
            }
            updateStats(question[0], correct);
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                setTimeout(displayQuestion, 2000); // Atraso de 1 segundo antes da próxima pergunta
            } else {
                endGame();
            }
        });
        questionContainer.appendChild(answerElement);
    }
}


function markAnswer(button, correct) {
    button.disabled = true;
    if (correct) {
        button.classList.add('correct');
    } else {
        button.classList.add('incorrect');

        // Encontrar o botão com a resposta correta e marcá-lo como verde
        let correctButton = Array.from(document.getElementsByClassName('btn-light'))
            .find((btn) => btn.innerText === questions[currentQuestionIndex][4]);

        if (correctButton) {
            correctButton.classList.add('correct');
        }
    }
}


function updateStats(question, correct) {
    let stats = JSON.parse(localStorage.getItem('stats')) || {};
    if (!stats[question]) {
        stats[question] = {
            correct: 0,
            incorrect: 0
        };
    }
    if (correct) {
        stats[question].correct++;
    } else {
        stats[question].incorrect++;
    }
    localStorage.setItem('stats', JSON.stringify(stats));
}

function endGame() {
    var audio = document.getElementById('audio-success');
    audio.play();

    clearInterval(timer);

    Swal.fire({
        title: correctAnswers >= 3 ? 'Parabéns, vá ao balcão para retirar o kit!' : 'Não foi dessa vez!',
        icon: correctAnswers >= 3 ? 'success' : 'error',
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: false,
        didClose: () => {
            // Se o jogador venceu, faça a requisição AJAX para "vencedor.php"
            if (correctAnswers >= 3) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Redirecione para "codigo.php" após a conclusão da requisição
                        window.location.href = 'index.php';
                        // window.location.href = 'codigo.php';
                    }
                };
                xhttp.open("GET", 'class/vencedor.php?whatsapp=' + encodeURIComponent(
                    '<?php echo $whatsappDoJogador; ?>'), true);
                xhttp.send();
            } else {
                // Se o jogador não venceu, redirecione para "index.php"
                window.location.href = 'index.php';
            }
        }
    });
}



// Associando a função ao botão
document.getElementById('show-alert').addEventListener('click', showAlert);