<?php

/* @var $this yii\web\View */
/* @var $newses [] */

use yii\bootstrap\Html;

?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th style="width: 20%;">Заголовок</th>
            <th>Текст</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($newses as $i => $news): ?>
        <tr>
            <td><?= ($i + 1)?></td>
            <td><?= $news['id']?></td>
            <td><?= Html::encode($news['title'])?></td>
            <td><?= nl2br(Html::encode($news['text']))?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
<?php

?>
</table>
