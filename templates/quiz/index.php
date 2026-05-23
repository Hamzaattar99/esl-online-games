<?php

$data = $data ?? [];

?>

<div class="game-card">

    <div class="progress-wrapper">

        <div class="progress-bar"
        id="progressBar"></div>

    </div>

    <div class="quiz-question-count"
    id="questionCount">

        Question 1 /
        <?= count($data) ?>

    </div>

    <h2 class="quiz-question"
    id="questionTitle"></h2>

    <div class="quiz-options"
    id="optionsBox"></div>

</div>

<script>

const quizData =
window.gameContent.data;

const engine =
new GameEngine({

    data: quizData,
    settings:
    window.gameContent.settings

});

let current = 0;

function renderQuestion(){

    const q =
    quizData[current];

    document.getElementById(
        "questionCount"
    ).innerText =
    `Question ${current + 1} / ${quizData.length}`;

    document.getElementById(
        "questionTitle"
    ).innerText =
    q.question;

    const optionsBox =
    document.getElementById(
        "optionsBox"
    );

    optionsBox.innerHTML = "";

    q.options.forEach(option => {

        const btn =
        document.createElement(
            "button"
        );

        btn.className =
        "quiz-option-btn";

        btn.innerHTML = `
        <span>${option}</span>
        <i class="bi bi-arrow-right"></i>
        `;

        btn.onclick = () =>
        selectAnswer(
            btn,
            q,
            option
        );

        optionsBox.appendChild(btn);

    });

    updateProgress();

}

function selectAnswer(
    btn,
    q,
    option
){

    const isCorrect =
    engine.answer(
        q.question,
        option,
        q.answer
    );

    if(isCorrect){

        btn.classList.add(
            "correct"
        );

    }else{

        btn.classList.add(
            "wrong"
        );

    }

    document
    .querySelectorAll(
        ".quiz-option-btn"
    )
    .forEach(el => {

        el.disabled = true;

    });

    setTimeout(() => {

        current++;

        if(current >= quizData.length){

            finishQuiz();
            return;
        }

        renderQuestion();

    }, 1000);

}

function updateProgress(){

    const progress =
    engine.progress();

    document.getElementById(
        "progressBar"
    ).style.width =
    progress + "%";

    document.getElementById(
        "progressText"
    ).innerText =
    progress + "%";

}

async function finishQuiz(){

    const player =
    prompt(
        "Enter your name"
    ) || "Guest";

    const result =
    engine.result(player);

    await fetch(
        "api/save-result.php",
        {
            method:"POST",

            headers:{
                "Content-Type":
                "application/json"
            },

            body:
            JSON.stringify(result)
        }
    );

    const form =
    document.createElement(
        "form"
    );

    form.method = "POST";

    form.action =
    "result.php";

    const input =
    document.createElement(
        "input"
    );

    input.type = "hidden";

    input.name = "result";

    input.value =
    JSON.stringify(result);

    form.appendChild(input);

    document.body.appendChild(
        form
    );

    form.submit();

}

renderQuestion();

</script>