<ol class="breadcrumb">
    <li><a href="<?= \app\core\createUrl('main_page') ?>">Home</a></li>
    <li><a href="<?= \app\core\createUrl('books') ?>">Books</a></li>
    <li class="active"><?= $book['name'] ?></li>
</ol>

<div class="media">
    <div class="media-left">
        <img src="<?= $book['poster'] ?>" alt="<?= $book['name'] ?>" class="media-object">
    </div>
    <div class="media-body">
        <h4 class="media-heading">
            <?= $book['name'] ?>
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
    </div>
</div>
