<div class="card">
    <div class="container-fliud">
        <div class="wrapper row">
            <div class="preview col-md-6">

                <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1">
                        <img src="https://picsum.photos/400/252" />
                    </div>
                </div>

            </div>
            <div class="details col-md-6">
                <h3 class="product-title"><?php echo $product->title ?></h3>

                <h4 class="price">current price: <span>Rs.<?php echo $product->unit_price ?></span></h4>
                <?php foreach ($offers as $offer) { ?>
                    <p class="vote">

                        <?php if ($offer->offer_type == 'combo') { ?>
                            Buy <strong><?php echo $offer->quantity ?></strong> at <strong>Rs.<?php echo $offer->offer_price ?></strong>
                        <?php } ?>

                        <?php if ($offer->offer_type == 'product') { ?>
                            Buy <strong>"<?php echo $offer->related_product_title ?>"</strong> and get this product at <strong>Rs.<?php echo $offer->offer_price ?></strong>
                        <?php } ?>

                    </p>
                <?php } ?>


                <div class="action">
                    <a href="#" data-product-id="<?php echo $product->id ?>" data-product-qty="1" class="btn btn-primary add-to-cart">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>