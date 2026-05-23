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

<div class="play-page lesson-page">

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
                    Interactive ESL Lesson Slides
                </div>

            </div>

        </div>

        <div class="topbar-right">

            <div class="timer-box"
            id="lessonTimer">

                0s

            </div>

        </div>

    </div>

    <div class="game-wrapper">

        <div class="game-card lesson-card">

            <?php foreach($data as $index => $slide): ?>

            <div class="lesson-slide
            <?= $index === 0 ? 'active-slide' : '' ?>">

                <div class="lesson-slide-content">

                    <?php if($slide['type'] === 'text'): ?>

                    <h2>
                        <?= htmlspecialchars($slide['title'] ?? 'Lesson') ?>
                    </h2>

                    <p>
                        <?= htmlspecialchars($slide['content']) ?>
                    </p>

                    <?php endif; ?>

                    <?php if($slide['type'] === 'quiz'): ?>

                    <div class="lesson-mini-quiz">

                        <h2>
                            <?= htmlspecialchars($slide['question']) ?>
                        </h2>

                        <div class="lesson-answers">

                            <?php foreach($slide['options'] as $option): ?>

                            <button class="lesson-answer-btn">

                                <?= htmlspecialchars($option) ?>

                            </button>

                            <?php endforeach; ?>

                        </div>

                    </div>

                    <?php endif; ?>

                </div>

            </div>

            <?php endforeach; ?>

            <div class="lesson-controls">

                <button class="control-btn"
                id="prevSlideBtn">

                    <i class="bi bi-chevron-left"></i>
                    Previous

                </button>

                <button class="control-btn primary-control"
                id="nextSlideBtn">

                    Next
                    <i class="bi bi-chevron-right"></i>

                </button>

            </div>

        </div>

    </div>

</div>

<script>

const slides =
document.querySelectorAll(
    ".lesson-slide"
);

let currentSlide = 0;

function renderSlides(){

    slides.forEach(slide => {

        slide.classList.remove(
            "active-slide"
        );

    });

    slides[currentSlide]
    .classList.add(
        "active-slide"
    );

}

document.getElementById(
    "nextSlideBtn"
).onclick = () => {

    if(currentSlide <
    slides.length - 1){

        currentSlide++;

        renderSlides();

    }

};

document.getElementById(
    "prevSlideBtn"
).onclick = () => {

    if(currentSlide > 0){

        currentSlide--;

        renderSlides();

    }

};

let lessonSeconds = 0;

setInterval(() => {

    lessonSeconds++;

    document.getElementById(
        "lessonTimer"
    ).innerHTML =
    lessonSeconds + "s";

}, 1000);

</script>