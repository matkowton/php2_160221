<!doctype html>
<html lang="en">
<head>
    <?= \app\base\Application::getInstance()
        ->renderer
        ->render('blocks/head')
    ?>
</head>
<body>
<div class="row justify-content-center">
    <div class="col-md-6">
        <header>
            <?= \app\base\Application::getInstance()
                ->renderer
                ->render('blocks/menu', ['menu' => $menu])
            ?>
        </header>
        <main>
            <?=$content?>
        </main>
        <footer>
        </footer>
    </div>
</div>
</body>
</html>