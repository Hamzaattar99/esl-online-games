<?php
$data = json_decode($content['data_json'], true);
?>

<div class="match-container">
    <?php foreach ($data as $item): ?>
        <div class="pair">
            <span><?= $item['left'] ?></span>
            <span><?= $item['right'] ?></span>
        </div>
    <?php endforeach; ?>
</div>