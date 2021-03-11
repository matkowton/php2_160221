<?php
/**
 * @var $product array
 * @var $feedbacks array
 */
?>
<h2><?= $product->title ?></h2>
<p><?= $product->description ?></p>
<p>Цена: <?= $product->price ?></p>
<div class="col-auto">
    <input id="qty_input" type="number" value="0" name="qty" class="form-control">
</div>
<div class="col-auto">
    <input id="add_to_card" data-id="<?=$product->id?>" type="submit" value="Добавить в корзину" class="btn btn-primary">
</div>
<script>

    $(function () {
        $("#add_to_card").on('click', function () {
            var id = $(this).data('id');
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
