<div class="row">
    <?php
    if (!empty($products)) {
        foreach ($products as $product) {
            ?>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em"><?php echo $product->title ?></text></svg>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?php echo base_url('/product/'.$product->id) ?>"><?php echo $product->title ?></a>
                        </h5>
                        <p class="card-text">Rs.<?php echo number_format($product->unit_price, 2, '.', ',') ?></p>
                        <a href="#" data-product-id="<?php echo $product->id ?>" data-product-qty="1" class="btn btn-primary add-to-cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
