<section class="h-100 h-custom" >
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted"><?php echo count($cartItems) ?> items</h6>
                                    </div>
                                    <hr class="my-4">
                                    <?php 
                                    if(!empty($cartItems)){
                                    foreach($cartItems as $id => $items){ 
                                        foreach ($items as $item) {
                                            foreach ($products as $product) {
                                                    if ($id == $product->id) {
                                                            break;
                                                    }
                                            }
                                    ?>
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="https://picsum.photos/200/300" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2">
                                            <h6 class="text-muted"><?php echo $product->title?></h6>
                                            <h6 class="text-black mb-0"><?php echo $product->title?></h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input data-product-id="<?php echo $product->id ?>" data-product-hash="<?php echo $item['hash'] ?>" id="form1" min="0" name="quantity" value="<?php echo $item['quantity']?>" type="number"
                                                   class="form-control form-control-sm cart-qty" style="width: 50px;"/>

                                            <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <h6 class="mb-0 text-center">Rs. <?php echo $item['attributes']['price']?></h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-2">
                                            <h6 class="mb-0">
                                                Rs. <?php echo $item['extras']['total_offer_price']?>
                                                <?php if(isset($item['extras']['has_offer']) && $item['extras']['has_offer']){ ?>
                                                    <br/><strike class="text-danger">Rs. <?php echo $item['extras']['actual_price'] * $item['quantity']?></strike>
                                                    <?php if(isset($item['extras']['offer_text'])){ ?>
                                                    <small class="text-success"><?php echo $item['extras']['offer_text']?></small>
                                                    <?php } ?> 
                                                <?php } ?>   
                                            </h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#!" data-product-id="<?php echo $product->id ?>" class="text-muted remove-item"><i class="fas fa-times"></i></a>
                                        </div>
                                        
                                    </div>

                                    <hr class="my-4">
                                    <?php }}} else { ?>
                                        <h5>Your Cart is Empty..!</h5>
                                    <?php } ?>      
                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="<?php echo base_url(); ?>" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                    </div>
                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="#!" class="text-body clear-cart"><i class="fas fa-trash me-2"></i>Clear Cart</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">items <?php echo count($cartItems) ?></h5>
                                        <h5>Rs.<?php echo $total ?></h5>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5>Rs.<?php echo $total ?></h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>