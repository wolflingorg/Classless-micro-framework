<ol class="breadcrumb">
    <li class="active">Home</li>
</ol>

<div class="page-header">
    <h3>Top 3 cheapest books <small><a href="<?= \app\core\createUrl('books') ?>" class="pull-right">See all books</a></small></h3>
</div>
<?= app\core\renderFile('books.php', 'app\\src\\books\\search', [['sort' => '-price']]) ?>

<div class="page-header">
    <h3>Top 3 PHP books <small><a href="<?= \app\core\createUrl('books') ?>" class="pull-right">See all books</a></small></h3>
</div>
<?= app\core\renderFile('books.php', 'app\\src\\books\\search', [['tag' => 'php']]) ?>

