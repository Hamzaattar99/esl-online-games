<?php

$data = json_decode(
    $content['data_json'],
    true
);

$settings = json_decode(
    $content['settings_json'],
    true
);

?>

<div class="play-page">

    <div class="play-topbar">

        <div class="topbar-left">

            <button class="back-btn"
            id="leaveGameBtn">

                <i class="bi bi-arrow-left"></i>

            </button>

            <div>

                <div class="game-title">
                    <?= $content['content_title'] ?>
                </div>

                <div class="game-description">
                    <?= $content['description'] ?>
                </div>

            </div>

        </div>

        <div class="topbar-right">

            <div class="timer-box"
            id="timerBox">

                60

            </div>

        </div>

    </div>

    <div class="game-wrapper">

        <div class="game-card">

            <div class="progress-wrapper">

                <div class="progress-bar"
                id="progressBar"></div>

            </div>

            <div class="question-counter"
            id="questionCounter">

                Question 1 / <?= count($data) ?>

            </div>

            <div class="question-title"
            id="questionTitle"></div>

            <div class="options-grid"
            id="optionsGrid"></div>

        </div>

    </div>

</div>

<!-- Leave Modal -->

<div class="leave-modal"
id="leaveModal">

    <div class="leave-card">

        <div class="leave-icon">

            <i class="bi bi-box-arrow-left"></i>

        </div>

        <h2>Leave Game?</h2>

        <p class="text-muted">
            Your current progress may be lost.
        </p>

        <div class="leave-actions">

            <button
            class="btn btn-secondary"
            id="continueBtn">

                Continue

            </button>

            <button
            class="btn btn-danger"
            id="confirmLeaveBtn">

                Leave

            </button>

        </div>

    </div>

</div>

<script>

const quizData =
<?= json_encode($data) ?>;

const contentId =
<?= $content['content_id'] ?>;

const engine = new GameEngine({
    data: quizData
});

let current = 0;

function renderQuestion(){

    const q = quizData[current];

    document.getElementById(
        "questionCounter"
    ).innerText =
    `Question ${current + 1} / ${quizData.length}`;

    document.getElementById(
        "questionTitle"
    ).innerText = q.question;

    const optionsGrid =
    document.getElementById(
        "optionsGrid"
    );

    optionsGrid.innerHTML = "";

    q.options.forEach(option => {

        const btn =
        document.createElement("button");

        btn.className = "option-btn";

        btn.innerHTML = `
        <span>${option}</span>
        <i class="bi bi-arrow-right"></i>
        `;

        btn.onclick = () =>
        selectAnswer(btn, q, option);

        optionsGrid.appendChild(btn);

    });

    updateProgress();

}

function selectAnswer(btn, q, selected){

    const isCorrect =
    engine.answer(
        q.question,
        selected,
        q.answer
    );

    if(isCorrect){

        btn.classList.add("correct");

    }else{

        btn.classList.add("wrong");

    }

    document
    .querySelectorAll(".option-btn")
    .forEach(el => {

        el.disabled = true;

    });

    setTimeout(() => {

        current++;

        if(current >= quizData.length){

            finishGame();

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

}

async function finishGame(){

    const player =
    prompt("Enter your name");

    const result =
    engine.result(
        contentId,
        player || "Guest"
    );

    const response =
    await fetch(
        "api/save-result.php",
        {
            method:"POST",

            headers:{
                "Content-Type":
                "application/json"
            },

            body:JSON.stringify(result)
        }
    );

    const data =
    await response.json();

    const form =
    document.createElement("form");

    form.method = "POST";

    form.action = "result.php";

    const input =
    document.createElement("input");

    input.type = "hidden";

    input.name = "result";

    input.value =
    JSON.stringify(result);

    form.appendChild(input);

    document.body.appendChild(form);

    form.submit();

}

renderQuestion();

/* =========================
   Leave Modal
========================= */

const leaveBtn =
document.getElementById(
    "leaveGameBtn"
);

const leaveModal =
document.getElementById(
    "leaveModal"
);

leaveBtn.onclick = () => {

    leaveModal.classList.add(
        "active"
    );

};

document.getElementById(
    "continueBtn"
).onclick = () => {

    leaveModal.classList.remove(
        "active"
    );

};

document.getElementById(
    "confirmLeaveBtn"
).onclick = () => {

    window.location.href =
    "index.php";

};

</script>