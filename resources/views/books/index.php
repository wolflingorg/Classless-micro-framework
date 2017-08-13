<ol class="breadcrumb">
    <li><a href="<?= \app\core\createUrl('main_page') ?>">Home</a></li>
    <?php if (!empty($criteria['q'])): ?>
        <li><a href="<?= \app\core\createUrl('books') ?>">Books</a></li>
        <li class="active">Search</li>
    <?php else: ?>
        <li class="active">Books</li>
    <?php endif; ?>
</ol>

<?php if (!empty($criteria['q']) && $criteria['total'] == 0): ?>
    <div class="alert alert-info" role="alert">
        We found 0 results for "<b><?= $criteria['q'] ?></b>"<br />
        <a href="<?= \app\core\createUrl('main_page') ?>">Return Home</a>
    </div>
<?php endif; ?>

<?= $content ?>

<nav class="text-center">
    <?php
        $pages = ceil($criteria['total'] / $criteria['length']);
        $current = ($criteria['offset'] / $criteria['length']);
    ?>
    <ul class="pagination">
        <?php for ($i = 0; $i < $pages; $i++): ?>
            <li class="<?= $i == $current ? 'active' : '' ?>">
                <?php
                    $params = array_filter(array_merge($_GET, ['page' => $i]), function ($value) {
                        return !empty($value);
                    });
                    $page = !empty($params) ? \app\core\createUrl('books') . '?' . http_build_query($params) : \app\core\createUrl('books');
                ?>
                <a href="<?= $page ?>">
                    <?= ($i + 1) ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
