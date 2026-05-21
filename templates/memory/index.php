<?php

$data = json_decode(
$content['data_json'],
true
);

shuffle($data);

?>

<div class="play-page">

    <div class="game-wrapper">

        <div class="game-card">

            <h2 class="mb-4">
                Memory Game
            </h2>

            <div class="memory-grid">

                <?php foreach($data as $card): ?>

                <div class="memory-card">

                    <div class="memory-inner">

                        <div class="memory-front">
                            ?
                        </div>

                        <div class="memory-back">
                            <?= $card['value'] ?>
                        </div>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>

<style>

.memory-grid{
    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(120px,1fr));

    gap:18px;
}

.memory-card{
    height:120px;

    perspective:1000px;

    cursor:pointer;
}

.memory-inner{
    width:100%;
    height:100%;

    position:relative;

    transform-style:preserve-3d;

    transition:0.5s;
}

.memory-card.flipped .memory-inner{
    transform:rotateY(180deg);
}

.memory-front,
.memory-back{
    position:absolute;

    inset:0;

    border-radius:18px;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:32px;
    font-weight:800;

    backface-visibility:hidden;
}

.memory-front{
    background:#1e293b;
}

.memory-back{
    background:var(--primary);

    transform:rotateY(180deg);
}

</style>

<script>

document
.querySelectorAll(".memory-card")
.forEach(card => {

    card.onclick = () => {

        card.classList.toggle(
            "flipped"
        );

    };

});

</script>