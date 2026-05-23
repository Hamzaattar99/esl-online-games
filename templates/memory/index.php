<?php

$data = json_decode(
    $content['data_json'],
    true
);

if(!$data || !is_array($data)){

    include 'views/errors/json-error.php';
    exit;
}

$cards = [];

foreach($data as $item){

    $cards[] = $item['value'];
    $cards[] = $item['value'];

}

shuffle($cards);

?>

<div class="play-page memory-page">

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
                    Match all memory cards
                </div>

            </div>

        </div>

        <div class="topbar-right">

            <div class="timer-box"
            id="memoryTimer">

                0s

            </div>

        </div>

    </div>

    <div class="game-wrapper">

        <div class="game-card">

            <div class="memory-grid">

                <?php foreach($cards as $value): ?>

                <div class="memory-card"
                data-value="<?= $value ?>">

                    <div class="memory-inner">

                        <div class="memory-front">

                            <i class="bi bi-stars"></i>

                        </div>

                        <div class="memory-back">

                            <?= htmlspecialchars($value) ?>

                        </div>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>

<script>

const memoryCards =
document.querySelectorAll(
    ".memory-card"
);

const correctSound =
new Audio(
"assets/sounds/correct.mp3"
);

const wrongSound =
new Audio(
"assets/sounds/wrong.mp3"
);

let opened = [];

let lockBoard = false;

memoryCards.forEach(card => {

    card.onclick = () => {

        if(lockBoard) return;

        if(card.classList.contains(
            "matched"
        )) return;

        card.classList.add(
            "flipped"
        );

        opened.push(card);

        if(opened.length === 2){

            checkCards();

        }

    };

});

function checkCards(){

    lockBoard = true;

    const first =
    opened[0];

    const second =
    opened[1];

    if(
        first.dataset.value ===
        second.dataset.value
    ){

        first.classList.add(
            "matched"
        );

        second.classList.add(
            "matched"
        );

        correctSound.play();

        resetBoard();

    }else{

        wrongSound.play();

        setTimeout(() => {

            first.classList.remove(
                "flipped"
            );

            second.classList.remove(
                "flipped"
            );

            resetBoard();

        }, 900);

    }

}

function resetBoard(){

    opened = [];

    lockBoard = false;

}

let memoryTime = 0;

setInterval(() => {

    memoryTime++;

    document.getElementById(
        "memoryTimer"
    ).innerHTML =
    memoryTime + "s";

}, 1000);

</script>