<div class="col-4">
    <div class="product-card text-center">
        <span data-id="<?=$product['id']?>" class="product-cart-qty badge rounded-pill bg-warning"></span>
        <img src="images/shop/<?=$product['image']?>" class="card-img-top"
             alt="">
        <div class="product-card-body">
            <p class="product-title">
                <?=$product['title']?>
            </p>
            <p class="product-price">
                <?=$product['price']?>$
            </p>
            <div class="d-grid gap-2 mt-2">
                <button class="btn btn-warning add2cart animate__animated"
                        data-product='<?=json_encode($product)?>'>ADD
                </button>
            </div>
        </div>
    </div>
</div>