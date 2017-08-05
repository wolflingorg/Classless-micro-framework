<?php foreach ($books as $id => $book): ?>
    <div class="media">
        <div class="media-left">
            <a href="<?= \app\core\createUrl('book_by_id', ['id' => $id]) ?>">
                <img src="<?= $book['poster'] ?>" alt="<?= $book['name'] ?>" class="media-object">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="<?= \app\core\createUrl('book_by_id', ['id' => $id]) ?>"><?= $book['name'] ?></a>
            </h4>

            <p><b>Author</b>: <?= $book['author'] ?></p>

            <p><b>Price</b>: <span class="text-success" style="font-size: large"><?= sprintf("$ %01.2f", $book['price']) ?></span></p>

            <p><b>Date</b>: <?= date_format(date_create($book['date']),'d/m/Y') ?></p>

            <?php if (isset($book['tags'])): ?>
                <p>
                    <b>Tags</b>:
                    <?php foreach ((array)$book['tags'] as $tag): ?>
                        <span class="label label-primary"><?= $tag ?></span>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>

            <a href="<?= \app\core\createUrl('book_by_id', ['id' => $id]) ?>" class="btn btn-primary">Details</a>
        </div>
    </div>
<?php endforeach; ?>
