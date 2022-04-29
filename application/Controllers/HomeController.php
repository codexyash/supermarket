<?php

namespace Application\Controllers;

use Application\Models\Products;
use Application\Models\Offers;

class HomeController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->template->set_folder('Views/Home');
    }

    public function index() {
        
        $products = (new Products)->getAll();
        $this->template
                ->set_title('Home')
                ->view('index', \compact('products'));
    }
    
    public function details($product_id) {
        
        $product = (new Products)->getById($product_id);
        $offers = (new Offers())->getByProductId($product_id);
        
        $this->template
                ->set_title($product->title)
                ->view('product', \compact('product', 'offers'));
    }

}
