<?php

namespace Application\Controllers;

use Application\Models\Products;
use Application\Libraries\Cart;
use Application\Libraries\Product;

class CartController extends BaseController {

    private $cart;

    public function __construct() {
        parent::__construct();
        $this->template->set_folder('Views/Cart');
        
        $this->cart = new Cart();
    }

    public function index() {
//        $offers = Product::prepareForCart(4, 1);
//        prx($offers);
        $cart = $this->cart;
        $products = (new Products)->getAll();
        $cartItems = [];
        if (!$cart->isEmpty()) {
            $cartItems = $cart->getItems();
        }
//        prx($cartItems);
        $total = number_format($cart->getExtraTotal('total_offer_price'), 2, '.', ',');
        $this->template
                ->set_title('My Cart')
                ->view('index', \compact('products','cartItems', 'total'));
    }
    
    public function addToCart($product_id, $qty = 1) {
        try{
            $offers = Product::prepareForCart($product_id, $qty);
            foreach ($offers as $offer) {
                $this->cart->add($product_id, $offer['quantity'], $offer['attributes'], $offer['extras']);
            }
            
            $return = [
                'error' => false
            ];
        } catch (\Exception $e) {
            $return = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        
        json_response($return);
        return;
        
    }
    
    public function updateCart($product_id, $hash, $qty = 1) {
        try{
            $qty += $this->cart->getItemQuantity($product_id, $hash);
            
            $offers = Product::prepareForCart($product_id, $qty);
            $this->cart->remove($product_id);
            foreach ($offers as $offer) {
                $this->cart->add($product_id, $offer['quantity'], $offer['attributes'], $offer['extras']);
            }
            $return = [
                'error' => false
            ];
        } catch (\Exception $e) {
            $return = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        
        json_response($return);
        return;
        
    }
    
    public function removeFromCart($product_id) {
        try{
            $this->cart->remove($product_id);
            $return = [
                'error' => false
            ];
        } catch (\Exception $e) {
            $return = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        
        json_response($return);
        return;
        
    }
    
    public function clearCart() {
        try{
            $this->cart->clear();
            $return = [
                'error' => false
            ];
        } catch (\Exception $e) {
            $return = [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        
        json_response($return);
        return;
    }
}
