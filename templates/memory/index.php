<?php
$data = json_decode($content['data_json'], true);
shuffle($data);
?>

<div class="memory-grid">
    <?php foreach ($data as $card): ?>
        <div class="card" onclick="flip(this)">
            <?= $card['value'] ?>
        </div>
    <?php endforeach; ?>
</div>

<script>
function flip(el) {
    el.classList.toggle("flipped");
}
</script>