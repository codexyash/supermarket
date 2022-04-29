<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Expires" content="-1"/>
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <title><?php echo $this->get_title() ?></title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.min.css" integrity="sha512-GFm9O0arU56sgj5HX9IrEtyDqKx3XhbwiTA75XTWW5JoyKnhzQ1Qj3yYbA+MLmy4p+dg5K77NCVxa3nalA96LQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
            var base_url = "<?php echo base_url() ?>";
        </script>
        <?php foreach ($this->get_css() as $css) { ?>
            <link href="<?php echo $css ?>" rel="stylesheet" type="text/css" />
        <?php } ?>
            <style>
                @media (min-width: 1025px) {
                    .h-custom {
                    height: 100vh !important;
                    }
                    }

                    .card-registration .select-input.form-control[readonly]:not([disabled]) {
                    font-size: 1rem;
                    line-height: 2.15;
                    padding-left: .75em;
                    padding-right: .75em;
                    }

                    .card-registration .select-arrow {
                    top: 13px;
                    }

                    .bg-grey {
                    background-color: #eae8e8;
                    }

                    @media (min-width: 992px) {
                    .card-registration-2 .bg-grey {
                    border-top-right-radius: 16px;
                    border-bottom-right-radius: 16px;
                    }
                    }

                    @media (max-width: 991px) {
                    .card-registration-2 .bg-grey {
                    border-bottom-left-radius: 16px;
                    border-bottom-right-radius: 16px;
                    }
                    }
                    INPUT:-webkit-autofill,SELECT:-webkit-autofill,TEXTAREA:-webkit-autofill{animation-name:onautofillstart}INPUT:not(:-webkit-autofill),SELECT:not(:-webkit-autofill),TEXTAREA:not(:-webkit-autofill){animation-name:onautofillcancel}@keyframes onautofillstart{}@keyframes onautofillcancel{}
            </style>
    </head>

    <body>
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Item Added to Cart!
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo base_url() ?>">SuperMarket</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('cart') ?>">Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container" role="main">
            <?php echo $content; ?>
        </main>
        
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js" integrity="sha512-vCgNjt5lPWUyLz/tC5GbiUanXtLX1tlPXVFaX5KAQrUHjwPcCwwPOLn34YBFqws7a7+62h7FRvQ1T0i/yFqANA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <?php foreach ($this->get_js() as $js) { ?>
            <script src="<?php echo $js ?>"></script>
        <?php } ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $(document).on('click', '.add-to-cart', function(e){
                        e.preventDefault();
                        _cart.addToCart($(this).data('product-id'), $(this).data('product-qty'));
                    });
                    
                    $(document).on('change', '.cart-qty', function(e){
                        e.preventDefault();
                        _cart.updateCart($(this).data('product-id'), $(this).data('product-hash'), $(this).val())
                        window.location.reload(true);
                    });
                    
                    $(document).on('click', '.remove-item', function(e){
                        e.preventDefault();
                        _cart.removeFromCart($(this).data('product-id'));
                        window.location.reload(true);
                    });
                    
                    $(document).on('click', '.clear-cart', function(e){
                        e.preventDefault();
                        _cart.clearCart();
                        window.location.reload(true);
                    });
                });
                
                var cart = function () {
                    var root = this;

                    var _cartdata = {};
                    
                    root.construct = function () {
                        
                    };

                    root.setData = function (key, data) {
                        _cartdata[key] = data;
                    };

                    root.getData = function () {
                        return _cartdata;
                    };
                    
                    root.addToCart = function (productId, qty) {
                        $.get(base_url+'cart/add/'+productId+'/'+qty, function(data, status){
                            if(!data.error){
                                root.notify("Item Added to Cart!");
                            }
                        });
                    };
                    
                    root.updateCart = function (productId, hash, qty) {
                        $.get(base_url+'cart/update/'+productId+'/'+hash+'/'+qty, function(data, status){
                            
                        });
                    };
                    
                    root.removeFromCart = function (productId) {
                        $.get(base_url+'cart/remove/'+productId, function(data, status){
                            
                        });
                    };
                    
                    root.clearCart = function () {
                        $.get(base_url+'cart/clear', function(data, status){
                            
                        });
                    };
                    
                    root.notify = function (text) {
                        var toastId = document.getElementById('toast');
                        $('#toast').find('.toast-body').text(text);
                        var toast = new bootstrap.Toast(toastId);
                        console.log(toast);
                        
                        toast.show();
                    };
                }
                
                var _cart = new cart();
            </script>
    </body>

</html>
