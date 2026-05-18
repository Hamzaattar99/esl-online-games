<?php
$data = json_decode($content['data_json'], true);
?>

<div class="flashcard" onclick="flip()">
    <div id="front"></div>
    <div id="back"></div>
</div>

<button onclick="nextCard()">Next</button>

<script>
let data = <?= json_encode($data) ?>;
let i = 0;

function render() {
    document.getElementById("front").innerText = data[i].front;
    document.getElementById("back").innerText = data[i].back;
}

function flip() {
    document.querySelector(".flashcard").classList.toggle("flipped");
}

function nextCard() {
    i++;
    render();
}

render();
</script>