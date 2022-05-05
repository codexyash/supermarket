<?php

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {

    protected $name;
    protected function setUp(): void
    {
        $this->db = Application\Libraries\Core\Database::connect();
        $this->cart = new Application\Libraries\Cart();
    }
    
    /**
     * @dataProvider additionProvider
     */
    public function testAddToCart($product_id, $quantity, $expected) {
        $curl = new \Curl\Curl();
        $curl->get(base_url(sprintf('/cart/add/%d/%d', $product_id, $quantity)));
        $result = (array) $curl->response;
        
        $this->assertSame($expected, $result);
    }
    
    public function additionProvider(): array
    {
        return [
            [1, 5, ['error' => false]],
            [2, 2, ['error' => false]],
            [10, 1, ['error' => true, 'message' => 'E_PRODUCT_NOT_FOUND']],
        ];
    }
    
    /**
     * @dataProvider offerProvider
     */
    public function testOffer($product_id, $quantity, $expectedTotalPrice) {
        $offers = Application\Libraries\Product::prepareForCart($product_id, $quantity);
        $totalQuantity = 0;
        $totalPrice = 0;
        foreach ($offers as $offer) {
            $totalPrice += $offer['extras']['total_offer_price'];
            $totalQuantity += $offer['quantity'];
        }
        $this->assertEquals($quantity, $totalQuantity);
        $this->assertEquals($expectedTotalPrice, $totalPrice);
    }
    
    public function offerProvider(): array
    {
        return [
            [1, 5, 230],
            [3, 5, 88],
            [3, 4, 70],
            [3, 3, 50],
            [3, 2, 38],
            [3, 1, 20],
        ];
    }
    
    public function testClearCart() {
        $curl = new \Curl\Curl();
        $curl->get(base_url('/cart/clear'));
        $result = (array) $curl->response;
        
        $this->assertSame(['error' => false], $result);
    }
}

?>