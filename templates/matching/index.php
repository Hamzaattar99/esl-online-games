<?php

$data = json_decode(
    $content['data_json'],
    true
);

if(!$data || !is_array($data)){

    include 'views/errors/json-error.php';
    exit;
}

$leftItems = $data;
$rightItems = $data;

shuffle($rightItems);

?>

<div class="play-page matching-page">

    <div class="play-topbar">

        <div class="topbar-left">

            <a href="index.php"
            class="back-btn">

                <i class="bi bi-arrow-left"></i>

            </a>

            <div>

                <div class="game-title">
                    <?= htmlspecialchars($content['content_title']) ?>
                </div>

                <div class="game-description">
                    Drag and match the correct answers
                </div>

            </div>

        </div>

        <div class="topbar-right">

            <div class="timer-box"
            id="matchingTimer">

                0s

            </div>

        </div>

    </div>

    <div class="game-wrapper">

        <div class="game-card">

            <div class="matching-layout">

                <div class="matching-column">

                    <h3 class="matching-title">
                        Questions
                    </h3>

                    <?php foreach($leftItems as $item): ?>

                    <div class="match-item left-item"
                    data-match="<?= $item['right'] ?>">

                        <?= htmlspecialchars($item['left']) ?>

                    </div>

                    <?php endforeach; ?>

                </div>

                <div class="matching-column">

                    <h3 class="matching-title">
                        Answers
                    </h3>

                    <?php foreach($rightItems as $item): ?>

                    <div class="match-item right-item"
                    draggable="true"
                    data-value="<?= $item['right'] ?>">

                        <?= htmlspecialchars($item['right']) ?>

                    </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="matching-footer">

                <div class="matching-score"
                id="matchingScore">

                    Matched: 0 / <?= count($data) ?>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

const dragItems =
document.querySelectorAll(
    ".right-item"
);

const leftItems =
document.querySelectorAll(
    ".left-item"
);

let draggedItem = null;

let matched = 0;

const successSound =
new Audio(
"assets/sounds/correct.mp3"
);

const failSound =
new Audio(
"assets/sounds/wrong.mp3"
);

dragItems.forEach(item => {

    item.addEventListener(
        "dragstart",
        () => {

            draggedItem = item;

            item.classList.add(
                "dragging"
            );

        }
    );

    item.addEventListener(
        "dragend",
        () => {

            item.classList.remove(
                "dragging"
            );

        }
    );

});

leftItems.forEach(box => {

    box.addEventListener(
        "dragover",
        e => {

            e.preventDefault();

        }
    );

    box.addEventListener(
        "drop",
        () => {

            const expected =
            box.dataset.match;

            const selected =
            draggedItem.dataset.value;

            if(expected === selected){

                box.classList.add(
                    "matched"
                );

                draggedItem.classList.add(
                    "matched-answer"
                );

                draggedItem.draggable =
                false;

                matched++;

                successSound.play();

            }else{

                box.classList.add(
                    "wrong-match"
                );

                failSound.play();

                setTimeout(() => {

                    box.classList.remove(
                        "wrong-match"
                    );

                }, 700);

            }

            document.getElementById(
                "matchingScore"
            ).innerHTML =
            `Matched: ${matched} / <?= count($data) ?>`;

        }
    );

});

let matchingSeconds = 0;

setInterval(() => {

    matchingSeconds++;

    document.getElementById(
        "matchingTimer"
    ).innerHTML =
    matchingSeconds + "s";

}, 1000);

</script>