<?php
$data = json_decode($content['data_json'], true);
?>

<div class="lesson">

<?php foreach ($data as $item): ?>

    <?php if ($item['type'] == 'text'): ?>
        <p><?= $item['content'] ?></p>
    <?php endif; ?>

    <?php if ($item['type'] == 'quiz'): ?>
        <div class="mini-quiz">
            <?= $item['question'] ?>
        </div>
    <?php endif; ?>

<?php endforeach; ?>

</div>