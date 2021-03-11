<h1>Управление товарами</h1>
<p>
    <a class="btn btn-success" href="/admin_products/view">
        Создать
    </a>
</p>
<div class="list-group">
    <?php foreach ($products as $product): ?>
        <div class="list-group-item">
            <h2><?= $product['title'] ?></h2>
            <p>
                <a class="btn btn-primary" href="/admin_products/view?id=<?= $product['id'] ?>">
                    Изменить
                </a>
                <a class="btn btn-danger" href="/admin_products/delete?id=<?= $product['id'] ?>">
                    Удалить
                </a>
            </p>
        </div>
    <?php endforeach; ?>
</div>
