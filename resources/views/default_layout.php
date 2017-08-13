<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
