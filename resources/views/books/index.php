<ol class="breadcrumb">
    <li><a href="<?= \app\core\createUrl('main_page') ?>">Home</a></li>
    <li class="active">Books</li>
</ol>

<?= $content ?>

<nav class="text-center">
    <?php
        $pages = ceil($criteria['total'] / $criteria['length']);
        $current = ($criteria['offset'] / $criteria['length']);
    ?>
    <ul class="pagination">
        <?php for ($i = 0; $i < $pages; $i++): ?>
            <li class="<?= $i == $current ? 'active' : '' ?>">
                <a href="<?= $i == 0 ? \app\core\createUrl('books') : \app\core\createUrl('books_pagination', ['page' => $i]) ?>">
                    <?= ($i + 1) ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
