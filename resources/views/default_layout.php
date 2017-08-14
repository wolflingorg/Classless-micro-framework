<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css" />
    <title><?= $app['config']['name'] ?></title>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= \app\core\createUrl('main_page') ?>">
                <span class="glyphicon glyphicon-book"></span>
                <?= $app['config']['name'] ?>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-left" action="<?= \app\core\createUrl('books') ?>">
                <div class="form-group">
                    <input placeholder="Search" name="q" value="<?= isset($criteria['q']) ? $criteria['q'] : '' ?>" required class="form-control">
                </div>
                <button class="btn btn-default">Search</button>
            </form>

            <?php if (!$app['user']): ?>
                <form class="navbar-form navbar-right" method="post" action="<?= \app\core\createUrl('security_login') ?>">
                    <div class="form-group">
                        <input placeholder="Email" name="username" required class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required placeholder="Password" class="form-control">
                    </div>
                    <button class="btn btn-success">Log in</button>
                </form>
            <?php else: ?>
                <form class="navbar-form navbar-right" method="post" action="<?= \app\core\createUrl('security_logout') ?>">
                    <button class="btn btn-success">Log out</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Hello <?= $app['user']['username'] ?></a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <?php foreach (['success', 'info', 'warning', 'danger'] as $flashType): ?>
        <?php foreach (\app\core\getFlashes($flashType) as $message): ?>
            <div class="alert alert-<?= $flashType ?>" role="alert">
                <?= $message ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <?= $content ?>
</div>

<hr>

<footer class="footer">
    <div class="container">
        <p class="text-muted">© <?= date_format(date_create(),'Y') ?> Company, Inc.</p>
    </div>
</footer>

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
