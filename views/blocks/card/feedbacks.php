<h4>Отзывы</h4>
<div class="list-group">
    <?php foreach ($feedbacks as $feedback): ?>
        <div class="list-group-item">
            <?= $feedback['content']; ?>
        </div>
    <?php endforeach; ?>
</div>
<div>
    <form action="/product/add_feedback" method="post">
        <div class="form-group">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        </div>
        <div class="form-group">
            <textarea name="content" id="" cols="84" rows="4"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Отправить отзыв">
        </div>
    </form>
</div>