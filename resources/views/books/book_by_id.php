<ol class="breadcrumb">
    <li><a href="<?= \app\core\createUrl('main_page') ?>">Home</a></li>
    <li><a href="<?= \app\core\createUrl('books') ?>">Books</a></li>
    <li class="active"><?= $book['name'] ?></li>
</ol>

<div class="media">
    <div class="media-left">
        <img src="<?= $book['poster'] ?>" alt="<?= $book['name'] ?>" class="media-object">

        <div class="text-center" style="margin-top: 25px">
            <a href="<?= $book['link'] ?>" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-info-sign"></span> See more</a>
        </div>
    </div>

    <div class="media-body">
        <h2 class="media-heading">
            <?= $book['name'] ?>
        </h2>

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

        <?= $book['info'] ?>
    </div>
</div>
