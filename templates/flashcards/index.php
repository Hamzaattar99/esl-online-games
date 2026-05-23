<?php

$data = json_decode(
    $content['data_json'],
    true
);

if(!$data || !is_array($data)){

    include 'views/errors/json-error.php';
    exit;
}

?>

<div class="play-page flashcards-page">

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
                    Flip the card and learn vocabulary interactively
                </div>

            </div>

        </div>

        <div class="topbar-right">

            <div class="timer-box"
            id="studyTimer">

                0s

            </div>

        </div>

    </div>

    <div class="game-wrapper">

        <div class="game-card flashcards-card">

            <div class="flashcards-progress">

                <div class="progress-wrapper">

                    <div class="progress-bar"
                    id="flashProgress"></div>

                </div>

            </div>

            <div class="flashcards-counter"
            id="cardCounter">

                Card 1 / <?= count($data) ?>

            </div>

            <div class="flashcard-scene">

                <div class="flashcard-box"
                id="flashcardBox">

                    <div class="flashcard-face flashcard-front">

                        <div class="flashcard-label">
                            FRONT
                        </div>

                        <div class="flashcard-text"
                        id="flashFront"></div>

                    </div>

                    <div class="flashcard-face flashcard-back">

                        <div class="flashcard-label">
                            BACK
                        </div>

                        <div class="flashcard-text"
                        id="flashBack"></div>

                    </div>

                </div>

            </div>

            <div class="flashcard-actions">

                <button class="control-btn"
                id="prevCardBtn">

                    <i class="bi bi-arrow-left-circle"></i>
                    Previous

                </button>

                <button class="control-btn primary-control"
                id="flipBtn">

                    <i class="bi bi-arrow-repeat"></i>
                    Flip Card

                </button>

                <button class="control-btn"
                id="nextCardBtn">

                    Next
                    <i class="bi bi-arrow-right-circle"></i>

                </button>

            </div>

        </div>

    </div>

</div>

<script>

const flashData =
<?= json_encode($data) ?>;

let flashIndex = 0;

const flashBox =
document.getElementById(
    "flashcardBox"
);

const flashFront =
document.getElementById(
    "flashFront"
);

const flashBack =
document.getElementById(
    "flashBack"
);

const counter =
document.getElementById(
    "cardCounter"
);

const progress =
document.getElementById(
    "flashProgress"
);

const flipSound =
new Audio(
"assets/sounds/flip.mp3"
);

function renderFlashcard(){

    const item =
    flashData[flashIndex];

    flashFront.innerHTML =
    item.front || "-";

    flashBack.innerHTML =
    item.back || "-";

    counter.innerHTML =
    `Card ${flashIndex + 1} / ${flashData.length}`;

    progress.style.width =
    ((flashIndex + 1) /
    flashData.length) * 100 + "%";

    flashBox.classList.remove(
        "flipped"
    );

}

function flipCard(){

    flashBox.classList.toggle(
        "flipped"
    );

    flipSound.currentTime = 0;

    flipSound.play();

}

document.getElementById(
    "flipBtn"
).onclick = flipCard;

flashBox.onclick = flipCard;

document.getElementById(
    "nextCardBtn"
).onclick = () => {

    if(flashIndex < flashData.length - 1){

        flashIndex++;

        renderFlashcard();

    }

};

document.getElementById(
    "prevCardBtn"
).onclick = () => {

    if(flashIndex > 0){

        flashIndex--;

        renderFlashcard();

    }

};

let seconds = 0;

setInterval(() => {

    seconds++;

    document.getElementById(
        "studyTimer"
    ).innerHTML =
    seconds + "s";

}, 1000);

renderFlashcard();

</script>