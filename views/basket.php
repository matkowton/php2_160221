<h2>Товары в корзине</h2>
<?php if (empty($basket)): ?>
    <p>Корзина пуста!</p>
<?php else: ?>
    <table class="table">
        <?php foreach ($basket as $item): ?>
            <tr>
                <td>
                    <?= $item['product']->title ?>
                </td>
                <td>
                    <?= $item['qty'] ?>
                </td>
                <td>
                    <a href="/basket/remove?id=<?= $item['product']->id ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>