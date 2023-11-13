<?php
// Inicie ou retome a sessão
session_start();

// Se o número de WhatsApp estiver disponível na sessão
if (isset($_SESSION['whatsapp'])) {
    $whatsappDoJogador = $_SESSION['whatsapp'];
    // Faça o que precisar com $whatsappDoJogador, como atualizar o campo "vitorioso" no banco de dados.
}

// Includes Essenciais
// include "class/verificasessao.php";
include "include/header.php";
?>

<style>
.center-screen {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100vh;
}

.progress {
    height: 20px;
    /* margin-bottom: 20px; */
}

.progress-bar {
    transition: width 1s;
}

.green {
    background-color: green;
}

.blue {
    background-color: blue;
}

.orange {
    background-color: orange;
}

.red {
    background-color: red;
}

h2 {
    margin: 10% 0 5% 0;
    font-weight: bold;
    margin-bottom: 2em;
}

button.btn.btn-light.mb-3.w-100 {
    font-size: 20px;
    padding: 3%;
    border: solid;
}

.correct {
    background-color: green !important;
    color: white !important;
    border: solid;
}

.incorrect {
    background-color: red !important;
    color: white !important;
    border: solid;
}
</style>

<body>
    <!--  Body Wrapper -->

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="">
                                <!-- <div class="card-body"> -->

                                <div class="w-100 p-3">
                                    <div class="row text-center">
                                        <h1>
                                            <?php
                                            // Resgatar o WhatsApp da URL
                                            echo $whatsappDoJogador = isset($_SESSION['whatsapp']) ? $_SESSION['whatsapp'] : null;
                                            ;
                                            ?>
                                        </h1>
                                        <div class="col-md-12 align-middle">
                                            <h1 class="align-middle">
                                                <i class="ti ti-gauge"></i>
                                                <span id="timer"></span>
                                            </h1>
                                        </div>
                                        <div class="col-md-12 align-middle p-3">
                                            <div class="progress align-middle">
                                                <div id="timerBar" class="progress-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="questionContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // if (isset($_SESSION['whatsapp'])) {
    //     alert("WhatsApp do jogador: ".$_SESSION['whatsapp'].
    //         "");

    // }

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
        // Reproduzindo o áudio
        var audio = document.getElementById('audio-success');
        audio.play();

        clearInterval(timer);
        Swal.fire({
            title: correctAnswers >= 3 ? 'Parabéns, você venceu!' : 'Não foi dessa vez!',
            icon: correctAnswers >= 3 ? 'success' : 'error',
            timer: 10000,
            timerProgressBar: true,
            showConfirmButton: false,
            didClose: () => {
                window.location.href = 'index.php';
            }
        });
    }

    // Associando a função ao botão
    document.getElementById('show-alert').addEventListener('click', showAlert);
    </script>



    <?php include "include/footer.php"; ?>