<?php

namespace Application\Libraries;

use Application\Models\Products;
use Application\Models\Offers;

class Product {

    static function prepareForCart($product_id, $qty = 1){
        $product = (new Products)->getById($product_id);
        $comboOffers = self::getComboOffer($product, $qty);
        
        if(count($comboOffers) <= 1 && !$comboOffers[0]['extras']['has_offer']){
            $comboOffers = self::getProductOffer($product, $qty);
        }
        return $comboOffers;
    }
    
    static function getComboOffer($product, $qty = 1){
        $offers = (new Offers())->getComboOffers($product->id);
        $total = $qty;
        $appliedOffers = [];
        foreach($offers as $offer){
            if($total >= $offer->quantity){
                list($quotient, $remainder) = getQuotientAndRemainder($total, $offer->quantity);
                $appliedOffers[] = [
                'quantity' => $quotient * $offer->quantity,
                'attributes' => [
                    'price' => $product->unit_price,                   
                    'offer' => $offer->id,                   
                ],
                'extras' => [
                    'actual_price' => $product->unit_price,                   
                    'offer_price' => ($offer->offer_price * $quotient),
                    'total_offer_price' => ($offer->offer_price * $quotient),
                    'has_offer' => true,
                    'offer_text' => \sprintf('Bought %s at Rs.%s' , $offer->quantity, $offer->offer_price),
                ],
            ];
                $total = $remainder;
            }
        }
        if($total > 0){
            $appliedOffers[] = [
                'quantity' => $total,
                'attributes' => [
                    'price' => $product->unit_price,                   
                    'offer' => 0, 
                ],
                'extras' => [
                    'actual_price' => $product->unit_price,                   
                    'offer_price' => $product->unit_price,
                    'total_offer_price' => ($product->unit_price * $total),
                    'has_offer' => false
                ],
            ];
        }
        return $appliedOffers;
    }
    
    static function getProductOffer($product, $qty = 1){
        $cart = new Cart();
        $total = $qty;
        $appliedOffers = [];
        $offers = (new Offers())->getProductOffers($product->id);
        foreach($offers as $offer){
            
            if($cart->getItem($offer->related_product_id)){
                $relatedItemQuantity = $cart->getItemQuantity($offer->related_product_id);
                if ($total > 0) {
                    $relatedProduct = (new Products)->getById($offer->related_product_id);
                    $appliedOffers[] = [
                        'quantity' => min($total, $relatedItemQuantity),
                        'attributes' => [
                            'price' => $offer->offer_price,
                            'offer' => $offer->id,
                        ],
                        'extras' => [
                            'actual_price' => $product->unit_price,
                            'offer_price' => $offer->offer_price,
                            'total_offer_price' => ($offer->offer_price * min($total, $relatedItemQuantity)),
                            'has_offer' => true,
                            'offer_text' => \sprintf('Bought with %s' , $relatedProduct->title),
                        ],
                    ];
                    $total -= $relatedItemQuantity;
                }
            }
        }
        if($total > 0){
            $appliedOffers[] = [
                'quantity' => $total,
                'attributes' => [
                    'price' => $product->unit_price,                   
                    'offer' => 0, 
                ],
                'extras' => [
                    'actual_price' => $product->unit_price,                   
                    'offer_price' => $product->unit_price,
                    'total_offer_price' => ($product->unit_price * $total),
                    'has_offer' => false
                ],
            ];
        }
        
        return $appliedOffers;
    }

}
