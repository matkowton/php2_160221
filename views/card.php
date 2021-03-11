<?php
/**
 * @var $product array
 * @var $feedbacks array
 */
?>
<h2><?= $product->title ?></h2>
<p><?= $product->description ?></p>
<p>Цена: <?= $product->price ?></p>
<form id="add_to_cart_frm" action="" class="row g-2" method="post">
    <input name="product_id" value="<?= $product->id ?>" type="hidden">
    <div class="col-auto">
        <input id="qty_input" type="number" value="0" name="qty" class="form-control">
    </div>
    <div class="col-auto">
        <input id="add_to_card_btn" data-id="<?= $product->id?>" type="submit" value="Добавить в корзину"
               class="btn btn-primary">
    </div>
</form>
<script>

    $(function () {
        $("#add_to_cart_frm").on('submit', function (e) {
            e.preventDefault();
            var id = $("#add_to_card_btn").data('id');
            var qty = $("#qty_input").val();
            console.log(id);
            console.log(qty);

            $.ajax({
                url : "/basket/add",
                type: "POST",
                data: {
                    product_id: id,
                    qty: qty
                },
                success : function (response) {
                    response = JSON.parse(response);
                    if(response.status == 'success'){
                        alert(response.message)
                    }
                }
            })
        })
    })
</script>
