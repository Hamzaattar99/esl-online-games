<?php
$data = [];

if (!empty($content['data_json'])) {
    $decoded = json_decode($content['data_json'], true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $data = $decoded;
    }
}


$settings = [];

if (!empty($content['settings_json'])) {
    $decoded = json_decode($content['settings_json'], true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $settings = $decoded;
    }
}
?>

<div class="game-container">

    <div id="progressBar"></div>
    <div id="timer"></div>

    <div id="questionBox"></div>

    <div id="optionsBox"></div>

    <button onclick="next()">Next</button>

</div>

<script>
const data = <?= json_encode($data) ?>;
const settings = <?= json_encode($settings) ?>;

const engine = new GameEngine({
    data,
    settings,
    onFinish: () => {
        submitResult();
    }
});

let current = 0;

function render() {
    let q = data[current];

    document.getElementById("questionBox").innerHTML = q.question;

    let html = "";

    q.options.forEach(opt => {
        html += `<button onclick="checkAnswer('${opt}', '${q.answer}')">${opt}</button>`;
    });

    document.getElementById("optionsBox").innerHTML = html;

    updateProgress();
}

function checkAnswer(selected, correct) {
    let isCorrect = selected === correct;

    engine.answer(isCorrect);

    next();
}

function next() {
    current++;

    if (current >= data.length) {
        submitResult();
        return;
    }

    render();
}

function updateProgress() {
    let p = (current / data.length) * 100;
    document.getElementById("progressBar").style.width = p + "%";
}

function submitResult() {
    fetch("../api/save-result.php", {
        method: "POST",
        body: JSON.stringify(engine.result())
    }).then(() => {
        window.location.href = "result.php";
    });
}

render();
</script>