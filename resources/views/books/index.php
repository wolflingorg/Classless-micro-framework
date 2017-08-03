<?php foreach ($books as $id => $book): ?>
    <div class="row">
        <h4><a href="<?= \app\core\createUrl('book_by_id', ['id' => $id]) ?>"><?= $book['name'] ?></a></h4>
    </div>
<?php endforeach; ?>
