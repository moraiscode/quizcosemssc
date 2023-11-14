<?php
include "class/verificasessao.php";
include "include/header.php";
?>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="ful
l   " data-sidebar-position="fixed" data-header-position="fixed">

        <div class="body-wrapper">

            <?php include "include/navbar.php"; ?>

            <div class="container-fluid">

                <div class="row justify-content-center w-100 p-3">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-3">
                            <input type="file" id="excelFile" accept=".xlsx"
                                class="btn btn-light mb-3 justify-content-md-end" />
                            <button id="convertToJson" class="btn btn-primary mb-3 justify-content-md-end">
                                <i class="ti ti-book-download"></i> Converter para JSON</button>

                        </div>
                        <table class="table table-bordered" id="questionTable">
                            <thead>
                                <tr>
                                    <th>Pergunta</th>
                                    <th>Respostas</th>
                                </tr>
                            </thead>
                            <tbody id="questionTableBody"></tbody>
                        </table>
                    </div>
                </div>

                <script>
                let jsonData;

                document.getElementById('excelFile').addEventListener('change', function(e) {
                    let file = e.target.files[0];
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let data = new Uint8Array(e.target.result);
                        let workbook = XLSX.read(data, {
                            type: 'array'
                        });
                        let worksheet = workbook.Sheets[workbook.SheetNames[0]];
                        jsonData = XLSX.utils.sheet_to_json(worksheet, {
                            header: 1
                        });
                        displayQuestions(jsonData);
                    };
                    reader.readAsArrayBuffer(file);
                });

                document.getElementById('convertToJson').addEventListener('click', function() {
                    let dataWithoutHeader = jsonData.slice(1); // Remove the first row
                    let dataStr = 'var perguntas = ' + JSON.stringify(dataWithoutHeader, null, 2) + ';';
                    let dataUri = 'data:application/javascript;charset=utf-8,' + encodeURIComponent(dataStr);

                    let exportFileDefaultName = 'data.js';

                    let linkElement = document.createElement('a');
                    linkElement.setAttribute('href', dataUri);
                    linkElement.setAttribute('download', exportFileDefaultName);
                    linkElement.click();
                });

                function displayQuestions(data) {
                    let questionTableBody = document.getElementById('questionTableBody');
                    questionTableBody.innerHTML = '';

                    for (let index = 1; index < data.length; index++) {
                        let row = data[index];
                        // Verifica se a linha é vazia
                        if (row.length === 0 || row.every(cell => cell === null || cell === undefined || cell === '')) {
                            continue;
                        }

                        let question = row[0];
                        let answers = [{
                                text: row[1],
                                correct: row[4] === 'A'
                            },
                            {
                                text: row[2],
                                correct: row[4] === 'B'
                            },
                            {
                                text: row[3],
                                correct: row[4] === 'C'
                            },
                        ];

                        let rowElement = document.createElement('tr');
                        let questionCell = document.createElement('td');
                        questionCell.innerText = question;
                        rowElement.appendChild(questionCell);

                        let answersCell = document.createElement('td');
                        answers.forEach(answer => {
                            let answerElement = document.createElement('div');
                            answerElement.innerHTML = (answer.correct ? '<strong>' : '') + answer.text +
                                (answer.correct ? '</strong>' : '');
                            answersCell.appendChild(answerElement);
                        });
                        rowElement.appendChild(answersCell);

                        questionTableBody.appendChild(rowElement);
                    }
                }
                </script>

                <?php include "include/devby.php"; ?>

            </div>

        </div>
    </div>

    <?php include "include/footer.php"; ?>