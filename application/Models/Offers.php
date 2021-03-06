<?php

namespace Application\Models;

class Offers extends Model {

    public $table = 'product_offers';

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        return $this->db
                        ->ObjectBuilder()
                        ->orderBy('id', 'desc')
                        ->get($this->table);
    }

    public function getById($id) {
        return $this->db
                        ->ObjectBuilder()
                        ->where('id', $id)
                        ->getOne($this->table);
    }

    public function getByProductId($id) {
        return $this->db
                        ->ObjectBuilder()
                        ->join("products p", "p.id=po.related_product_id", "LEFT")
                        ->where('po.product_id', $id)
                        ->orderBy('po.offer_price', 'desc')
                        ->get($this->table . ' as po', null, 'po.*,p.title as related_product_title');
    }

    public function getComboOffers($id) {
        return $this->db
                        ->ObjectBuilder()
                        ->where('product_id', $id)
                        ->where('offer_type', 'combo')
                        ->orderBy('offer_price', 'desc')
                        ->get($this->table);
    }

    public function getProductOffers($id) {
        return $this->db
                        ->ObjectBuilder()
                        ->where('product_id', $id)
                        ->where('offer_type', 'product')
                        ->orderBy('offer_price', 'asc')
                        ->get($this->table);
    }

}
