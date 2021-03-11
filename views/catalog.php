<div class="row row-cols-1 row-cols-md-3">
    <?php foreach ($products as $product): ?>
        <div class="card mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $product->title ?></h5>
                <p class="card-text"><?= $product->description ?></p>
            </div>
            <div class="card-footer">
                <a href="/product/card?id=<?=$product->id;?>" class="bbb">Посмотреть</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
